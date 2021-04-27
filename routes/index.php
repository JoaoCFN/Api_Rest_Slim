<?php
    use App\Controllers\ProductController;

    use function src\slimConfiguration;

    $app = new \Slim\App(slimConfiguration());

    $app->get('/', ProductController::class . ':getProducts');

    $app->run();
?>