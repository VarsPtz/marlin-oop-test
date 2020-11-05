<?php
require_once 'init.php';

$user = new User;

if(Input::exists()) {

  $validate = new Validate();

  $validate->check($_POST, [
    'username' => [
      'required' => true,
      'min' => 2
    ]
  ]);

  if(Token::check(Input::get('token'))) {
    if($validate->passed()) {
      $user->update(['username' => Input::get('username')]);
      Session::flash('success', 'Username successfully updated');
      Redirect::to('update.php');
    } else {
      foreach($validate->errors() as $error) {
        echo $error . '<br>';
      }
    }
  }
}

?>

<form action="" method="POST">
  <?php echo Session::flash('success'); ?>
  <div class="field">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" value="<?php echo $user->data()->username;?>">
  </div>

  <input type="hidden" name="token" value="<?php echo Token::generate();?>" >
  <div class="field">
    <button type="submit">Submit</button>
  </div>
</form>
