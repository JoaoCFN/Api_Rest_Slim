<?php 
    namespace App\Models\MySQL\GerenciadorLoja;

    final class ProdutoModel{
        /**
         * @var int
         */
        private $id;

        /**
         * @var int
         */
        private $lojaId;

        /**
         * @var string
         */
        private $nome;

        /**
         * @var float
         */
        private $preco;

        /**
         * @var int
         */
        private $quantidade;

        public function getId(): int 
        {
            return $this->id;
        }

        public function getLojaId(): int 
        {
            return $this->lojaId;
        }

        public function setLojaId($lojaId): ProdutoModel 
        {
            $this->lojaId = $lojaId;

            return $this;
        }

        public function getNome(): string 
        {
            return $this->nome;
        }

        public function setNome($nome): ProdutoModel 
        {
            $this->nome = $nome;

            return $this;
        }

        public function getPreco(): float 
        {
            return $this->preco;
        }

        public function setPreco($preco): ProdutoModel 
        {
            $this->preco = $preco;

            return $this;
        }

        public function getQuantidade(): int  
        {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade): ProdutoModel 
        {
            $this->quantidade = $quantidade;

            return $this;
        }
    }