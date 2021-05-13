<?php 
    namespace App\DAO\MySQL\GerenciadorLoja;
    use App\Models\MySQL\GerenciadorLoja\LojaModel;

    class LojasDAO extends Conexao{
        public function __construct(){
            // Executar a construtor da classe Pai
            // Nesse caso é a classe conexão
            parent::__construct();
        }

        public function getAll(): array{
            $query = "SELECT
                    id,
                    nome,
                    telefone, 
                    endereco
                FROM lojas";
            
            $lojas = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

            return $lojas;
        }

        public function insertLoja(LojaModel $loja): void
        {
            $query = "INSERT INTO lojas (
                nome, 
                telefone, 
                endereco
            ) VALUES (
                :nome,
                :telefone,
                :endereco
            )";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "nome" => $loja->getNome(),
                "telefone" => $loja->getTelefone(),
                "endereco" => $loja->getEndereco()
            ]);
        }

        public function updateLoja(int $id, LojaModel $loja): void
        {
            $query = "UPDATE lojas 
                SET  
                    nome = :nome,
                    telefone = :telefone,
                    endereco = :endereco
                WHERE id = :id
            ";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "nome" => $loja->getNome(),
                "telefone" => $loja->getTelefone(),
                "endereco" => $loja->getEndereco(),
                "id" => $id
            ]);
        }

        public function deleteLoja(int $id): void
        {
            $query = "DELETE FROM lojas WHERE id = :id";

            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "id" => $id
            ]);
        }
    }
?>