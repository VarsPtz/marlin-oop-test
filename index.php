<?php
  require_once "Database.php";

//  $users = Database::getInstance()->get('users', ['password', '=', 'password3']);
//  $id = 10;
//  Database::getInstance()->update('users', $id, [
//    'username' => 'Marlin10',
//    'password' => 'password10'
//  ]);

$users = Database::getInstance()->get('users', ['username', '=', 'user']);
var_dump($users->first()->username);die();

//  if ($users->error()) {
//    echo 'we have an error';
//  } else {
//     foreach ($users->results() as $user) {
//      echo $user->username . '<br>';
//     }
//  }
  
?>