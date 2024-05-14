<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Code Info</title>
    <link rel="stylesheet" href="CSS/mascara.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    </script>
    <!-- FullCalendar -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#" class="logo">
                        <img src="Images/logo.png" alt="">
                        <span class="nav-item">Autopeças</span>
                    </a></li>
                <li><a href="Index.php">
                        <i class="fas fa-home"></i>
                        <span class="nav-item">Home</span>
                    </a></li>
                <li><a href="Add.php">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Cadastrar Itens</span>
                    </a></li>
                <li><a href="List.php">
                        <i class="fas fa-list"></i>
                        <span class="nav-item">Estoque</span>
                    </a></li>
                <li><a href="Calendar.php">
                        <i class="fas fa-calendar"></i>
                        <span class="nav-item">Calendario</span>
                    </a></li>
            </ul>
        </nav>

        <section class="main">
            <div class="main-top">
                <h1>Calendario de Eventos</h1>
                <i class="fas fa-calendar"></i>
            </div>
            <section class="main-course">
                <h1>Calendário</h1>
                <div id="calendar"></div>
            </section>
            <button id="save-events">Salvar Alterações</button>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                editable: true,
                selectable: true,
                droppable: true,
                events: 'Scripts/ListEvents.php',
                select: function (info) {
                    var title = prompt('Por favor, insira o título do evento:');
                    if (title) {
                        calendar.addEvent({
                            title: title,
                            start: info.startStr,
                            end: info.endStr,
                            allDay: info.allDay
                        });
                    }
                },
                eventClick: function (info) {
                    Swal.fire({
                        title: 'Editar ou Excluir Evento',
                        html: '<input id="swal-input1" class="swal2-input" placeholder="Novo título" value="' + info.event.title + '">' +
                            '<input id="swal-input2" class="swal2-input" placeholder="Nova data de início" type="datetime-local" value="' + info.event.startStr + '">' +
                            '<input id="swal-input3" class="swal2-input" placeholder="Nova data de fim" type="datetime-local" value="' + info.event.endStr + '">',
                        focusConfirm: false,
                        showDenyButton: true,
                        denyButtonText: 'Excluir',
                        preConfirm: () => {
                            const title = Swal.getPopup().querySelector('#swal-input1').value;
                            const start = Swal.getPopup().querySelector('#swal-input2').value;
                            const end = Swal.getPopup().querySelector('#swal-input3').value;
                            if (!title || !start || !end) {
                                Swal.showValidationMessage('Por favor, preencha todos os campos');
                            }
                            return { title: title, start: start, end: end };
                        }
                    }).then((result) => {
                        if (!result.isDenied) {
                            // Save event
                            $.ajax({
                                url: 'Scripts/SaveEvents.php',
                                type: 'POST',
                                data: {
                                    id: info.event.id,
                                    title: result.value.title,
                                    start: result.value.start,
                                    end: result.value.end
                                },
                                success: function (response) {
                                    info.event.setProp('title', result.value.title);
                                    info.event.setStart(result.value.start);
                                    info.event.setEnd(result.value.end);
                                    alert('Evento editado com sucesso!');
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                    alert('Erro ao editar evento.');
                                }
                            });
                        } else {
                            // Delete event
                            $.ajax({
                                url: 'Scripts/DeleteEvents.php',
                                type: 'POST',
                                data: { id: info.event.id },
                                success: function (response) {
                                    info.event.remove();
                                    alert('Evento excluído com sucesso!');
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                    alert('Erro ao excluir evento.');
                                }
                            });
                        }
                    });
                }
            });

            calendar.render();

            // Adiciona um ouvinte de evento para o botão 'Salvar Alterações'
            document.getElementById('save-events').addEventListener('click', function () {
                // Obtém todos os eventos do calendário
                var events = calendar.getEvents();

                // Converte os eventos em um formato adequado para envio via AJAX
                var eventData = events.map(function (event) {
                    return {
                        id: event.id,
                        title: event.title,
                        start: event.startStr,
                        end: event.endStr
                    };
                });

                // Envia os dados dos eventos para o script PHP via AJAX
                $.ajax({
                    url: 'Scripts/SaveEvents.php',
                    type: 'POST',
                    data: {
                        events: JSON.stringify(eventData)
                    },
                    success: function (response) {
                        alert('Alterações salvas com sucesso!');
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Erro ao salvar alterações.');
                    }
                });
            });
        });
    </script>
</body>

</html>
