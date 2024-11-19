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
    session_start();
    if (isset($_SESSION['logged']) && $_SESSION['logged'] == "admin")
        include "./views/menu.html";

    ?>

    <?php
    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        exit();
    }
    ?>

    <?php include "./includes/database.php"; ?>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="./controllers/addSteeringWheel.php" method="post">
                    <div class="mb-3">
                        <label for="modelName" class="form-label">Nome do Volante</label>
                        <div class="input-group">
                            <select class="form-select" id="modelName" name="modelName" required>
                                <option value="" selected disabled>Selecione o modelo</option>
                                <?php
                                $sql = "SELECT * FROM dynamicSelect";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhum registro encontrado</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-auto">
            <div class="col-md-10 mx-auto">
                <div class="table-responsive">
                    <table class="table table-striped text-center w-100">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Data de Cadastro</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM steeringWheelList";
                            $result = $conn->query($sql);
                            $count = 0;

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $formattedDate = date("d/m/Y H:i", strtotime($row['current_datetime']));

                                    $count++;

                                    echo "<tr>";
                                    echo "<td>" . $count . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $formattedDate . "</td>";
                                    if (isset($_SESSION['logged']) && $_SESSION['logged'] == "admin") {
                                        echo "<td><a href='./controllers/deleteSteeringWheel.php?id=" . $row['id'] . "' class='btn btn-danger'>Excluir</a></td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Nenhum registro encontrado</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Botões centralizados no final da página -->
        <?php
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == "admin") {
            echo '<div class="row mt-4 justify-content-center">
            <form action="./controllers/generateReport.php" method="POST" class="col-auto">
                <button class="btn btn-success text-white w-100" style="max-width: 200px;">Gerar Relatório</button>
            </form>
            <form action="./controllers/deleteAllSteeringWheels.php" method="POST" class="col-auto ms-2">
                <button class="btn btn-danger text-white w-100" style="max-width: 200px;">Excluir Tudo</button>
            </form>
            </div>';

        }
        ?>
    </div>

</body>

</html>