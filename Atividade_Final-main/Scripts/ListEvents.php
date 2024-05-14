<?php
include 'Database.php';

// Prepara a consulta SQL para selecionar todos os eventos
$sql = "SELECT Cod_Evento, Titulo, Data_Inicio, Data_Fim FROM Eventos";

// Executa a consulta SQL
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Array para armazenar os eventos
    $events = array();

    // Itera sobre cada linha de resultado
    while ($row = $result->fetch_assoc()) {
        // Cria um novo array para representar cada evento
        $event = array(
            'id' => $row['Cod_Evento'],
            'title' => $row['Titulo'],
            'start' => $row['Data_Inicio'],
            'end' => $row['Data_Fim']
        );

        // Adiciona o evento ao array de eventos
        array_push($events, $event);
    }

    // Converte o array de eventos para o formato JSON e o imprime
    echo json_encode($events);
} else {
    // Se não houver eventos no banco de dados, retorna uma mensagem de erro
    echo json_encode(array('message' => 'Nenhum evento encontrado.'));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
