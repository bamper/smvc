<?php

namespace SMVC\Core\Rixi\Exception;

use Symfony\Component\HttpFoundation\Response;

class RixiException
{
    public function __construct($message)
    {
        $responce = new Response($message);
        $responce->send();
    }
}

