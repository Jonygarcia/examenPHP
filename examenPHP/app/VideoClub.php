<?php

include_once "../autoload.php";

class Videoclub
{

    private $nombre;
    private $productos = [];
    private $numProductos = 0;
    private $socios = [];
    private $numSocios = 0;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    private function incluirProducto(Soporte $producto)
    {
        array_push($this->productos, $producto);
        echo "<br>El producto " . $producto->titulo . " ha sido incluido con el identificador: " . $this->numProductos . "<br>";
    }

    public function incluirCintaVideo($titulo, $precio, $duracion)
    {
        $this->numProductos++;
        $cinta = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        $this->incluirProducto($cinta);
    }

    public function incluirDvd($titulo, $precio, $idiomas, $pantalla)
    {
        $this->numProductos++;
        $disco = new Disco($titulo, $this->numProductos, $precio, $idiomas, $pantalla);
        $this->incluirProducto($disco);
    }

    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ)
    {
        $this->numProductos++;
        $juego = new Juego($titulo, $this->numProductos, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);
    }

    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3)
    {
        $this->numSocios++;
        $cliente = new Cliente($nombre, $this->numSocios, $maxAlquileresConcurrentes);
        array_push($this->socios, $cliente);
        echo "<br>El socio " . $nombre . " ha sido incluido con el identificador: " . $this->numSocios . "<br>";
    }

    public function listarProductos()
    {
        foreach ($this->productos as $value) {
            $value->muestraResumen();
        }
    }

    public function listarSocios()
    {
        foreach ($this->socios as $value) {
            $value->muestraResumen();
        }
    }

    public function alquilaSocioProducto($numeroCliente, $numeroSoporte)
    {
        foreach ($this->socios as $cliente) {
            if ($cliente->getNumero() == $numeroCliente) {
                foreach ($this->productos as $producto) {
                    if ($producto->getNumero() == $numeroSoporte) {
                        $cliente->alquilar($producto);
                        return $this; // Para que no muestre mensajes de error si se completa correctamente.             
                    }
                }
                echo "<br>El producto " . $numeroSoporte . " aún no ha sido registrado<br>";
            }
        }
        echo "<br>El cliente " . $numeroCliente . " aún no ha sido registrado<br>";
        return $this;
    }
}
