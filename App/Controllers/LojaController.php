<?php 

    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\DAO\MySQL\GerenciadorLoja\LojasDAO;
    use App\Models\MySQL\GerenciadorLoja\LojaModel;
    
    final class LojaController{
        public function getLojas(Request $request, Response $response, array $args): Response
        {
            $lojasDao = new LojasDAO();
            $lojas = $lojasDao->getAll();

            $response = $response->withJson($lojas);
            
            return $response;                
        }

        public function insertLoja(Request $request, Response $response, array $args): Response
        {
            $lojasDAO = new LojasDAO();

            $data = $request->getParsedBody();
            $nome = $data['nome'];
            $telefone = $data['telefone'];
            $endereco = $data['endereco'];

            $loja = new LojaModel();
            $loja->setNome($nome);
            $loja->setTelefone($telefone);
            $loja->setEndereco($endereco);
            
            $lojasDAO->insertLoja($loja);

            $response = $response->withJson([
                "message" => "Loja inserida com sucesso"
            ]);

            return $response;                
        }

        public function updateLoja(Request $request, Response $response, array $args): Response
        {
            $lojasDao = new LojasDAO();

            $data = $request->getParsedBody();
            $id = $data['id'];
            $nome = $data['nome'];
            $telefone = $data['telefone'];
            $endereco = $data['endereco'];

            $loja = new LojaModel();
            $loja->setNome($nome);
            $loja->setTelefone($telefone);
            $loja->setEndereco($endereco);

            $lojasDao->updateLoja($id, $loja);

            $response = $response->withJson([
                "message" => "Dados atualizados com sucesso"
            ]);
            
            return $response;               
        }

        public function deleteLoja(Request $request, Response $response, array $args): Response
        {
            $lojasDao = new LojasDAO();

            $data = $request->getParsedBody();
            $id = $data['id'];
            $lojasDao->deleteLoja($id);

            $response = $response->withJson([
                "message" => "Loja deletada com sucesso"
            ]);
            
            return $response;    
        }
    }
