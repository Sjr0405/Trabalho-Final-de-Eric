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
        <h1>Cadastro de Peças</h1>
        <div class="course-box">
          <form action="./Scripts/Register.php" method="post" enctype="multipart/form-data" id="register-form">
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
              <input type="number" id="valor_compra" name="valor_compra" step="0.10" required>
            </div>

            <div class="form-group">
              <label for="valor_venda">Valor de Venda:</label>
              <input type="number" id="valor_venda" name="valor_venda" step="0.10" required>
            </div>

            <div class="form-group">
              <label for="quantidade">Quantidade:</label>
              <input type="number" id="quantidade" name="quantidade" required>
            </div>

            <div class="form-group">
              <label for="customFile" class="upload-button">
                Selecione uma Imagem:
                <input type="file" class="custom-file-input" id="customFile" name="imagem" onchange="previewImage(this)" required>
              </label>
            </div>

            <div class="form-group">
              <img id="preview" src="#" alt="Imagem selecionada" style="display:none; max-width:200px; max-height:200px;" />
            </div>

            <button type="submit" class="btn btn-primary pt-5">Cadastrar</button>
          </form>
        </div>
      </section>
    </section>
  </div>

  <script>
    function previewImage(input) {
      var file = input.files[0];
      var preview = document.getElementById('preview');

      if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
      } else {
        preview.style.display = 'none';
      }
    }

    $(document).ready(function() {
      $('#register-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'Cadastro realizado com sucesso!',
              showConfirmButton: false,
              timer: 1500
            });
            $('#register-form')[0].reset();
            $('#preview').css('display', 'none');
          },
          error: function(xhr, status, error) {
            Swal.fire({
              icon: 'error',
              title: 'Erro ao cadastrar peça',
              text: 'Por favor, tente novamente mais tarde.'
            });
          },
          cache: false,
          contentType: false,
          processData: false
        });
      });
    });
  </script>
</body>

</html>
