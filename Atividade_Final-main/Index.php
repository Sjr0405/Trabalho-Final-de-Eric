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
                <h1>Produtos em Promoção</h1>
                <i class="fas fa-cart-shopping"></i>
            </div>

            <section class="main-skills">
                <div class="carousel">
                    <?php
                    $sql = "SELECT Cod_Peca, Nome_Peca, Valor_Venda, Imagem_id FROM Pecas";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card' style='width: 18rem;'>";
                            // Adiciona a imagem da peça
                            echo "<img src='retrieve_image.php?id=" . $row['Imagem_id'] . "' class='card-img-top' style='width: 200px; height: 180px; display: block; margin: 0 auto; text-align: center;'>";
                            echo "<div class='card-body'>";
                            echo "<h4 class='card-title'>" . $row['Nome_Peca'] . "</h4>";
                            echo "<p class='card-text'>de R$ " . $row['Valor_Venda'] . "</p>";
                            echo "<h5 class='card-text'>POR APENAS R$ " . $row['Valor_Venda'] . "</h5>";
                            echo "</div></div>";
                        }
                    } else {
                        echo "<p>Nenhuma peça encontrada</p>";
                    }
                    ?>
                </div>
            </section>

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
        $(document).ready(function() {
            // Configuração do carrossel
            $('.carousel').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            });

            // Evento para atualizar os detalhes da peça selecionada
            $('#codigo_peca').change(function() {
                var codigo_peca = $(this).val();
                var nome_peca = $(this).find('option:selected').text();
                var valor_venda = $(this).find('option:selected').data('valor');
                $('#nome_peca').val(nome_peca);
                $('#valor_venda').val(valor_venda);
            });

            // Evento para adicionar item ao carrinho
            $('#add-to-cart').click(function() {
                var codigo_peca = $('#codigo_peca').val();
                var nome_peca = $('#codigo_peca option:selected').text();
                var valor_venda = $('#codigo_peca option:selected').data('valor');
                var quantidade_disponivel = parseInt($('#codigo_peca option:selected').data('quantidade'));
                var quantidade = $('#quantidade').val();
                var total = valor_venda * quantidade;

                if (quantidade > quantidade_disponivel) {
                    alert("Quantidade indisponível no estoque!");
                    return;
                }

                addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total);
                updateTotal();
            });

            // Função para adicionar item ao carrinho
            function addToCart(codigo_peca, nome_peca, valor_venda, quantidade, total) {
                $('#cart-items').append('<div class="cart-item">' + nome_peca + ' - R$ ' + valor_venda + ' - Quantidade: ' + quantidade + '</div>');
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
                    var itemText = $(this).text().trim();
                    var nomePeca = itemText.split(' - R$ ')[0];
                    var valorVenda = parseFloat(itemText.split(' - R$ ')[1].split(' - Quantidade: ')[0]);
                    var quantidade = parseInt(itemText.split(' - Quantidade: ')[1]);
                    var codPeca = $(this).data('cod-peca');
                    cartItems.push({
                        cod_peca: codPeca,
                        nome_peca: nomePeca,
                        valor_venda: valorVenda,
                        quantidade: quantidade,
                        total: valorVenda * quantidade
                    });
                });
                $.ajax({
                    url: '_script/venda.php',
                    type: 'POST',
                    data: {
                        cart_items: JSON.stringify(cartItems)
                    },
                    success: function(response) {
                        alert(response);
                        $('.cart-item').remove();
                        $('#total-compra').text('Total da compra: R$ 0.00');
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
