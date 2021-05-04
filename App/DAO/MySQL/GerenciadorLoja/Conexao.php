<?php 
    namespace App\DAO\MySQL\GerenciadorLoja;

    abstract class Conexao{
        /** 
           *@var \PDO
        */
        protected $pdo;

        public function __construct(){
            $host = getenv('GERENCIADOR_LOJA_MYSQL_HOST');
            $dbName = getenv('GERENCIADOR_LOJA_MYSQL_DBNAME');
            $username = getenv('GERENCIADOR_LOJA_MYSQL_USER');
            $password = getenv('GERENCIADOR_LOJA_MYSQL_PASSWORD');
            $port = getenv('GERENCIADOR_LOJA_MYSQL_PORT');

            $dsn = "mysql:host={$host};dbname={$dbName};port={$port}";

            $this->pdo = new \PDO($dsn, $username, $password);
            
            // Lançar excessões quando der algum erro na manipulação do banco
            $this->pdo->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
        }

    }
?>