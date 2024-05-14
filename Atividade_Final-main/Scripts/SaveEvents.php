<?php
include 'Database.php';

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os eventos enviados via POST
    $events = json_decode($_POST['events'], true);

    // Prepara a instrução SQL para inserir ou atualizar os eventos no banco de dados
    $stmt = $conn->prepare("INSERT INTO Eventos (Titulo, Data_Inicio, Data_Fim) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE Titulo=VALUES(Titulo), Data_Inicio=VALUES(Data_Inicio), Data_Fim=VALUES(Data_Fim)");

    // Percorre cada evento e executa a instrução SQL
    foreach ($events as $event) {
        $stmt->bind_param("sss", $event['title'], $event['start'], $event['end']);
        $stmt->execute();
    }

    // Fecha a instrução
    $stmt->close();

    // Retorna uma mensagem de sucesso
    echo json_encode(array("message" => "Alterações salvas com sucesso."));
} else {
    // Se o método de requisição não for POST, retorna uma mensagem de erro
    echo json_encode(array("message" => "Método de requisição inválido."));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
