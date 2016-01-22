<?php

namespace SMVC\Core\Registry\Exception;

use Symfony\Component\HttpFoundation\Response;

class RegistryException
{
    public function __construct($error)
    {
        $response = new Response($error);
        $response->send();
    }
}