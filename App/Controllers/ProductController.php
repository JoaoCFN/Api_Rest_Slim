<?php 
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request; 


    // Final pois ningúem herdará o ProductController
    final class ProductController
    {
        public function getProducts(Request $request, Response $response, array $args): Response
        {
            $response = $response->withJson([
                "message" => "Hello World"
            ]);

            return $response;
        }
    }