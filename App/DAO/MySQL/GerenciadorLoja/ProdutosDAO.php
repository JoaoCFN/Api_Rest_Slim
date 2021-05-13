<?php 
    namespace App\DAO\MySQL\GerenciadorLoja;

    use App\Models\MySQL\GerenciadorLoja\ProdutoModel;

    class ProdutosDAO extends Conexao{
        public function __construct(){
            // Executar a construtor da classe Pai
            // Nesse caso é a classe conexão
            parent::__construct();
        }

        public function getAll(): array 
        {
            $query = "SELECT
                    *
                FROM produtos
            ";

            $produtos = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $produtos;
        }

        public function insertProduto(ProdutoModel $produto): void 
        {
            $query = "INSERT INTO produtos (
                loja_id,
                nome,
                preco, 
                quantidade
            ) VALUES (
                :loja_id,
                :nome,
                :preco,
                :quantidade
            )";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "loja_id" => $produto->getLojaId(),
                "nome" => $produto->getNome(),
                "preco" => $produto->getPreco(),
                "quantidade" => $produto->getQuantidade()
            ]);
        }

        public function updateProduto(int $id, ProdutoModel $produto): void
        {
            $query = "UPDATE produtos 
                    SET 
                        loja_id = :loja_id,
                        nome = :nome,
                        preco = :preco,
                        quantidade = :quantidade
                WHERE id = :id 
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "loja_id" => $produto->getLojaId(),
                "nome" => $produto->getNome(),
                "preco" => $produto->getPreco(),
                "quantidade" => $produto->getQuantidade(),
                "id" => $id
            ]);
        }

        public function deleteProduto(int $id): void
        {
            $query = "DELETE FROM produtos WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);
        }
    }
?>