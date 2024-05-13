<?php
// Inclui o arquivo de conexão com o banco de dados
include 'Database.php';

// Verifica se os dados do carrinho foram recebidos
if(isset($_POST['cart_items'])) {
    // Decodifica os itens do carrinho enviados como JSON
    $cartItems = json_decode($_POST['cart_items'], true);

    // Inicia a transação
    mysqli_autocommit($conn, false);

    // Flag para indicar se ocorreu um erro
    $error = false;

    // Itera sobre os itens do carrinho
    foreach($cartItems as $item) {
        // Obtém os detalhes do item
        $codPeca = $item['cod_peca'];
        $quantidade = $item['quantidade'];

        // Atualiza o estoque da peça no banco de dados
        $updateQuery = "UPDATE Pecas SET Quantidade = Quantidade - $quantidade WHERE Cod_Peca = $codPeca";
        if(!mysqli_query($conn, $updateQuery)) {
            $error = true;
            break;
        }
    }

    // Verifica se ocorreu algum erro durante a atualização do estoque
    if($error) {
        // Se ocorreu um erro, reverte a transação
        mysqli_rollback($conn);
        echo "Erro ao atualizar o estoque. A venda não pôde ser concluída.";
    } else {
        // Se não houve erro, confirma a transação
        mysqli_commit($conn);

        // Insere os detalhes da venda na tabela de vendas
        // Aqui você precisa implementar o código para inserir os detalhes da venda em uma tabela de vendas no seu banco de dados
        // Por exemplo:
        // $insertQuery = "INSERT INTO Vendas (Cod_Peca, Quantidade, Valor_Venda) VALUES (...)";

        // Exemplo de resposta de sucesso
        echo "Venda concluída com sucesso!";
    }
} else {
    // Se os dados do carrinho não foram recebidos, retorna uma mensagem de erro
    echo "Dados do carrinho não foram recebidos.";
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
