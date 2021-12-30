<?php
    namespace App\DAO\MySQL\GerenciadorLoja;

    use App\Models\MySQL\GerenciadorLoja\UsuarioModel;

    class UsuariosDAO extends Conexao
    {
        public function __construct()
        {
            // Executar a construtor da classe Pai
            // Nesse caso é a classe conexão
            parent::__construct();
        }

        public function getUserByEmail(string $email): ?UsuarioModel
        {

            $query = "SELECT 
                        *
                    FROM usuarios
                    WHERE
                        email = :email
                ";

            $statement = $this->pdo->prepare($query);
            $statement->bindParam("email", $email);
            $statement->execute();

            $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($usuarios) > 0) {
                $usuario = new UsuarioModel();

                $usuario->setId($usuarios[0]['id']);
                $usuario->setNome($usuarios[0]['nome']);
                $usuario->setEmail($usuarios[0]['email']);
                $usuario->setSenha($usuarios[0]['senha']);

                return $usuario;
            } else {
                return null;
            }
        }
    }
