<?php
class Database
{
  private $db_host = 'localhost';
  private $db_name = 'database';
  private $db_user = 'root';
  private $db_password = '';

  private $connection;
  private $stmt;
  private $error;

  public function __construct()
  {
    // Set DSN
    $dsn = "mysql:host=$this->db_host;dbname=$this->db_name";

    try {
      // Create a new PDO instance
      $this->connection = new PDO($dsn, $this->db_user, $this->db_password);
    } catch (PDOException $e) {
      // Set the error message
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  // Prepare statement
  public function prepare($sql)
  {
    return $this->stmt = $this->connection->prepare($sql);
  }

  // Execute the prepared statement
  public function execute()
  {
    return $this->stmt->execute();
  }

  // Get result set as array of objects
  public function get_all()
  {
    return $this->stmt = $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Get single record as object
  public function get_one()
  {
    return $this->stmt = $this->stmt->fetch(PDO::FETCH_OBJ);
  }


  // Get the last inserted id
  public function last_id()
  {
    return $this->connection->lastInsertId();
  }
}
