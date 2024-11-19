<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != "admin") {
    include "./logout.php";
    exit();
}

include "../includes/database.php";

$modelName = $_POST['newModelName'];

$sql = "INSERT INTO dynamicSelect (name) VALUES(?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $modelName);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Armazena a mensagem de sucesso na sessão
    $_SESSION['success_message'] = 'Volante inserido com sucesso';
    header('Location: ../registerModel.php');
} else {
    echo "Erro ao inserir o volante";
}

$conn->close();
?>