<?php

namespace app;

use util\CupoSuperadoException;
use util\SoporteNoEncontradoException;
use util\SoporteYaAlquiladoException;

class Cliente
{
    public $nombre;
    private $numero;
    private $soportesAlquilados = [];
    private $numSoportesAlquilados = 0;
    private $maxAlquilerConcurrente;

    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNumSoportesAlquilados()
    {
        return $this->numSoportesAlquilados;
    }

    public function alquilar(Soporte $s)
    {
        if ($this->tieneAlquilado($s) == false && $this->getNumSoportesAlquilados() < $this->maxAlquilerConcurrente) {
            $this->numSoportesAlquilados++;
            array_push($this->soportesAlquilados, $s);

            $s->alquilado = true;

            echo "<br>El alquiler de " . $s->titulo . " se ha realizado correctamente";
            echo "<br>Ahora tienes " . $this->numSoportesAlquilados . " soportes alquilados<br>";
        } else {
            echo $this->tieneAlquilado($s) == true ?
                throw new SoporteYaAlquiladoException("El soporte " . $s->titulo . " ya lo tienes alquilado<br>") :
                throw new CupoSuperadoException("Has superado el número máximo de alquileres concurrentes<br>");
        }
        return $this;
    }

    public function tieneAlquilado(Soporte $s): bool
    {
        return in_array($s, $this->soportesAlquilados);
    }

    public function devolver(int $numSoporte): bool
    {
        foreach ($this->soportesAlquilados as $key => $value) {
            if ($value->getNumero() == $numSoporte) {
                $this->numSoportesAlquilados--;
                unset($this->soportesAlquilados[$key]);

                $value->alquilado = false;

                echo "<br>El soporte " . $value->titulo . " ha sido devuelto correctamente<br>";
                return true;
            }
        }
        throw new SoporteNoEncontradoException("El soporte que quiere devolver no lo tiene alquilado<br>");
    }

    public function listaAlquileres()
    {
        echo "<br>Actualmente tiene " . count($this->soportesAlquilados) . " soportes alquilados<br>";
        foreach ($this->soportesAlquilados as $value) {
            $value->muestraResumen();
        }
    }

    public function muestraResumen()
    {
        echo "</br><strong>" . $this->nombre . "</strong><br>
            Número: " . $this->numero . "<br>
            Número máximo de alquileres: " . $this->maxAlquilerConcurrente;
        $this->listaAlquileres();
    }
}
