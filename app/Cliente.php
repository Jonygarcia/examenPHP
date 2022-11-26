<?php

namespace app;

use util\CupoSuperadoException;
use util\SoporteNoEncontradoException;
use util\SoporteYaAlquiladoException;

class Cliente
{
    public $nombre;
    private $numero;
    private $user;
    private $password;
    private $soportesAlquilados = [];
    private $numSoportesAlquilados = 0;
    private $maxAlquilerConcurrente;

    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3, $user = "", $password = "")
    {
        $this->nombre = $nombre;
        $this->numero = $numero;   
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        $this->user = ($user === "") ? str_replace(" ", "", $nombre) : $user;
        $this->password = ($password === "") ? str_replace(" ", "", $nombre) : $password;
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

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function alquilar(Soporte $s)
    {
        if ($this->tieneAlquilado($s) == false && $this->getNumSoportesAlquilados() < $this->maxAlquilerConcurrente) {
            $this->numSoportesAlquilados++;
            array_push($this->soportesAlquilados, $s);

            $s->alquilado = true;
            //! He tenido que comentar el echo porque sino da error la cabecera al redirigir en docker.
            // echo "<br>El alquiler de " . $s->titulo . " se ha realizado correctamente";
            // echo "<br>Ahora tienes " . $this->numSoportesAlquilados . " soportes alquilados<br>";
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
                //! He tenido que comentar el echo porque sino da error la cabecera al redirigir en docker.
                // echo "<br>El soporte " . $value->titulo . " ha sido devuelto correctamente<br>";
                return true;
            }
        }
        throw new SoporteNoEncontradoException("El soporte que quiere devolver no lo tiene alquilado<br>");
    }

    public function listaAlquileres()
    {
        $string =  "<br>Actualmente tiene " . count($this->soportesAlquilados) . " soportes alquilados:<br>";
        foreach ($this->soportesAlquilados as $value) {
            $string .= $value->muestraResumen();
        }
        return $string;
    }

    public function muestraResumen()
    {
        return "</br><strong>" . $this->nombre . "</strong><br>
            Nombre de usuario: " . $this->user . "<br>
            Contraseña: " . $this->password . "<br>
            Número: " . $this->numero . "<br>
            Número máximo de alquileres: " . $this->maxAlquilerConcurrente .
            $this->listaAlquileres();
    }
}
