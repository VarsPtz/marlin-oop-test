<?php
require_once 'init.php';

$user = new User;

if(Input::exists()) {

  if(Token::check(Input::get('token'))) {

    $validate = new Validate();

    $validate->check($_POST, [
      'current_password' => ['required' => true, 'min' => 6],
      'new_password' => ['required' => true, 'min' => 6],
      'new_password_again' => ['required' => true, 'min' => 6, 'matches' => 'new_password']
    ]);

    if($validate->passed()) {

      if(password_verify(Input::get('current_password'), $user->data()->password)) {
        $user->update(['password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
        Session::flash('success', 'Password has been changed.');
        Redirect::to('index.php');
      } else {
        echo 'Invalid current password';
      }

    } else {
      foreach($validate->errors() as $error) {
        echo $error . '<br>';
      }
    }
  }
}
?>

<form action="" method="POST">
  <div class="field">
    <label for="current_password">Current password</label>
    <input type="password" id="current_password" name="current_password">
  </div>

  <div class="field">
    <label for="new_password">New password</label>
    <input type="password" id="new_password" name="new_password">
  </div>

  <div class="field">
    <label for="new_password_again">New password again</label>
    <input type="password" id="new_password_again" name="new_password_again">
  </div>

  <input type="hidden" name="token" value="<?php echo Token::generate();?>" >
  <div class="field">
    <button type="submit">Submit</button>
  </div>
</form>
