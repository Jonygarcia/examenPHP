<?php

namespace util;

class ClienteNoEncontradoException extends VideoclubException
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
