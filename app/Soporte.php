<?php

namespace app;

/*
* Ejercicio 5:
* Hacemos abstracta la clase Soporte, esto no permitirá crear objetos de tipo
* Soporte pero si podremos seguir trabajando creando objetos de sus clases hijas
* y utilizando sus métodos. Para que todo funcione correctamente tenemos que comentar
* las primeras líneas del index1, para así evitar crear un objeto Soporte.
*/

/*
* Ejercicio 6:
* Implementamos la interfaz Resumible para obligar a que esta clase tenga un método
* muestraResumen(), no es necesario que sus clases hijas la implementen, ya que las 
* interfaces soportan herencias. 
*/

include_once "autoload.php";

abstract class Soporte implements Resumible
{
    public $titulo;
    protected $numero;
    private $precio;
    private const IVA = 0.21;
    public $alquilado = false;

    public function __construct($titulo, $numero, $precio)
    {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPrecioConIva()
    {
        return $this->precio + ($this->precio * self::IVA);
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function muestraResumen()
    {
        return "</br><strong>" . $this->titulo . "</strong><br>
            Número: " . $this->numero . "<br>
            Alquilado: " . ($this->alquilado ? "Si" : "No") . "<br
            Precio: " . $this->precio . " €<br>
            Precio IVA incluido: " . $this->getPrecioConIva() . " €<br>";
    }
}
