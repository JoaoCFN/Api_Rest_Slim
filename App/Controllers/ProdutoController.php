<?php 
    namespace App\Controllers;

    use App\DAO\MySQL\GerenciadorLoja\ProdutosDAO;
    use App\Models\MySQL\GerenciadorLoja\ProdutoModel;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request; 


    // Final pois ningúem herdará o ProductController
    final class ProdutoController
    {
        public function getProdutos(Request $request, Response $response, array $args): Response
        {   
            $produtosDao = new ProdutosDAO();
            $produtos = $produtosDao->getAll();

            $response = $response->withJson($produtos);
            
            return $response;                     
        }

        public function insertProduto(Request $request, Response $response, array $args): Response
        {   
            $produtosDAO = new ProdutosDAO();

            $data = $request->getParsedBody();
            $lojaId = $data['loja_id'];
            $nome = $data['nome'];
            $preco = $data['preco'];
            $quantidade = $data['quantidade'];

            $produto = new ProdutoModel();
            $produto->setLojaId($lojaId);
            $produto->setNome($nome);
            $produto->setPreco($preco);
            $produto->setQuantidade($quantidade);

            $produtosDAO->insertProduto($produto);
            
            $response = $response->withJson([
                "message" => "Produtos inseridos com sucesso"
            ]);
            
            return $response;                     
        }

        public function updateProduto(Request $request, Response $response, array $args): Response
        {
            $produtosDAO = new ProdutosDAO();

            $data = $request->getParsedBody();
            $id = $data['id'];
            $lojaId = $data['loja_id'];
            $nome = $data['nome'];
            $preco = $data['preco'];
            $quantidade = $data['quantidade'];

            $produto = new ProdutoModel();
            $produto->setLojaId($lojaId);
            $produto->setNome($nome);
            $produto->setPreco($preco);
            $produto->setQuantidade($quantidade);

            $produtosDAO->updateProduto($id, $produto);

            $response = $response->withJson([
                "message" => "Update Produtos"
            ]);
            
            return $response;                     
        }
        
        public function deleteProduto(Request $request, Response $response, array $args): Response
        {
            $produtosDAO = new ProdutosDAO();

            $data = $request->getParsedBody();
            $id = $data['id'];

            $produtosDAO->deleteProduto($id);

            $response = $response->withJson([
                "message" => "Produto deletado com sucesso"
            ]);
            
            return $response;                    
        }
    }