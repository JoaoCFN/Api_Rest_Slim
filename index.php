<?php
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    require_once "vendor/autoload.php";

    $app = new \Slim\App();

    // Passar parametro no caminho da url - pegamos os valores pela variavel args
    // $request->getQueryParams() serve para pegar os valores passados na URL da forma 'padrão'
    $app->get('/produto/{nome}', function(Request $request, Response $response, array $args){
        /*
            As duas integorações servem para o seguinte motivo: 
            Caso o usuário não informe o limite, a variavel limite receberia nulo,
            mas com ?? por padrão a variavel recebe 10.
        */
        $limit = $request->getQueryParams()['limit'] ?? 10;
        $nome = $args['nome'];

        return $response->getBody()->write("$limit Produtos do banco de dados com o nome {$nome}");
    });

    // Os colchetes em volta, tornam esse caminho opcional
    $app->get('/produtos[/{nome}]', function(Request $request, Response $response, array $args){
        /*
            As duas integorações servem para o seguinte motivo: 
            Caso o usuário não informe o limite, a variavel limite receberia nulo,
            mas com ?? por padrão a variavel recebe 10.
        */
        $limit = $request->getQueryParams()['limit'] ?? 10;
        $nome = $args['nome'] ?? 'mouse';

        return $response->getBody()->write("$limit Produtos do banco de dados com o nome {$nome}");
    });

    
    
    $app->run();
?>