<?php

include_once "autoload.php";

$user = $_POST["user"] ?? "";
$password = $_POST["password"] ?? "";

if ($user == "usuario" && $password == "usuario") {
    session_start();
    $_SESSION["user"] = $user;
    header("location:mainCliente.php");
} else if ($user == "admin" && $password == "admin"){
    include_once "index5.php";
    session_start();
    $_SESSION["user"] = $user;
    $_SESSION["clientes"] = $vc->listarSocios();
    $_SESSION["productos"] = $vc->listarProductos();
    header("location:mainAdmin.php");
} else {
    header("location:index.php?logged=false");
}