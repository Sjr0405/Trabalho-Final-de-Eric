<?php
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se foram passados os parâmetros necessários
    if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["start"]) && isset($_POST["end"])) {
        // Inclui o arquivo de conexão com o banco de dados
        include 'Database.php';

        // Obtém os dados enviados via POST
        $id = $_POST["id"];
        $title = $_POST["title"];
        $start = $_POST["start"];
        $end = $_POST["end"];

        // Prepara a instrução SQL para atualizar o evento no banco de dados
        $stmt = $conn->prepare("UPDATE Eventos SET Titulo = ?, Data_Inicio = ?, Data_Fim = ? WHERE Cod_Evento = ?");

        // Associa os parâmetros da instrução SQL com os dados recebidos via POST
        $stmt->bind_param("sssi", $title, $start, $end, $id);

        // Executa a instrução SQL para atualizar o evento no banco de dados
        if ($stmt->execute()) {
            // Retorna uma resposta de sucesso
            echo json_encode(array("status" => "success", "message" => "Evento editado com sucesso!"));
        } else {
            // Retorna uma resposta de erro
            echo json_encode(array("status" => "error", "message" => "Erro ao editar evento: " . $stmt->error));
        }

        // Fecha a instrução e a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    } elseif (isset($_POST["id"]) && isset($_POST["action"]) && $_POST["action"] == "delete") {
        // Inclui o arquivo de conexão com o banco de dados
        include 'Database.php';

        // Obtém o ID do evento enviado via POST
        $id = $_POST["id"];

        // Prepara a instrução SQL para excluir o evento do banco de dados
        $stmt = $conn->prepare("DELETE FROM Eventos WHERE Cod_Evento = ?");

        // Associa o parâmetro da instrução SQL com o ID do evento
        $stmt->bind_param("i", $id);

        // Executa a instrução SQL para excluir o evento do banco de dados
        if ($stmt->execute()) {
            // Retorna uma resposta de sucesso
            echo json_encode(array("status" => "success", "message" => "Evento excluído com sucesso!"));
        } else {
            // Retorna uma resposta de erro
            echo json_encode(array("status" => "error", "message" => "Erro ao excluir evento: " . $stmt->error));
        }

        // Fecha a instrução e a conexão com o banco de dados
        $stmt->close();
        $conn->close();
    } else {
        // Parâmetros incompletos ou ação inválida
        echo json_encode(array("status" => "error", "message" => "Parâmetros incompletos ou ação inválida!"));
    }
} else {
    // Método de requisição inválido
    echo json_encode(array("status" => "error", "message" => "Método de requisição inválido!"));
}
?>
