<?php

spl_autoload_register(function ($nombreClase) {
    $ruta = str_replace("app\\", "", $nombreClase);

    include_once($ruta . ".php");
});
