<?php
    namespace App\Models\MySQL\GerenciadorLoja;

    final class TokenModel
    {
        private $id;
        private $usuariosId;
        private $token;
        private $refreshToken;
        private $expiredAt;

        /**
         * Get the value of id
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        /**
         * Get the value of usuariosId
         */
        public function getUsuariosId()
        {
            return $this->usuariosId;
        }

        /**
         * Set the value of usuariosId
         *
         * @return  self
         */
        public function setUsuariosId($usuariosId)
        {
            $this->usuariosId = $usuariosId;

            return $this;
        }

        /**
         * Get the value of token
         */
        public function getToken()
        {
            return $this->token;
        }

        /**
         * Set the value of token
         *
         * @return  self
         */
        public function setToken($token)
        {
            $this->token = $token;

            return $this;
        }

        /**
         * Get the value of refreshToken
         */
        public function getRefreshToken()
        {
            return $this->refreshToken;
        }

        /**
         * Set the value of refreshToken
         *
         * @return  self
         */
        public function setRefreshToken($refreshToken)
        {
            $this->refreshToken = $refreshToken;

            return $this;
        }

        /**
         * Get the value of expiredAt
         */
        public function getExpiredAt()
        {
            return $this->expiredAt;
        }

        /**
         * Set the value of expiredAt
         *
         * @return  self
         */
        public function setExpiredAt($expiredAt)
        {
            $this->expiredAt = $expiredAt;

            return $this;
        }
    }
