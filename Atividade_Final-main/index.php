<?php include '_script/database.php';
?>
<span style="font-family: verdana, geneva, sans-serif;">
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
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  </head>

  <body>
    <div class="container">
      <nav>
        <ul>
          <li><a href="#" class="logo">
              <img src="imagens/logo.png" alt="Logo da Loja">
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
          <h1>Produtos em Promoção</h1>
          <i class="fas fa-cart-shopping"></i>
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
    <form action="_script/venda.php" method="post" id="cart-form">
      <!-- Selecione a Peça -->
      <div class="form-group">
        <label for="codigo_peca">Selecione a Peça:</label>
        <select id="codigo_peca" name="codigo_peca[]" class="form-control" required>
          <option disabled selected value="">Selecione...</option>
          <?php
          $sql = "SELECT Cod_Peca, Nome_Peca, Valor_Venda, Quantidade FROM Pecas";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['Cod_Peca'] . "' data-valor='" . $row['Valor_Venda'] . "' data-quantidade='" . $row['Quantidade'] . "'>" . $row['Nome_Peca'] . " - R$ " . $row['Valor_Venda'] . "</option>";
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
        <button type="submit" id="finalizar-compra" class="btn btn-success">Finalizar Compra</button>
      </div>
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
      $('#codigo_peca').change(function() {
        var codigo_peca = $(this).val();
        var nome_peca = $(this).find('option:selected').text();
        var valor_venda = $(this).find('option:selected').data('valor');
        $('#nome_peca').val(nome_peca);
        $('#valor_venda').val(valor_venda);
      });

      $('#cart-form').submit(function(e) {
        e.preventDefault(); // Evita o envio padrão do formulário

        // Captura os itens do carrinho
        var cartItems = [];
        $('.cart-item').each(function() {
          var itemText = $(this).text().trim();
          var nomePeca = itemText.split(' - R$ ')[0];
          var valorVenda = parseFloat(itemText.split(' - R$ ')[1].split(' - Quantidade: ')[0]);
          var quantidade = parseInt(itemText.split(' - Quantidade: ')[1]);
          var total = parseFloat((valorVenda * quantidade).toFixed(2));
          var codPeca = $(this).data('cod-peca');

          cartItems.push({
            cod_peca: codPeca,
            nome_peca: nomePeca,
            valor_venda: valorVenda,
            quantidade: quantidade,
            total: total
          });
        });

        // Envia os itens do carrinho para venda.php
        $.ajax({
          url: '_script/venda.php',
          type: 'POST',
          data: {
            cart_items: JSON.stringify(cartItems)
          },
          success: function(response) {
            alert(response); // Exibe a resposta do servidor
            // Limpa o carrinho e atualiza o total da compra
            $('.cart-item').remove();
            $('#total-compra').text('Total da compra: R$ 0.00');
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Erro ao processar a venda.');
          }
        });
      });

      $('#add-to-cart').click(function() {
        var codigo_peca = $('#codigo_peca').val();
        var nome_peca = $('#codigo_peca option:selected').text();
        var valor_venda = $('#codigo_peca option:selected').data('valor');
        var quantidade_disponivel = parseInt($('#codigo_peca option:selected').data('quantidade'));
        var quantidade = $('#quantidade').val();
        var total = valor_venda * quantidade;

        if (quantidade > quantidade_disponivel) {
          alert("Quantidade indisponível no estoque!");
          return; // Evita adicionar ao carrinho se a quantidade não estiver disponível
        }

        addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total);
        updateTotal();
      });

      function addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total) {
        $('#cart-items').append('<div class="cart-item">' + nome_peca + ' - R$ ' + valor_venda + ' - Quantidade: ' + quantidade + '</div>');
      }

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
    </script>
  </body>

  </html>
</span>