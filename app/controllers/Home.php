<?php

class Home extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    $data = [
      'title' => 'Home',
      'description' => 'This is the home page'
    ];

    $this->view('index', $data);
  }
}
