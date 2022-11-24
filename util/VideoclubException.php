<?php

namespace util;

use Exception;

class VideoclubException extends Exception
{
    public function __construct($message, $code = 0, Exception $previa = null)
    {
        parent::__construct($message, $code, $previa);
    }

    public function getMensaje()
    {
        return $this->message;
    }
}
