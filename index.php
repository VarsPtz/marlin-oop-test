<?php
require_once 'init.php';

//var_dump(Session::get('user'));
//var_dump(Config::get('session.user_session'));
var_dump(Session::get(Config::get('session.user_session')));