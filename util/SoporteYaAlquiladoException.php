<?php

namespace util;

class SoporteYaAlquiladoException extends VideoclubException
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function getMensaje()
    {
        return $this->message;
    }
}
