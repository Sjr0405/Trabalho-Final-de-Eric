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
            <span class="nav-item">Cadastrar Peças</span>
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
      <div id="modal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Adicionar Evento</h2>
          <form id="add-event-form">
            <label for="event-title">Título:</label>
            <input type="text" id="event-title" name="title" required>
            <label for="event-start">Data de Início:</label>
            <input type="datetime-local" id="event-start" name="start" required>
            <label for="event-end">Data de Término:</label>
            <input type="datetime-local" id="event-end" name="end" required>
            <button type="submit">Adicionar</button>
          </form>
        </div>
      </div>
    </section>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek'
        },
        initialView: 'multiMonthYear',
        themeSystem: 'bootstrap',
        editable: true,
        selectable: true,
        droppable: true,
        events: [
          {
            title: 'All Day Event',
            start: '2023-01-01'
          },
          {
            title: 'Long Event',
            start: '2023-01-07',
            end: '2023-01-10'
          },
          {
            groupId: 999,
            title: 'Repeating Event',
            start: '2023-01-09T16:00:00'
          },
          {
            groupId: 999,
            title: 'Repeating Event',
            start: '2023-01-16T16:00:00'
          },
          {
            title: 'Conference',
            start: '2023-01-11',
            end: '2023-01-13'
          },
          {
            title: 'Meeting',
            start: '2023-01-12T10:30:00',
            end: '2023-01-12T12:30:00'
          },
          {
            title: 'Lunch',
            start: '2023-01-12T12:00:00'
          },
          {
            title: 'Meeting',
            start: '2023-01-12T14:30:00'
          },
          {
            title: 'Happy Hour',
            start: '2023-01-12T17:30:00'
          },
          {
            title: 'Dinner',
            start: '2023-01-12T20:00:00'
          },
          {
            title: 'Birthday Party',
            start: '2023-01-13T07:00:00'
          },
          {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2023-01-28'
          }
        ]
      });

      calendar.render();
    });
  </script>
</body>
</html>