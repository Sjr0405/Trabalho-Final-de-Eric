<?php
// Inclui o arquivo de conexão com o banco de dados
include 'Database.php';

// Verifica se a requisição foi feita via método POST e se o código da peça foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cod_peca'])) {
    // Obtém e filtra o código da peça enviado via POST para evitar injeção de SQL e XSS
    $cod_peca = filter_input(INPUT_POST, 'cod_peca', FILTER_SANITIZE_NUMBER_INT);

    // Verifica se o código da peça é um número inteiro válido e não vazio
    if ($cod_peca !== false && $cod_peca !== null) {
        // Consulta as informações da peça no banco de dados, incluindo o campo 'Imagem'
        $query = "SELECT Nome_Peca, Valor_Venda, Imagem FROM Pecas WHERE Cod_Peca = ? LIMIT 1";
        $stmt = $conn->prepare($query);

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt) {
            // Associa o código da peça ao parâmetro da consulta e executa a consulta
            $stmt->bind_param("i", $cod_peca);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se a consulta retornou algum resultado
            if ($result && $result->num_rows == 1) {
                // Obtém os dados da peça encontrada
                $row = $result->fetch_assoc();

                // Retorna os dados da peça, incluindo o caminho da imagem, como um JSON
                echo json_encode(array(
                    'nome_peca' => $row['Nome_Peca'],
                    'valor_venda' => $row['Valor_Venda'],
                    'imagem' => $row['Imagem']
                ));
            } else {
                // Se a peça não for encontrada, retorna um JSON vazio
                echo json_encode(array());
            }

            // Libera os recursos
            $stmt->close();
        } else {
            // Se a preparação da consulta falhou, retorna um JSON vazio
            echo json_encode(array());
        }
    } else {
        // Se o código da peça não for um número inteiro válido, retorna um JSON vazio
        echo json_encode(array());
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Se a requisição não foi feita via método POST ou se o código da peça não foi enviado, retorna um JSON vazio
    echo json_encode(array());
}
?>
