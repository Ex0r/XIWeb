<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
 // Need to add in AJAX to this form

$output .= '
  <body>
    <div class="col-sm-5 col-sm-offset-3">
      <img src="themes/'.$config['theme'].'/views/images/ff11_logo.png" id="splashlogo">';
if (!empty($errors)) {
    $output .= '
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Please correct the following errors:
          <ul>';
    foreach ($errors['form-help'] as $error) {
        $output .= '
            <li>'.$error.'</li>';
    }
    $output .= '
          </ul>
      </div>';    
}
$output .= '
      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit"></span> Register an Account</div>
        <div class="panel-body">
          <form method="POST" action="register.php">
            <div id="username-group" class="form-group '.(!empty($errors['username']) ? 'has-error' : '').'">
              <label class="control-label" for="username">Username '.(!empty($errors['username']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['username'] : '').'</label>
              <input type="text" id="username" name="username" class="form-control" value="'.$username.'" />
            </div>
            <div id="email-group" class="form-group '.(!empty($errors['email']) ? 'has-error' : '').'">
              <label class="control-label" for="username">Email address '.(!empty($errors['email']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['email'] : '').'</label>
              <input type="text" id="email" name="email" class="form-control" value="'.$email.'" />
            </div>
            <div id="password-group" class="form-group '.(!empty($errors['password']) ? 'has-error' : '').'">
              <label class="control-label" for="username">Password '.(!empty($errors['password']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['password'] : '').'</label>
              <input type="password" id="password" name="password" class="form-control" value="'.$password.'" />
            </div>
            <div id="confpassword-group" class="form-group '.(!empty($errors['confpassword']) ? 'has-error' : '').'">
              <label class="control-label" for="confpassword">Confirm password '.(!empty($errors['confpassword']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['confpassword'] : '').'</label>
              <input type="password" id="confirm_password" name="confpassword" class="form-control" value="'.$confpassword.'" />
            </div>
            <p>Already have an account? <a href="login.php">Login</a> </p>
            <input type="hidden" name="register" value="1">
            <button class="btn btn-primary" type="submit">Register</button>
          </form>
        </div>
      </div>
    </div>
  </body>';
