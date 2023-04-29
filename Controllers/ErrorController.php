<?php


namespace Controllers;

class ErrorController
{
public function notFound()
{
http_response_code(404);
include_once __DIR__ . '/../Views/errors/404.php';
}

public function serverError()
{
http_response_code(500);
include_once __DIR__ . '/../Views/errors/500.php';
}
}