<?php 
    namespace App\DAO\MySQL\GerenciadorLoja;

    class LojasDAO extends Conexao{
        public function __construct(){
            // Executar a construtor da classe Pai
            // Nesse caso é a classe conexão
            parent::__construct();
        }
    }
?>