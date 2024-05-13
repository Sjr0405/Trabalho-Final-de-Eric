<?php
// Verifica se o arquivo atual foi acessado diretamente
if (!defined('ABSPATH')) {
    exit; // Impede o acesso direto ao arquivo
}

// Inclui o arquivo de conexão com o banco de dados
include 'Database.php';

// Verifica se a conexão foi estabelecida com sucesso
if ($conn === false) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Query SQL para selecionar todas as peças da tabela Pecas
$sql = "SELECT Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade, Imagem_id FROM Pecas";

// Executa a consulta SQL com a conexão segura
$result = $conn->query($sql);

// Verifica se a consulta foi bem-sucedida
if ($result) {
    // Se a consulta retornou pelo menos uma linha
    if ($result->num_rows > 0) {
        // Enquanto houver linhas de resultados
        while ($row = $result->fetch_assoc()) {
            // Processa cada linha de resultado aqui
            // Por exemplo, você pode imprimir os valores ou fazer outra coisa com eles
            echo "Nome: " . htmlspecialchars($row["Nome_Peca"]) . " - Fornecedor: " . htmlspecialchars($row["Fornecedor"]) . "<br>";
        }
        // Libera o resultado
        $result->free();
    } else {
        // Se não houver linhas de resultado, você pode lidar com isso aqui
        echo "Nenhuma peça encontrada na tabela.";
    }
} else {
    // Se a consulta falhar, você pode lidar com isso aqui
    echo "Erro ao executar a consulta: " . htmlspecialchars($conn->error);
}

// Fecha a conexão com o banco de dados de forma segura
$conn->close();
?>
