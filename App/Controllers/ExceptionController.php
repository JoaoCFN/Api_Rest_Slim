<?php
    namespace App\Controllers;

    use App\Exceptions\TestException;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    final class ExceptionController{
        public function test(Request $request, Response $response, array $args): Response
        {
            try{
                throw new TestException('Faltou enviar a senha');

                return $response->withJson([
                    "msg" => "Ok"
                ]);
            } 
            catch(TestException $exception){
                return $response->withJson([
                    "msg" => "Testando apenas...",
                    "error" => \TestException::class,
                    "status" => 400,
                    "code" => '003',
                    "developerMessage" => $exception->getMessage()
                ], 400);
            }
            catch (\InvalidArgumentException $exception){
                return $response->withJson([
                    "msg" => "É necessário enviar todos os dados para o login",
                    "error" => \InvalidArgumentException::class,
                    "status" => 400,
                    "code" => '002',
                    "developerMessage" => $exception->getMessage()
                ], 400);
            }
            catch(\Exception | \Throwable $exception){
                return $response->withJson([
                    "msg" => "Ooops! Algo deu errado",
                    "error" => \Exception::class,
                    "status" => 500,
                    "code" => '001',
                    "developerMessage" => $exception->getMessage()
                ], 500);
            }
        }
    }