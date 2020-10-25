<?php
  require_once "Database.php";

  // $users = Database::getInstance()->query("SELECT * FROM users WHERE username = ?", ['user1']);
  //  $users = Database::getInstance()->query("SELECT * FROM users WHERE username IN (?, ?)", ['user1', 'user2']);

  //  $users = Database::getInstance()->get('users', ['username', '=', 'user1']);
  $users = Database::getInstance()->get('users', ['password', '=', 'password']);

  //var_dump($users->count());
  // Database::getInstance()->get('users', ['username', '=', 'user1']);
  // Database::getInstance()->delete('users', ['username', '=', 'user1']);

  if ($users->error()) {
    echo 'we have an error';
  } else {
     foreach ($users->results() as $user) {
      echo $user->username . '<br>';
     }
  } 

  // if ($users->count()) {
  //   echo $users->count();
  // } 
  
?>