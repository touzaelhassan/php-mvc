<?php

class User
{
  public $id;
  public $name;
  public $email;
  public $password;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function create_user()
  {

    $this->db->prepare("INSERT INTO users (name, email, password) VALUES ('$this->name', '$this->email', '$this->password')");

    if ($this->db->execute()) {
      $this->id = $this->db->last_id();
      return true;
    } else {
      return false;
    }
  }

  public function get_users()
  {
    $this->db->prepare("SELECT * FROM users");
    $this->db->execute();
    return $this->db->get_all();
  }
}
