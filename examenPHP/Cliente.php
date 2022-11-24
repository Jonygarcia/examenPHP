<?php

namespace app;

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

            echo "<br>El alquiler de " . $s->titulo . " se ha realizado correctamente";
            echo "<br>Ahora tienes " . $this->numSoportesAlquilados . " soportes alquilados<br>";
        } else {
            echo $this->tieneAlquilado($s) == true ?
                "<br>El producto ya lo tienes alquilado<br>" :
                "<br>Has superado el máximo de alquileres concurrentes<br>";
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

                echo "<br>El soporte " . $value->titulo . " ha sido devuelto correctamente<br>";
                return true;
            }
        }

        echo "<br>El soporte que quiere devolver no lo tiene alquilado<br>";
        return false;
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
