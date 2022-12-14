<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <title>MainCliente</title>
</head>

<body>
    <?php
    $user = $_SESSION["user"] ?? "";

    if ($user == "usuario") { ?>
        <nav class="navbar navbar-expand navbar-light bg-light d-flex justify-content-end">
            <div class="nav navbar-nav">
                <a class="nav-item text-white text-decoration-none" href="logout.php"><button class="btn btn-dark mx-2">Cerrar sesión</button></a>
            </div>
        </nav>
        <div class="container col-4 mt-3 text-center">
            <h1 class="text-center mb-5 text-capitalize">Bienvenido <?= $_SESSION["user"] ?></h1>
        </div>
    <?php } else { ?>
        <div class="container col-4 mt-5 text-center">
            <h2>No has iniciado sesión</h2>
            <h6><a href="index.php">Ir al inicio de sesión</a></h6>
        </div>
    <?php } ?>
</body>

</html>