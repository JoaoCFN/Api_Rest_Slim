<?php
    use function src\basicAuth;
    use function src\jwtAuth;
    use function src\slimConfiguration;
    use function src\exceptions;

    use App\Controllers\{
        LojaController, 
        ProdutoController,
        AuthController,
        ExceptionController
    };
    use App\Middlewares\ExceptionExample;
    use App\Middlewares\JwtDateTimeMiddleware;

    $app = new \Slim\App(slimConfiguration());

    $app->get('/exception', ExceptionController::class.':test');

    $app->post('/login', AuthController::class.':login');
    $app->post('/refresh_token', AuthController::class.':refreshToken');

    $app
        ->get('/teste', function(){echo "oi";})
        // 2. Verifica a data de expiração
        ->add(new JwtDateTimeMiddleware())
        // 1. Valida a chave secreta do token passado pelo usuário
        ->add(jwtAuth());

    // Agrupar rotas para implemantar o basicAuth com o add
    $app->group('', function () use ($app){
        $app->get('/loja', LojaController::class.':getLojas');
        $app->post('/loja', LojaController::class.':insertLoja');
        $app->put('/loja', LojaController::class.':updateLoja');
        $app->delete('/loja', LojaController::class.':deleteLoja');

        $app->get('/produto', ProdutoController::class.':getProdutos');
        $app->post('/produto', ProdutoController::class.':insertProduto');
        $app->put('/produto', ProdutoController::class.':updateProduto');
        $app->delete('/produto', ProdutoController::class.':deleteProduto');
    })
    // 2. Verifica a data de expiração
    ->add(new JwtDateTimeMiddleware())
    // 1. Valida a chave secreta do token passado pelo usuário
    ->add(jwtAuth());

    $app->run();
?>