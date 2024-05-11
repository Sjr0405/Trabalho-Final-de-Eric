<?php
// Inclui o arquivo de conexão com o banco de dados
include 'Database.php';

// Função para retornar os dados da peça em formato JSON
function getItemData($conn, $cod_peca) {
    // Verifica se o código da peça é um número inteiro válido
    if (!is_numeric($cod_peca) || $cod_peca <= 0) {
        return array(); // Retorna um array vazio se o código da peça for inválido
    }

    // Consulta as informações da peça no banco de dados
    $query = "SELECT Nome_Peca, Valor_Venda FROM Pecas WHERE Cod_Peca = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cod_peca);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        // Verifica se a peça foi encontrada
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array(
                'nome_peca' => $row['Nome_Peca'],
                'valor_venda' => $row['Valor_Venda']
            );
        } else {
            return array(); // Retorna um array vazio se a peça não for encontrada
        }
    } else {
        return array(); // Retorna um array vazio se a consulta falhar
    }
}

// Verifica se o código da peça foi enviado via POST e é um número inteiro
if (isset($_POST['cod_peca'])) {
    $cod_peca = $_POST['cod_peca'];
    // Retorna os dados da peça como um JSON
    echo json_encode(getItemData($conn, $cod_peca));
} else {
    // Se o código da peça não foi enviado, retorna um JSON vazio
    echo json_encode(array());
}
?>
