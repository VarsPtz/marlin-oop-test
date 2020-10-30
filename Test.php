<?php
require_once 'Session.php';
session_start();

var_dump(Session::flash('success'));