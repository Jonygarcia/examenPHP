<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <title>Inicio de sesión</title>
</head>

<body>
    <div class="container col-2 mt-5">
        <h3 class="text-center mb-3">Inicio de sesión</h3>
        <form action="login.php" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" name="user" class="form-control" placeholder="Nombre de usuario" required />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required />
            </div>
            <h6 class="mb-2 text-danger">
                <?php if (isset($_GET['logged']) && $_GET['logged'] == "false") echo "Usuario o contraseña incorrecto"; ?>
            </h6>
            <div class="text-center">
                <input type="submit" name="submit" value="Iniciar Sesión" class="btn btn-primary btn-block mb-4" />
            </div>
        </form>
    </div>
</body>

</html>