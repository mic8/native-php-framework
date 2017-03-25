<?php

/**
 * HTTP Response
 * Response the data with any http code and any type of response
 */

namespace Vendor\Http;

class Response
{
    public function json($data = [], $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);

        echo json_encode($data);

        return true;
    }
}