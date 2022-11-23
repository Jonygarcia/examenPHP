<?php
class Soporte
{
    public $titulo;
    protected $numero;
    private $precio;
    private const IVA = 0.21;

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
        echo "</br><strong>" . $this->titulo . "</strong><br>
            Número: " . $this->numero . "<br>
            Precio: " . $this->precio . " €<br>
            Precio IVA incluido: " . $this->getPrecioConIva() . " €<br>";
    }
}
