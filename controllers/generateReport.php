<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != "admin") {
    include "./logout.php";
    exit();
}

require '../vendor/autoload.php'; // Carrega o autoload do Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Incluindo a conexão com o banco de dados
include "../includes/database.php";

$sql = "SELECT * FROM steeringWheelList";
$result = $conn->query($sql);

// Cria uma nova planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Definindo os cabeçalhos da planilha
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nome');
$sheet->setCellValue('C1', 'Data de Cadastro');

date_default_timezone_set('America/Sao_Paulo');
$dateNow = date('d/m/Y');

// Preenchendo os dados da tabela
$rowNum = 2; // Começa na linha 2, pois a 1 é de cabeçalho
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedDate = date("d/m/Y H:i", strtotime($row['current_datetime']));
        $sheet->setCellValue('A' . $rowNum, $rowNum - 1); // ID incremental
        $sheet->setCellValue('B' . $rowNum, $row['name']);
        $sheet->setCellValue('C' . $rowNum, $formattedDate);
        $rowNum++;
    }
}

// Configurações para exportar a planilha
$writer = new Xlsx($spreadsheet);
$fileName = 'Planilha-Volantes' . $dateNow . '.xlsx';

// Envia o cabeçalho para download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

// Força o download do arquivo
$writer->save('php://output');

// Fecha a conexão
$conn->close();
exit;
?>