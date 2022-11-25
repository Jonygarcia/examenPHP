<?php

namespace util;

class SoporteYaAlquiladoException extends VideoclubException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }

    public function getMensaje()
    {
        return $this->message;
    }
}
