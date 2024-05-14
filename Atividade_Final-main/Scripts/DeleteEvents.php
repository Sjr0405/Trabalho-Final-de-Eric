<?php
include 'Database.php';

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o parâmetro 'id' foi recebido via POST
    if (isset($_POST['id'])) {
        // Remove o evento com o ID especificado do banco de dados
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM Eventos WHERE Cod_Evento = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Retorna uma mensagem de sucesso se a exclusão for bem-sucedida
            echo json_encode(array("message" => "Evento excluído com sucesso."));
        } else {
            // Retorna uma mensagem de erro se ocorrer um problema ao excluir o evento
            echo json_encode(array("message" => "Erro ao excluir evento."));
        }
        // Fecha a instrução
        $stmt->close();
    } else {
        // Retorna uma mensagem de erro se o parâmetro 'id' não for recebido
        echo json_encode(array("message" => "ID do evento não especificado."));
    }
} else {
    // Se o método de requisição não for POST, retorna uma mensagem de erro
    echo json_encode(array("message" => "Método de requisição inválido."));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
