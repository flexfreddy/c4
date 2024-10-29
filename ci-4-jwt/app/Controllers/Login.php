<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use \Firebase\JWT\JWT;
use PHPUnit\Exception;

class Login extends BaseController
{
    use ResponseTrait;

    public function index()
    {
	Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
        try {


            $userModel = new UserModel();

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');


            $user = $userModel->where('email', $email)->first();

            if (is_null($user)) {
                return $this->respond(['error' => 'Invalid username or password.'], 401);
            }

            $pwd_verify = password_verify($password, $user['password']);

            if (!$pwd_verify) {
                return $this->respond(['error' => 'Invalid username or password.'], 401);
            }
            $test = getenv('encryption.key');
            $key = "123456";
            /*exit();*/
            $iat = time(); // current timestamp value
            $exp = $iat + 3600;
            echo $test;

            $payload = array(
                "iss" => "Issuer of the JWT",
                "aud" => "Audience that the JWT",
                "sub" => "Subject of the JWT",
                "iat" => $iat, //Time the JWT issued at
                "exp" => $exp, // Expiration time of token
                "email" => $user['email'],
            );

            $token = JWT::encode($payload, $key, 'HS256');

            $response = [
                'message' => 'Login Succesful',
                'token' => $token
            ];

            return $this->respond($response, 200);
        } catch (Exception $ex) {
            throw new \Exception('Some message goes here:,%d' . $ex);
            //exit($ex->getMessage());
        }
    }
}
