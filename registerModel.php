<?php
session_start();

// Verifica se existe uma mensagem de sucesso e exibe o alerta
if (isset($_SESSION['success_message'])) {
    echo "<script language='javascript'>";
    echo "alert('" . $_SESSION['success_message'] . "');";
    echo "</script>";

    // Limpa a mensagem após exibir o alerta
    unset($_SESSION['success_message']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="./img/steeringwheel_volante_4527.ico">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_SESSION['logged']) && $_SESSION['logged'] == "admin")
        include "./views/menu.html";

    ?>

    <?php
    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        exit();
    } else if ($_SESSION['logged'] != "admin") {
        header("Location: index.php");
        exit();
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="./controllers/addNewModel.php" method="post">
                    <div class="mb-3">
                        <label for="newModelName" class="form-label">Nome do Volante</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="newModelName" name="newModelName"
                                placeholder="Digite o modelo" required>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>