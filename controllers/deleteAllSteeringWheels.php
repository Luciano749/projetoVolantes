<?php
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != "admin") {
    include "./logout.php";
    exit();
}

include "../includes/database.php";

$sql = "DELETE FROM steeringWheelList where id > 0";
$result = $conn->query($sql);

if ($result) {
    header("Location: ../index.php");
} else {
    echo "Erro ao deletar os registros: " . $conn->error;
}

$conn->close();
?>