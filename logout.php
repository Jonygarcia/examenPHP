<?php
session_start();
if ($_SESSION["user"] == "admin") {
    unset($_SESSION["clientes"]);
    unset($_SESSION["productos"]);
}
unset($_SESSION["user"]);
session_destroy();
header("location:index.php");