<span style="font-family: verdana, geneva, sans-serif;">
  <!DOCTYPE html>

  <head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Code Info</title>
    <link rel="stylesheet" href="style/styles.css" />
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
              <img src="imagens/logo.png" alt="">
              <span class="nav-item">Autopeças</span>
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
          <i class="fas fa-user-cog"></i>
        </div>
        

      <section class="main-skills">
        <div class="carousel">
          <div class="card" style="width: 18rem;">
            <img src="./imagens/Kit de Embreagem.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
              <h4 class="card-title">Kit Embreagem Valeo 228212.</h4>
              <p class="card-text">de R$ 365,72</p>
              <h5 class="card-text">POR APENAS R$ 349,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./imagens/Kit ArCondicionado.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
            <h4 class="card-title">Kit Ar Condicionado Universal Premium Para Diversos Veículos</h4>
            <p class="card-text">de R$ 2699,99</p>
            <h5 class="card-text">POR APENAS R$ 2549,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./imagens/Kit de Suspensão.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
            <h4 class="card-title">Kit de Suspensão a Rosca Slim - Completo</h4>
            <p class="card-text">de R$ 1499,99</p>
            <h5 class="card-text">POR APENAS R$ 1249,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./imagens/Fonte.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
            <h4 class="card-title">Fonte Automotiva Stetsom Infinite 50A Bivolt Carregador Black</h4>
            <p class="card-text">de R$ 324,99</p>
            <h5 class="card-text">POR APENAS R$ 299,99</h5>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <img src="./imagens/Roda Kr Aro 14.png" class="card-img-top" style="width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;">
            <div class="card-body">
              <h4 class="card-title">Rodas Tarantula Aro 14 Ford Fiesta Ka</h4>
              <p class="card-text">de R$ 1.739,99</p>
              <h5 class="card-text">POR APENAS R$ 1699,99</h5>
        </div>
      </section>
      
        <script> $(document).ready(function() {
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
        <h1>Cadastro de Peças</h1>
          <div class="course-box">
            <form action="_script/cadastro.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome da Peça:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" required>
            </div>

            <div class="form-group">
                <label for="valor_compra">Valor de Compra:</label>
                <input type="number" id="valor_compra" name="valor_compra" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="valor_venda">Valor de Venda:</label>
                <input type="number" id="valor_venda" name="valor_venda" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" required>
            </div>

            <!-- Botão de upload de arquivo -->
            <div class="form-group">
                <label for="customFile" class="upload-button">
                    <input type="file" class="custom-file-input" id="customFile" onchange="updateFileName(this)" required></input>
                </label>
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary pt-5">Cadastrar</button>
            </form>
          </div>
      </section>
    </body>
  </html>
</span>