<?php

namespace app;

use util\ClienteNoEncontradoException;
use util\CupoSuperadoException;
use util\SoporteNoEncontradoException;
use util\SoporteYaAlquiladoException;

include_once "autoload.php";

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
        try {
            $saveCliente = "";
            $saveProducto = "";

            foreach ($this->socios as $cliente) {
                if ($cliente->getNumero() == $numeroCliente) {
                    $saveCliente = $cliente;
                    try {
                        foreach ($this->productos as $producto) {
                            if ($producto->getNumero() == $numeroSoporte) {
                                $saveProducto = $producto;
                                $cliente->alquilar($producto);
                                return $this;
                            }
                        }
                    } catch (SoporteYaAlquiladoException $e) {
                        echo $e->getMensaje();
                    } catch (CupoSuperadoException $e) {
                        echo $e->getMensaje();
                    }
                }
            }

            if ($saveCliente === "") {
                throw new ClienteNoEncontradoException("El número no coincide con ninguno de los clientes registrados<br>");
            } else if ($saveProducto === "") {
                throw new SoporteNoEncontradoException("El número no coincide con ninguno de los soportes registrados<br>");
            }
        } catch (ClienteNoEncontradoException $e) {
            echo $e->getMensaje();
        } catch (SoporteNoEncontradoException $e) {
            echo $e->getMensaje();
        }
        return $this;
    }
}
