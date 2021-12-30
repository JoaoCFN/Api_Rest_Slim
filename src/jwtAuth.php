<?php
    namespace src;

    use Tuupola\Middleware\JwtAuthentication;

    function jwtAuth(): JwtAuthentication
    {   
        return new JwtAuthentication([
            // Chave secreta usada para construir os tokens
            'secret' => getenv('JWT_SECRET_KEY'),
            // O attribute define em qual atributo o token decodificado ficará
            'attribute' => 'jwt'
        ]);
    }