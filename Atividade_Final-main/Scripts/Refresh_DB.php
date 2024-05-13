<?php
// Inclua o arquivo de conexão com o banco de dados
include 'Database.php';

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os parâmetros foram recebidos
    if (isset($_POST['codigo_peca']) && isset($_POST['quantidade'])) {
        // Recupera os valores enviados por POST
        $codigo_peca = $_POST['codigo_peca'];
        $quantidade = $_POST['quantidade'];

        // Verifica se os arrays têm o mesmo tamanho
        if (count($codigo_peca) == count($quantidade)) {
            // Loop através dos códigos de peça e quantidades
            for ($i = 0; $i < count($codigo_peca); $i++) {
                // Atualiza a quantidade disponível no banco de dados
                $sql = "UPDATE Pecas SET Quantidade = Quantidade + ? WHERE Cod_Peca = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $quantidade[$i], $codigo_peca[$i]);
                if ($stmt->execute()) {
                    // Atualização bem-sucedida
                    echo "Estoque atualizado com sucesso!";
                } else {
                    // Erro na atualização
                    echo "Erro ao atualizar o estoque.";
                }
            }
        } else {
            // Arrays de tamanhos diferentes
            echo "Erro: os arrays de código de peça e quantidade têm tamanhos diferentes.";
        }
    } else {
        // Parâmetros ausentes
        echo "Erro: parâmetros ausentes.";
    }
} else {
    // Método de requisição incorreto
    echo "Este script só aceita solicitações POST.";
}
?>
