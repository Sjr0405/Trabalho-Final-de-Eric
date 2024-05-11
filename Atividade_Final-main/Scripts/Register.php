<?php
include 'Database.php';

function updateStockQuantity($conn, $cod_peca, $quantidade) {
    // Preparar a consulta SQL para atualizar a quantidade em estoque
    $sql_update = "UPDATE Pecas SET Quantidade = Quantidade + ? WHERE Cod_Peca = ?";
    $stmt_update = $conn->prepare($sql_update);
    // Vincular os parâmetros da consulta
    $stmt_update->bind_param("ii", $quantidade, $cod_peca);
    // Executar a consulta preparada
    $stmt_update->execute();
    // Fechar a consulta preparada
    $stmt_update->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e filtrar os dados recebidos do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $fornecedor = filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING);
    $valor_compra = filter_input(INPUT_POST, 'valor_compra', FILTER_VALIDATE_FLOAT);
    $valor_venda = filter_input(INPUT_POST, 'valor_venda', FILTER_VALIDATE_FLOAT);
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);

    // Verificar se todos os campos obrigatórios foram preenchidos e são válidos
    if ($nome && $fornecedor && $valor_compra !== false && $valor_venda !== false && $quantidade !== false) {
        // Consultar se a peça já existe no banco de dados
        $sql_check = "SELECT Cod_Peca, Quantidade FROM Pecas WHERE Nome_Peca = ? AND Fornecedor = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ss", $nome, $fornecedor);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        // Se a peça já existe, atualizar a quantidade em estoque
        if ($result_check->num_rows > 0) {
            $row = $result_check->fetch_assoc();
            updateStockQuantity($conn, $row['Cod_Peca'], $quantidade);
        } else { // Se a peça não existe, inserir uma nova peça
            $sql_insert = "INSERT INTO Pecas (Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sssdd", $nome, $fornecedor, $valor_compra, $valor_venda, $quantidade);
            if ($stmt_insert->execute()) {
                // Redirecionar para a página de cadastro de peças
                header("Location: cadastro_pecas.php");
                exit();
            } else {
                echo "Erro ao cadastrar a peça: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        }

        // Fechar a consulta preparada
        $stmt_check->close();
    } else {
        // Se algum campo estiver faltando ou inválido, exibir uma mensagem de erro
        echo "Erro: Todos os campos devem ser preenchidos corretamente.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
