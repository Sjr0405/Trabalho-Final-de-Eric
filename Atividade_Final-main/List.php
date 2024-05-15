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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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
        <h1>Produtos em Promoção</h1>
        <i class="fas fa-user-cog"></i>
      </div>

      <section class="main-skills">
        <div class="carousel">
          <div class="card" style="width: 18rem;">
            <img src="./Images/Kit de Embreagem.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
              <h4 class="card-title">Kit Embreagem Valeo 228212.</h4>
              <p class="card-text">de R$ 365,72</p>
              <h5 class="card-text">POR APENAS R$ 349,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./Images/Kit ArCondicionado.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
              <h4 class="card-title">Kit Ar Condicionado Universal Premium Para Diversos Veículos</h4>
              <p class="card-text">de R$ 2699,99</p>
              <h5 class="card-text">POR APENAS R$ 2549,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./Images/Kit de Suspensão.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
              <h4 class="card-title">Kit de Suspensão a Rosca Slim - Completo</h4>
              <p class="card-text">de R$ 1499,99</p>
              <h5 class="card-text">POR APENAS R$ 1249,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./Images/Fonte.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
              <h4 class="card-title">Fonte Automotiva Stetsom Infinite 50A Bivolt Carregador Black</h4>
              <p class="card-text">de R$ 324,99</p>
              <h5 class="card-text">POR APENAS R$ 299,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./Images/Roda Kr Aro 14.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
              <h4 class="card-title">Rodas Tarantula Aro 14 Ford Fiesta Ka</h4>
              <p class="card-text">de R$ 1.739,99</p>
              <h5 class="card-text">POR APENAS R$ 1699,99</h5>
            </div>
          </div>
        </div>
      </section>

      <script>
          $(document).ready(function() {
            $('.carousel').slick({
              slidesToShow: 3, // Quantidade de cards visíveis de uma vez
              slidesToScroll: 1, // Quantidade de cards a rolar
              prevArrow: $('.prev'), // Botão de navegação para anterior
              nextArrow: $('.next'), // Botão de navegação para próximo
              responsive: [{
                breakpoint: 768, // Breakpoint para telas menores
                settings: {
                  slidesToShow: 1 // Reduzir a quantidade de cards visíveis em telas menores
                }
              }]
            });
          });
        </script>

<?php
// Incluir o arquivo de conexão com o banco de dados
include 'Scripts/Database.php';

// Definir a consulta SQL para recuperar os produtos do banco de dados
$sql = "SELECT Cod_Peca, Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade FROM Pecas";

// Executar a consulta SQL
$result = $conn->query($sql);

// Verificar se a consulta retornou resultados
if ($result !== false) {
?>
    <!-- Corpo da página -->
    <h1>Listagem das Peças em Estoque</h1>
    <div class="container">
        <div class="course-box">
            <table class="peca-table">
                <thead>
                    <tr>
                        <th>Cod da Peça</th>
                        <th>Nome da Peça</th>
                        <th>Fornecedor</th>
                        <th>Valor de Compra</th>
                        <th>Valor de Venda</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop através das linhas retornadas pela consulta
                    while ($row = $result->fetch_assoc()) {
                        // Exibir os dados de cada peça em uma linha da tabela
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Cod_Peca"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Nome_Peca"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Fornecedor"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Valor_Compra"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Valor_Venda"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Quantidade"]) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .peca-table {
            border-spacing: 30px;
        }
        .peca-table td,
        .peca-table th {
        }
    </style>
<?php
} else {
    // Se ocorrer um erro na consulta, exibir uma mensagem de erro
    echo "Erro ao executar a consulta: " . htmlspecialchars($conn->error);
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
