<?php
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != "admin") {
    include "./logout.php";
    exit();
}

include "../includes/database.php";

$sql = "DELETE FROM steeringWheelList WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header('Location: ../index.php');
} else {
    echo "Erro ao excluir o volante";
}

$conn->close();

?>