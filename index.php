<?php
  require_once "Database.php";

  $users = Database::getInstance()->get('users', ['password', '=', 'password3']);

  if ($users->error()) {
    echo 'we have an error';
  } else {
     foreach ($users->results() as $user) {
      echo $user->username . '<br>';
     }
  }
  
?>