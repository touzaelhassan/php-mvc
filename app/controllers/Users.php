<?php

class Users extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model('User');
  }

  public function index()
  {
    $users = $this->userModel->get_users();

    $data = [
      'users' => $users
    ];

    $this->view('users/index', $data);
  }
}
