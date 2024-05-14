<?php include 'Scripts/Database.php'; ?>
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
        <i class="fas fa-cart-shopping"></i>
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


      <section class="main-course">
        <h1>Tela de Finalização da Compra</h1>
        <div class="course-box">
          <!-- Formulário para finalização da compra -->
          <form action="_script/venda.php" method="post" id="cart-form">
            <!-- Selecione a Peça -->
            <div class="form-group">
              <label for="codigo_peca">Selecione a Peça:</label>
              <select id="codigo_peca" name="codigo_peca[]" class="form-control" required>
                <option disabled selected value="">Selecione...</option>
                <?php
                // Recupera as peças do banco de dados
                $sql = "SELECT Cod_Peca, Nome_Peca, Valor_Venda, Quantidade FROM Pecas";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $disponibilidade = ($row['Quantidade'] > 0) ? '' : ' (Esgotado)';
                    echo "<option value='" . $row['Cod_Peca'] . "' data-valor='" . $row['Valor_Venda'] . "' data-quantidade='" . $row['Quantidade'] . "'>" . $row['Nome_Peca'] . " - R$ " . $row['Valor_Venda'] . $disponibilidade . "</option>";
                  }
                } else {
                  echo "<option value=''>Nenhuma peça encontrada</option>";
                }
                ?>
              </select>
            </div>

            <!-- Detalhes da Peça -->
            <div class="form-group">
              <label for="nome_peca">Nome da Peça:</label>
              <input type="text" id="nome_peca" name="nome_peca[]" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label for="valor_venda">Valor de Venda:</label>
              <input type="number" id="valor_venda" name="valor_venda[]" class="form-control" step="0.01" readonly>
            </div>

            <div class="form-group">
              <label for="quantidade">Quantidade:</label>
              <input type="number" id="quantidade" name="quantidade[]" class="form-control" required>
            </div>

            <!-- Botões -->
            <div class="form-group">
              <button type="button" id="add-to-cart" class="btn btn-primary">Adicionar ao Carrinho</button>
              <button type="submit" id="finalizar-compra" class="btn btn-success" style="display: none;">Finalizar Compra</button>
            </div>

            <!-- Hidden input para armazenar o código da peça -->
            <input type="hidden" id="cod_peca" name="cod_peca[]">
          </form>

          <!-- Carrinho de Compras -->
          <div id="cart-items">
            <!-- Itens do Carrinho serão exibidos aqui -->
          </div>

          <!-- Total da Compra -->
          <div id="total-compra" class="mt-3">
            <!-- Total da Compra será exibido aqui -->
          </div>
        </div>
      </section>
    </section>
  </div>

  <script>
    $(document).ready(function() {
      // Evento para adicionar item ao carrinho
      $('#add-to-cart').click(function() {
        var quantidade_disponivel = parseInt($('#codigo_peca option:selected').data('quantidade'));
        if (quantidade_disponivel <= 0) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Este item está esgotado!',
          });
          return;
        }

        var codigo_peca = $('#codigo_peca').val();
        var nome_peca = $('#codigo_peca option:selected').text();
        var valor_venda = $('#codigo_peca option:selected').data('valor');
        var quantidade = $('#quantidade').val();
        var total = valor_venda * quantidade;

        addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total);
        updateTotal();
        $('#finalizar-compra').show(); // Mostra o botão de finalizar compra

        // Atualiza o banco de dados subtraindo a quantidade comprada do estoque
        $.ajax({
          url: 'Script/Refresh_DB.php',
          type: 'POST',
          data: {
            codigo_peca: codigo_peca,
            quantidade: quantidade
          },
          success: function(response) {
            console.log(response);
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Erro ao atualizar o estoque.');
          }
        });
      });

      // Função para adicionar item ao carrinho
      function addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total) {
        $('#cart-items').append('<div class="cart-item" data-cod-peca="' + codigo_peca + '">' + nome_peca + ' - R$ ' + valor_venda + ' - Quantidade: ' + quantidade + '</div>');
      }

      // Função para atualizar o total da compra
      function updateTotal() {
        var totalCompra = 0;
        $('.cart-item').each(function() {
          var itemText = $(this).text().trim();
          var valorVenda = parseFloat(itemText.split('R$ ')[1].split(' -')[0]);
          var quantidade = parseInt(itemText.split('Quantidade: ')[1]);
          var totalItem = valorVenda * quantidade;
          totalCompra += totalItem;
        });
        $('#total-compra').text('Total da compra: R$ ' + totalCompra.toFixed(2));
      };

      // Evento para enviar o carrinho para finalização de compra
      $('#cart-form').submit(function(e) {
        e.preventDefault();
        var cartItems = [];
        $('.cart-item').each(function() {
          var codigo_peca = $(this).data('cod-peca');
          var itemText = $(this).text().trim();
          var nomePeca = itemText.split(' - R$ ')[0];
          var valorVenda = parseFloat(itemText.split(' - R$ ')[1].split(' - Quantidade: ')[0]);
          var quantidade = parseInt(itemText.split(' - Quantidade: ')[1]);
          cartItems.push({
            cod_peca: codigo_peca,
            nome_peca: nomePeca,
            valor_venda: valorVenda,
            quantidade: quantidade,
            total: valorVenda * quantidade
          });
        });
        $.ajax({
          url: 'Scripts/Sell.php',
          type: 'POST',
          data: {
            cart_items: JSON.stringify(cartItems)
          },
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'Compra Finalizada!',
              text: response,
            }).then((result) => {
              if (result.isConfirmed) {
                $('.cart-item').remove();
                $('#total-compra').text('Total da compra: R$ 0.00');
                $('#finalizar-compra').hide(); // Esconde o botão de finalizar compra
              }
            });
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Erro ao processar a venda.');
          }
        });
      });
    });
  </script>
</body>

</html>
