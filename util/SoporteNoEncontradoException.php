<?php

namespace util;

class SoporteNoEncontradoException extends VideoclubException
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
