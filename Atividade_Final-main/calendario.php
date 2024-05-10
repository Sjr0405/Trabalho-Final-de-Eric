<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard | By Code Info</title>
  <link rel="stylesheet" href="style/styles.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- FullCalendar -->
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css' rel='stylesheet' />
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js'></script>
</head>

<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
            <img src="imagens/logo.png" alt="">
            <span class="nav-item">AutoPeças</span>
          </a></li>
        <li><a href="index.php">
            <i class="fas fa-home"></i>
            <span class="nav-item">Home</span>
          </a></li>
        <li><a href="cadastro_pecas.php">
            <i class="fas fa-user"></i>
            <span class="nav-item">Cadastrar Peças</span>
          </a></li>
        <li><a href="listagem_pecas.php">
            <i class="fas fa-list"></i>
            <span class="nav-item">Estoque</span>
          </a></li>
        <li><a href="calendario.php">
            <i class="fas fa-calendar"></i>
            <span class="nav-item">Calendario</span>
          </a></li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
        <h1>Produtos</h1>
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

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          var calendarEl = document.getElementById('calendar');

          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Exibir o calendário no modo mês
            events: <?php echo get_events_from_database(); ?> // Função PHP para recuperar eventos do banco de dados
          });

          calendar.render();

          // Captura o clique do usuário em uma data do calendário
          calendarEl.addEventListener('click', function (e) {
            // Abre o modal de adição de evento
            document.getElementById('modal').style.display = 'block';
          });

          // Fecha o modal quando o usuário clica no botão de fechar
          document.querySelector('.close').addEventListener('click', function () {
            document.getElementById('modal').style.display = 'none';
          });

          // Adiciona um novo evento ao calendário quando o formulário é enviado
          document.getElementById('add-event-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Evita o comportamento padrão do formulário

            // Recupera os valores do formulário
            var title = document.getElementById('event-title').value;
            var start = document.getElementById('event-start').value;
            var end = document.getElementById('event-end').value;

            // Adiciona o evento ao calendário
            add_event_to_calendar(title, start, end);

            // Fecha o modal
            document.getElementById('modal').style.display = 'none';
          });
        });

        // Função PHP para recuperar eventos do banco de dados e formatá-los para o FullCalendar
        function get_events_from_database() {
          // Implemente sua função para recuperar eventos do banco de dados aqui
        }

        // Função PHP para adicionar um novo evento ao calendário
        function add_event_to_calendar(title, start, end) {
          // Implemente sua função para adicionar eventos ao banco de dados aqui
        }
      </script>
    </section>
  </div>
</body>

</html>
