<?php
// Inclui o arquivo de conexão com o banco de dados
include 'Database.php';

// Query SQL para selecionar todos os eventos da tabela Eventos
$sql = "SELECT * FROM Eventos";

// Executa a consulta SQL
$result = $conn->query($sql);

// Array para armazenar os eventos
$events = array();

// Verifica se a consulta foi bem-sucedida
if ($result) {
    // Se a consulta retornou pelo menos uma linha
    if ($result->num_rows > 0) {
        // Enquanto houver linhas de resultados
        while ($row = $result->fetch_assoc()) {
            // Adiciona o evento ao array de eventos
            $events[] = $row;
        }
    }
}

// Retorna os eventos como JSON
echo json_encode($events);
?>
