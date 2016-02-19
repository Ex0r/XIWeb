<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$output = '
    <html>
        <head>
            <title>Look Im AJAXing!</title>
            <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> <!-- load bootstrap via CDN -->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        </head>

        <div class="col-sm-3 col-sm-offset-4">';

if (!empty($errors)) {
    $output .= '<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Please correct the following errors:<ul>';
    foreach ($errors['form-help'] as $error) {
        $output .= '<li>'.$error.'</li>';
    }
    $output .= '</ul></div>';    
}
$output .= '
        </div>
        <div class="col-sm-5 col-sm-offset-3">
            <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-lock"></span> Log In to XIWeb</div>
            <div class="panel-body">
            <form method="POST" action="login.php">
                <div id="username-group" class="form-group '.(!empty($errors['username']) ? 'has-error' : '').'">
                    <label class="control-label" for="username">Username or Email address</label>
                    <input type="text" name="username" class="form-control" />
                </div>
                <div id="password-group" class="form-group '.(!empty($errors['password']) ? 'has-error' : '').'">
                    <label class="control-label" for="username">Password</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <div class="checkbox">
                    <label>
                    <input type="checkbox" name="remember_me" '.(!empty($remember_me) ? 'checked' : '').'> Remember me
                    </label>
                </div>
                <input type="hidden" name="auth" value="1">
                <button type="submit">Login</button>
            </form>
            </div>
            </div>
        </div>
    </html>
    ';
