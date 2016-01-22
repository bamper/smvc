<?php

namespace SMVC\Core\Query\Exception;

use Symfony\Component\HttpFoundation\Response;

class QueryException
{
    public function __construct($error)
    {
        $response = new Response($error);
        $response->send();
    }
}