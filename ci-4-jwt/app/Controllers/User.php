<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    public $post;

    public function index()
    {
        $users = new UserModel();
        return $this->respond(['users' => $users->findAll()], 200);
    }
}