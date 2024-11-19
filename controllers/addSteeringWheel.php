<?php
include "../includes/database.php";

date_default_timezone_set('America/Sao_Paulo');

$modelName = $_POST['modelName'];
$now = date('Y-m-d H:i:s');


$sql = "INSERT INTO steeringWheelList (name, current_datetime) VALUES(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $modelName, $now);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header('Location: ../index.php');
} else {
    echo "Erro ao inserir o volante";
}

$conn->close();


?>