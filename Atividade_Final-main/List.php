<?php
include 'Scripts/Select.php';
?>

<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Code Info</title>
    <link rel="stylesheet" href="CSS/mascara.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  </head>

  <body>
    <div class="container">
    <nav>
        <ul>
          <li><a href="#" class="logo">
              <img src="Imagens/logo.png" alt="">
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
          <h1>Produtos</h1>
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

        <section class="main-course">
          <h1>Listagem das Peças em Estoque</h1>
          <div class="course-box">
            <table>
              <thead>
                <tr>
                  <th>Nome da Peça</th>
                  <th>Fornecedor</th>
                  <th>Valor de Compra</th>
                  <th>Valor de Venda</th>
                  <th>Quantidade</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Verifica se há linhas retornadas pela consulta
                if ($result && $result->num_rows > 0) {
                  // Loop através das linhas retornadas
                  while ($row = $result->fetch_assoc()) {
                    // Exibe os dados da peça em cada linha da tabela
                    echo "<tr>";
                    echo "<td>" . $row["Nome_Peca"] . "</td>";
                    echo "<td>" . $row["Fornecedor"] . "</td>";
                    echo "<td>" . $row["Valor_Compra"] . "</td>";
                    echo "<td>" . $row["Valor_Venda"] . "</td>";
                    echo "<td>" . $row["Quantidade"] . "</td>";
                    echo "</tr>";
                  }
                } else {
                  // Se não houver linhas retornadas
                  echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </section>
        
    </div>
  </body>

  </html>

  <?php
  // Fecha a conexão com o banco de dados
  $conn->close();
  ?>

  </html>
</span>