<?php
// Inclui o arquivo de conexão com o banco de dados
include 'Database.php';

// Verifica se o método de requisição é POST e se a chave 'cart_items' está definida
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cart_items'])) {
    // Decodifica os itens do carrinho de compra a partir do JSON de forma segura
    $cart_items = json_decode($_POST['cart_items'], true);

    // Verifica se a decodificação do JSON foi bem-sucedida
    if ($cart_items === null && json_last_error() !== JSON_ERROR_NONE) {
        // Se houver erro na decodificação do JSON, exibe uma mensagem de erro
        http_response_code(400); // Bad Request
        echo "Erro na decodificação do carrinho de compras JSON.";
        exit();
    }

    // Obtém a data atual
    $data_venda = date("Y-m-d");

    // Inicia uma transação
    if (!$conn->begin_transaction()) {
        // Se a transação não puder ser iniciada, exibe uma mensagem de erro
        http_response_code(500); // Internal Server Error
        echo "Erro ao iniciar a transação.";
        exit();
    }

    try {
        // Prepara a inserção da venda na tabela Vendas
        $stmt_venda = $conn->prepare("INSERT INTO Vendas (Data_Venda, Total) VALUES (?, ?)");
        
        // Inicializa o total da venda
        $total_venda = 0;

        // Itera sobre os itens do carrinho para calcular o total da venda
        foreach ($cart_items as $item) {
            // Verifica se as chaves necessárias estão definidas em cada item
            if (isset($item['total'])) {
                $total_venda += $item['total'];
            }
        }

        // Executa a inserção da venda na tabela Vendas
        $stmt_venda->bind_param("sd", $data_venda, $total_venda);
        if (!$stmt_venda->execute()) {
            // Se a execução da inserção falhar, exibe uma mensagem de erro
            throw new Exception("Erro ao inserir venda na tabela Vendas.");
        }
        $cod_venda = $stmt_venda->insert_id;

        // Prepara a inserção dos itens da venda na tabela Itens_Venda
        $stmt_itens = $conn->prepare("INSERT INTO Itens_Venda (Cod_Venda, Cod_Peca, Nome_Peca, Valor_Venda, Quantidade, Total_Item) VALUES (?, ?, ?, ?, ?, ?)");

        // Itera sobre os itens do carrinho para inserir na tabela Itens_Venda
        foreach ($cart_items as $item) {
            // Verifica se as chaves necessárias estão definidas em cada item
            if (isset($item['cod_peca'], $item['nome_peca'], $item['valor_venda'], $item['quantidade'], $item['total'])) {
                $stmt_itens->bind_param("iisdsd", $cod_venda, $item['cod_peca'], $item['nome_peca'], $item['valor_venda'], $item['quantidade'], $item['total']);
                if (!$stmt_itens->execute()) {
                    // Se a execução da inserção falhar, exibe uma mensagem de erro
                    throw new Exception("Erro ao inserir item na tabela Itens_Venda.");
                }
            } else {
                // Se algum dos itens estiver incompleto, exibe uma mensagem de erro
                throw new Exception("Um ou mais itens do carrinho estão incompletos.");
            }
        }

        // Commit da transação
        if (!$conn->commit()) {
            // Se o commit falhar, exibe uma mensagem de erro
            throw new Exception("Erro ao confirmar a transação.");
        }

        // Após o sucesso da transação, atualiza o estoque na tabela Pecas
        $stmt_update_estoque = $conn->prepare("UPDATE Pecas SET Quantidade = Quantidade - ? WHERE Cod_Peca = ?");

        // Itera sobre os itens do carrinho para atualizar o estoque
        foreach ($cart_items as $item) {
            if (isset($item['cod_peca'], $item['quantidade'])) {
                $stmt_update_estoque->bind_param("ii", $item['quantidade'], $item['cod_peca']);
                if (!$stmt_update_estoque->execute()) {
                    // Se a execução da atualização falhar, exibe uma mensagem de erro
                    throw new Exception("Erro ao atualizar o estoque na tabela Pecas.");
                }
            } else {
                // Se algum dos itens estiver incompleto, exibe uma mensagem de erro
                throw new Exception("Um ou mais itens do carrinho estão incompletos.");
            }
        }

        // Exibe mensagem de sucesso
        echo "Venda concluída com sucesso!";
    } catch (Exception $e) {
        // Em caso de erro, faz rollback da transação e exibe uma mensagem de erro
        $conn->rollback();
        http_response_code(500); // Internal Server Error
        echo "Erro ao processar a venda: " . $e->getMessage();
    }
} else {
    // Se não houver itens no carrinho, exibe uma mensagem
    echo "Nenhum item no carrinho.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
