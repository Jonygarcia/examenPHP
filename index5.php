<?php
include_once "autoload.php"; // No incluimos nada más

use app\Soporte;
use app\VideoClub;

$vc = new Videoclub("Severo 8A");

//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente", 4.5, "es", "16:9");
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en", "16:9");
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);

//listo los productos 
$vc->listarProductos();

//voy a crear algunos socios 
$vc->incluirSocio("Amancio Ortega");
$vc->incluirSocio("Pablo Picasso", 2);

/* 
! He cambiado el número de socio 1 al 2 para las siguientes comprobaciones, 
! ya que lo tengo diseñado para que los identificadores comiencen desde 1 y no desde 0
*/
//? $vc->alquilaSocioProducto(2, 2);
//? $vc->alquilaSocioProducto(2, 3);
//alquilo otra vez el soporte 2 al socio 1. 
// no debe dejarme porque ya lo tiene alquilado 
//? $vc->alquilaSocioProducto(2, 2);
//alquilo el soporte 6 al socio 1. 
//no se puede porque el socio 1 tiene 2 alquileres como máximo 
//? $vc->alquilaSocioProducto(2, 6);
// alquilar con métodos encadenados
//? $vc->alquilaSocioProducto(2, 8)->alquilaSocioProducto(2, 3)->alquilaSocioProducto(2, 2)->alquilaSocioProducto(2, 6);

// alquilar varios productos con métodos encadenados
$vc->alquilarSocioProductos(1, [2, 4, 5])->alquilarSocioProductos(2, [1, 3]);

$vc->devolverSocioProducto(1, 2);

$vc->devolverSocioProductos(2, [1, 3]);

//listo los socios 
// echo $vc->listarSocios();
