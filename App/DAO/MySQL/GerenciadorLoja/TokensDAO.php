<?php
    namespace App\DAO\MySQL\GerenciadorLoja;

    use App\Models\MySQL\GerenciadorLoja\TokenModel;

    class TokensDAO extends Conexao{
        public function __construct()
        {
            // Executar a construtor da classe Pai
            // Nesse caso é a classe conexão
            parent::__construct();
        }

        public function createToken(TokenModel $token): bool
        {
            $query = "INSERT INTO tokens (
                token, 
                refresh_token, 
                expired_at,
                usuarios_id
            ) VALUES (
                :token,
                :refresh_token, 
                :expired_at,
                :usuarios_id
            )";

            $statement = $this->pdo->prepare($query);
            $queryStatus = $statement->execute([
                "token" => $token->getToken(),
                "refresh_token" => $token->getRefreshToken(),
                "expired_at" => $token->getExpiredAt(),
                "usuarios_id" => $token->getUsuariosId()
            ]);

            return $queryStatus;
        }

        public function verifyRefreshToken(string $refreshToken): bool
        {
            $query = "SELECT 
                    id
                FROM tokens
                WHERE
                    refresh_token = :refresh_token
                    AND active = 1
                ";
            
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                "refresh_token" => $refreshToken
            ]);

            $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if(count($tokens) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function disableRefreshToken(string $refreshToken): bool
        {
            $query = "UPDATE tokens
                SET
                    active = 0
                WHERE refresh_token = :refresh_token
            ";

            $statement = $this->pdo->prepare($query);
            $queryResult = $statement->execute([
                "refresh_token" => $refreshToken
            ]);

            return $queryResult;
        }
    }