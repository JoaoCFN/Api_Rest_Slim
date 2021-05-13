<?php 
    namespace src;
    use Tuupola\Middleware\HttpBasicAuthentication;

    function basicAuth(): HttpBasicAuthentication
    {
        return new HttpBasicAuthentication([
            "users" => [
                "root" => "teste"
            ],
            "error" => function ($response) {
                $response->withJson([
                    "message" => "Credenciais inválidas"
                ]);
            }
        ]);
    }
