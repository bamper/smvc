<?php

namespace SMVC\Router\Exception;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException
{
    public function __construct($message)
    {
        $response = new Response('NotFoundException on ' . $message . ' request');
        $response->send();
    }
}