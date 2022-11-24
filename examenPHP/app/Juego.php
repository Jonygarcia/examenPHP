<?php

namespace app;

include_once "autoload.php";

class Juego extends Soporte
{
    public $consola;
    private $minNumJugadores;
    private $maxNumJugadores;

    public function __construct($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function muestraJugadoresPosibles()
    {
        if ($this->minNumJugadores > 0 && $this->maxNumJugadores > 0 && $this->minNumJugadores <= $this->maxNumJugadores) {
            if ($this->minNumJugadores == $this->maxNumJugadores) {
                return $this->minNumJugadores == 1 ? "Para un jugador" : "Para " . $this->minNumJugadores . " jugadores";
            } else {
                return "De " . $this->minNumJugadores . " a " . $this->maxNumJugadores . " jugadores";
            }
        } else return "Hay un error en el número de jugadores posibles";
    }

    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "Consola: " . $this->consola . "<br>" .
            $this->muestraJugadoresPosibles() . "<br>";
    }
}
