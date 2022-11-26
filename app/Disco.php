<?php

namespace app;

include_once "autoload.php";

class Disco extends Soporte
{
    public $idiomas;
    private $formatPantalla;

    public function __construct($titulo, $numero, $precio, $idiomas, $formatPantalla)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatPantalla = $formatPantalla;
    }

    public function muestraResumen()
    {
        return parent::muestraResumen() .
            "Idiomas: " . $this->idiomas . "<br>
            Formato de pantalla: " . $this->formatPantalla . "<br>";
    }
}
