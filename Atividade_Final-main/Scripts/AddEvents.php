<?php
// Verifica se os dados do evento foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'], $_POST['start'], $_POST['end'])) {
    // Captura os dados do evento
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Inclui o arquivo de conexão com o banco de dados
    include 'Database.php';

    // Insere o evento no banco de dados
    $sql = "INSERT INTO Eventos (Titulo, Data_Inicio, Data_Fim) VALUES ('$title', '$start', '$end')";

    if ($conn->query($sql) === TRUE) {
        // Retorna uma resposta JSON de sucesso
        echo json_encode(array('success' => true, 'message' => 'Evento adicionado com sucesso.'));
    } else {
        // Retorna uma resposta JSON de erro, se aplicável
        echo json_encode(array('success' => false, 'message' => 'Erro ao adicionar evento: ' . $conn->error));
    }
} else {
    // Retorna uma resposta JSON de erro se os dados do evento não forem recebidos corretamente
    echo json_encode(array('success' => false, 'message' => 'Dados de evento inválidos.'));
}
?>
