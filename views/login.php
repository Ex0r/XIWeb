<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$output .= '
  <body>
    <div class="col-sm-5 col-sm-offset-3">
      <img src="views/images/ff11_logo.png" id="splashlogo">';
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
        <div class="panel-heading"><span class="glyphicon glyphicon-lock"></span> Log In to XIWeb</div>
        <div class="panel-body">
          <form method="POST" action="login.php">
            <div id="username-group" class="form-group '.(!empty($errors['username']) ? 'has-error' : '').'">
              <label class="control-label" for="username">Username or Email address '.(!empty($errors['username']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['username'] : '').'</label>
              <input type="text" name="username" class="form-control" value="'.$username.'" />
            </div>
            <div id="password-group" class="form-group '.(!empty($errors['password']) ? 'has-error' : '').'">
              <label class="control-label" for="username">Password '.(!empty($errors['password']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['password'] : '').'</label>
              <input type="password" name="password" class="form-control" value="'.$password.'" />
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember_me" '.(!empty($remember_me) ? 'checked' : '').'> Remember me
              </label>
            </div>
            <input type="hidden" name="auth" value="1">
            <button class="btn btn-primary" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>
  </body>';
