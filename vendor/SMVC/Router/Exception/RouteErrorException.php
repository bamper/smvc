<?php

namespace SMVC\Router\Exception;

use Symfony\Component\HttpFoundation\Response;

class RouteErrorException
{
    public function __construct($message)
    {
        $response = new Response('RouteErrorException: ' . $message . '');
        $response->send();
    }
}