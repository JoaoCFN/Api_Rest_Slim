<?php
    namespace App\Models\MySQL\GerenciadorLoja;

    final class LojaModel{
        /** 
         * @var int
        */
        private $id;

        /** 
         * @var string
        */
        private $nome;

        /** 
         * @var string
        */
        private $telefone;

        /** 
         * @var string
        */
        private $endereco;


        public function getId(): int
        {
            return $this->id;
        }

        public function getNome(): string
        {
            return $this->nome;
        }

        public function setNome($nome): LojaModel
        {
            $this->nome = $nome;
            return $this;
        }

        public function getTelefone(): string{
            return $this->telefone;
        }

        public function setTelefone($telefone): LojaModel 
        {
            $this->telefone = $telefone;
            return $this;
        }

        public function getEndereco(): string 
        {
            return $this->endereco;
        }

        public function setEndereco($endereco): LojaModel 
        {
            $this->endereco = $endereco;
            return $this;
        }
    }