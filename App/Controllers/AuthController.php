<?php
    namespace App\Controllers;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use App\DAO\MySQL\GerenciadorLoja\UsuariosDAO;
    use App\DAO\MySQL\GerenciadorLoja\TokensDAO;
    use App\Models\MySQL\GerenciadorLoja\TokenModel;
    use Firebase\JWT\JWT;

    final class AuthController
    {
        public function login(Request $request, Response $response, array $args): Response
        {
            $data = $request->getParsedBody();

            $email = $data['email'];
            $senha = $data['senha'];

            $usuarioDAO = new UsuariosDAO();
            $usuario = $usuarioDAO->getUserByEmail($email);

            if(is_null($usuario)){
                return $response->withStatus(401);
            }
           
            if(!password_verify($senha, $usuario->getSenha())){
                return $response->withStatus(401);
            }

            $expiredDate = (new \DateTime())->modify('+1 days')->format('Y-m-d H:i:s');
            $tokensDAO = new TokensDAO();
            $tokensModel = new TokenModel();

            $tokenPayLoad = [
                'sub' => $usuario->getId(),
                'name' => $usuario->getNome(),
                'email' => $usuario->getEmail(),
                'expired_at' => $expiredDate
            ];

            $token = JWT::encode($tokenPayLoad, getenv('JWT_SECRET_KEY'));

            $refreshTokenPayLoad = [
                'email' => $usuario->getEmail(),
                'random' => uniqid()
            ];

            $refreshToken = JWT::encode($refreshTokenPayLoad, getenv('JWT_SECRET_KEY'));

            $tokensModel->setUsuariosId($usuario->getId());
            $tokensModel->setToken($token);
            $tokensModel->setRefreshToken($refreshToken);
            $tokensModel->setExpiredAt($expiredDate);

            $queryStatus = $tokensDAO->createToken($tokensModel);

            if($queryStatus){
                $response = $response->withJson([
                    "token" => $token,
                    "refresh_token" => $refreshToken
                ]);
            }

            return $response;
        }

        public function refreshToken(Request $request, Response $response, array $args): Response
        {
            $data = $request->getParsedBody();

            $refreshToken = $data['refresh_token'];
            
            $tokenDecoded = JWT::decode(
                $refreshToken, 
                getenv('JWT_SECRET_KEY'), 
                ['HS256']
            );

            $tokensDAO = new TokensDAO();
            $tokensModel = new TokenModel();
            $usuariosDAO = new UsuariosDAO();
            $expiredDate = (new \DateTime())->modify('+1 days')->format('Y-m-d H:i:s');

            $refreshTokenExists = $tokensDAO->verifyRefreshToken($refreshToken);
            $refreshTokenIsDisabled = $tokensDAO->disableRefreshToken($refreshToken);

            if(!$refreshTokenExists){
                return $response->withStatus(401);
            }

            if(!$refreshTokenIsDisabled){
                return $response->withJson([
                    "message" => "Ooops! Algo deu errado, entre em contato com o desenvolvedor",
                    "error" => "true"
                ]);
            }

            $usuario = $usuariosDAO->getUserByEmail($tokenDecoded->email);

            if(is_null($usuario)){
                return $response->withStatus(401);
            }

            $tokenPayLoad = [
                'sub' => $usuario->getId(),
                'name' => $usuario->getNome(),
                'email' => $usuario->getEmail(),
                'expired_at' => $expiredDate
            ];

            $token = JWT::encode($tokenPayLoad, getenv('JWT_SECRET_KEY'));

            $refreshTokenPayLoad = [
                'email' => $usuario->getEmail(),
                'random' => uniqid()
            ];

            $refreshToken = JWT::encode($refreshTokenPayLoad, getenv('JWT_SECRET_KEY'));

            $tokensModel->setUsuariosId($usuario->getId());
            $tokensModel->setToken($token);
            $tokensModel->setRefreshToken($refreshToken);
            $tokensModel->setExpiredAt($expiredDate);

            $queryStatus = $tokensDAO->createToken($tokensModel);

            if($queryStatus){
                $response = $response->withJson([
                    "token" => $token,
                    "refresh_token" => $refreshToken
                ]);
            }

            return $response;
        }
    }
