<?php
include 'Database.php';

$sql = "SELECT Nome_Peca, Fornecedor, Valor_Compra, Valor_Venda, Quantidade, Imagem_id FROM Pecas";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Nome: " . htmlspecialchars($row["Nome_Peca"]) . " - Fornecedor: " . htmlspecialchars($row["Fornecedor"]) . "<br>";
        }
        $result->free();
    } else {
        echo "Nenhuma peça encontrada na tabela.";
    }
} else {
    echo "Erro ao executar a consulta: " . htmlspecialchars($conn->error);
}

$conn->close();
?>
