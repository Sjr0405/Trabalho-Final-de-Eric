<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard | By Code Info</title>
  <link rel="stylesheet" href="CSS/mascara.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- FullCalendar -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
  
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
        <div id='calendar'></div>
      </section>
      <button id="save-events">Salvar Alterações</button>
    </section>
  </div>

  <script type='importmap'>
      {
        "imports": {
          "@fullcalendar/core": "https://cdn.skypack.dev/@fullcalendar/core@6.1.11",
          "@fullcalendar/daygrid": "https://cdn.skypack.dev/@fullcalendar/daygrid@6.1.11"
        }
      }
    </script>


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
          Swal.fire({
            title: 'Novo Evento',
            html: '<input id="swal-input1" class="swal2-input" placeholder="Título do evento">' +
              '<input id="swal-input2" class="swal2-input" placeholder="Data de início" type="datetime-local">' +
              '<input id="swal-input3" class="swal2-input" placeholder="Data de fim" type="datetime-local">',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Salvar',
            cancelButtonText: 'Cancelar',
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
            if (result.isConfirmed) {
              calendar.addEvent({
                title: result.value.title,
                start: result.value.start,
                end: result.value.end,
                allDay: false
              });
              alert('Novo evento registrado!');
            }
          });
        },
        eventClick: function (info) {
          Swal.fire({
            title: 'Editar ou Excluir Evento',
            html: '<input id="swal-input1" class="swal2-input" placeholder="Novo título" value="' + info.event.title + '">' +
              '<input id="swal-input2" class="swal2-input" placeholder="Nova data de início" type="datetime-local" value="' + info.event.startStr + '">' +
              '<input id="swal-input3" class="swal2-input" placeholder="Nova data de fim" type="datetime-local" value="' + info.event.endStr + '">',
            focusConfirm: false,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Salvar Alterações',
            denyButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
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
            if (result.isConfirmed) {
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
            } else if (result.isDenied) {
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

      document.getElementById('save-events').addEventListener('click', function () {
        var events = calendar.getEvents();
        var eventData = events.map(function (event) {
          return {
            id: event.id,
            title: event.title,
            start: event.startStr,
            end: event.endStr
          };
        });

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
