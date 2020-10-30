<?php
session_start();

require_once 'Database.php';
require_once 'Config.php';
require_once 'Validate.php';
require_once 'Input.php';
require_once 'Token.php';
require_once 'Session.php';

$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'localhost',
        'username' => 'admin',
        'password' => '',
        'database' => 'marlin-oop-test',
        'something' => [
            'no' => 'yes'
        ]
    ],

    'session' => [
        'token_name' => 'token'
    ]
];

//echo Config::get('mysql.host');

if(Input::exists()) {
  if(Token::check(Input::get('token'))) {

      $validate = new Validate();

      $validation = $validate->check($_POST, [
          'username' => [
              'required' => true,
              'min' => 2,
              'max' => 15,
              'unique' => 'users'
          ],
          'password' => [
              'required' => true,
              'min' => 3
          ],
          'password_again' => [
              'required' => true,
              'matches' => 'password'
          ]
      ]);

      if($validation->passed()) {
//          echo 'passed';
        Session::flash('success', 'register success');
//        var_dump(Session::flash('success'));die();
//        header('Location: /test.php');
      } else {
          foreach($validation->errors() as $error) {
              echo $error . "<br>";
          }
      }

  }

}

?>

<form action="" method="POST">
  <?php echo Session::flash('success'); ?>
  <div class="field">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" value="<?php echo Input::get('username')?>">
  </div>

  <div class="field">
    <label for="password">Password</label>
    <input type="text" id="password" name="password">
  </div>

  <div class="field">
    <label for="password_again">Password Again</label>
    <input type="text" id="password_again" name="password_again">
  </div>

  <input type="hidden" name="token" value="<?php echo Token::generate();?>" >
  <div class="field">
    <button type="submit">Submit</button>
  </div>
</form>
