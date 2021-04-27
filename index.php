<?php
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    require_once "vendor/autoload.php";

    // Configuração para habilitar os detalhes do erro no Slim
    $configuration = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
    ];

    $configuration = new \Slim\Container($configuration);

    // Middleware
    // Funções de primeira classe
    $middleware01 = function(Request $request, Response $response, $next): Response{
        $response->getBody()->write('Dentro do middleware 01 <br>');
        $response = $next($request, $response);
        $response->getBody()->write('Dentro do middleware 02 <br>');

        return $response;
    };

    $app = new \Slim\App($configuration);

    $app->get('/listar/produto', function(Request $request, Response $response, array $args){
        return $response->getBody()->write("Teste de rota");
    });

    // Passar parametro no caminho da url - pegamos os valores pela variavel args
    // $request->getQueryParams() serve para pegar os valores passados na URL da forma 'padrão'
    $app->get('/produto_teste/{nome}', function(Request $request, Response $response, array $args){
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

    $app->post('/produto', function(Request $request, Response $response, array $args){
        $data = $request->getParsedBody();

        $nome = $data['nome'] ?? '';
        $preco = $data['preco'] ?? 0.00;

        return $response->getBody()->write("(POST) Produto: $nome, Preço (R$): $preco");
        die;
    })->add($mid01);
    // O add nesse caso serve para adicionar um middleware

    $app->put('/produto', function(Request $request, Response $response, array $args){
        $data = $request->getParsedBody();

        $nome = $data['nome'] ?? '';
        $preco = $data['preco'] ?? 0.00;

        return $response->getBody()->write("(PUT) Produto: $nome, Preço (R$): $preco");
        die;
    });

    $app->delete('/produto', function(Request $request, Response $response, array $args){
        $data = $request->getParsedBody();

        $nome = $data['nome'] ?? '';
        $preco = $data['preco'] ?? 0.00;

        return $response->getBody()->write("(DELETE) Produto: $nome, Preço (R$): $preco");
        die;
    });

    $app->run();
?>