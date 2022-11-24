<?php

namespace util;

class SoporteNoEncontradoException extends VideoclubException
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
