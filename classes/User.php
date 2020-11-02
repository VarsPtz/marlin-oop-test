<?php

class User {
  private $db;

  public function __construct() {
    $this->db = Database::getInstance();
  }

  public function create($fields = []) {
//    var_dump($fields);die();
    $this->db->insert('users', $fields);
  }
}