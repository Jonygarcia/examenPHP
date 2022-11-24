<?php

spl_autoload_register(function ($nombreClase) {
    $ruta = str_replace("\\", "/", $nombreClase);
    include_once($ruta . ".php");
});
