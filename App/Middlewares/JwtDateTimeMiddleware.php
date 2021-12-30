<?php
    namespace App\Middlewares;

    use Psr\Http\Message\{
        ResponseInterface as Response,
        ServerRequestInterface as Request
    } ;

    final class JwtDateTimeMiddleware
    {
        public function __invoke(
            Request $request,
            Response $response, 
            callable $next
        ): Response
        {
            $token = $request->getAttribute('jwt');

            // Capturando data de expiração do token
            $expireDate = new \DateTime($token['expired_at']);
            // Capturando data atual
            $now = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

            // Validando a data de expiração do token
            if($expireDate < $now){
                return $response->withStatus(401);
            }

            $response = $next($request, $response);
            return $response;
        }
    }