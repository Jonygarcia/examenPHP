<?php

namespace util;

use Exception;

class VideoclubException extends Exception
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
