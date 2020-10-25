<?php
  class Database {
      private static $instance = null;
      private $pdo, $query, $error = false, $results, $count;

      private function __construct()
      {
        try {
          $this->pdo = new PDO('mysql:host=localhost;dbname=marlin-oop-test', 'root', '');
        } catch (PDOException $exception) {
          die($exception->getMessage());
        }
      }
      
      public static function getInstance() {

        if(!isset(self::$instance)) {
          self::$instance = new Database();
        }

        return  self::$instance;
      }
      
      public function query($sql, $params = [])
      {
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);

        if(count($params)) {
          // $this->query->bindValue(1, $params[0]);
          $i = 1;
          foreach ($params as $param) {
            $this->query->bindValue($i, $param);
            $i++;
          }
        }

        if (!$this->query->execute()) {
          $this->error = true;
        } else {
          $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
          $this->count = $this->query->rowCount();
        }
        
        return $this;
      }

      public function error()
      {
        return $this->error;
      }

      public function results()
      {
        return $this->results;
      }

      public function count()
      {
        return $this->count;
      }

      public function get($table, $where = [])
      {
          if (count($where) === 3) {

              $operators = [
                  '=',
                  '>',
                  '>=',
                  '<',
                  '<=',
              ];

              $field  = $where[0];
              $operator = $where[1];
              $value = $where[2];

              //var_dump($where[0], $where[1], $where[2]);die();

              if (in_array($operator, $operators)) {
                  $sql = "SELECT * FROM {$table}  WHERE {$field} {$operator} ?";
                  if (!$this->query($sql, [$value])->error()) {
                      return $this;
                  }
              }

          }

          return false;
      }
  }
?>