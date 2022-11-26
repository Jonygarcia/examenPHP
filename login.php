<?php

$user = $_POST["user"] ?? "";
$password = $_POST["password"] ?? "";

if ($user === "usuario" && $password === "usuario") {
    session_start();
    $_SESSION["user"] = $user;
    header("location:mainCliente.php");
} else if ($user === "admin" && $password === "admin"){
    session_start();
    $_SESSION["user"] = $user;
    header("location:mainAdmin.php");
} else {
    header("location:index.php?logged=false");
}