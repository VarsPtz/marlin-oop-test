<?php
require_once 'init.php';

//var_dump(Session::get('user'));
//var_dump(Config::get('session.user_session'));
//var_dump(Session::get(Config::get('session.user_session')));

$user = new User;

if($user->isLoggedIn()) {
    echo "Hi, <a href='#'>{$user->data()->username}</a>!";
    echo "<p><a href='logout.php'>Logout</a></p>";
} else {
    echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
}
