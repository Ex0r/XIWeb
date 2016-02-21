<?php
require_once("includes/config.php");
require_once("includes/global.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!empty($user['authed'])) {
    if (!empty($_SESSION['destination'])) {
        $page = $_SESSION['destination'];
        $_SESSION['destination'] = '';
    }
    else {
        $page = "/index.php";
    }
    redirect($page);
}

$username = '';
$email = '';
$password = '';
$confpassword = '';

if (!empty($_POST['register'])) {
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confpassword'])) {
      if (empty($_POST['username'])) {
            $errors['form-help'][] = 'Username field required';
            $errors['username'] = 'Required';
      }
      else {
        $username = $_POST['username'];
      }
      if (empty($_POST['email'])) {
            $errors['form-help'][] = 'Email field required';
            $errors['email'] = 'Required';
      }
      else {
        $email = $_POST['email'];
      }
      if (empty($_POST['password'])) {
            $errors['form-help'][] = 'Password field required';
            $errors['password'] = 'Required';
      }
      else {
        $password = $_POST['password'];
      }
      if (empty($_POST['confpassword'])) {
            $errors['form-help'][] = 'Confirm password field required';
            $errors['confpassword'] = 'Required';
      }
      else {
        $confpassword = $_POST['confpassword'];
      }
    }
    else {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confpassword = $_POST['confpassword'];
      
      if (!checkUsername($username)) { // If the username is available, return FALSE
        $errors['form-help'][] = 'Username not available';
        $errors['username'] = 'Not available';
      }
      elseif (preg_match('#[0-9]#',$username)){  
        $errors['form-help'][] = 'Username format is invalid';
        $errors['username'] = 'Username must only contain letters';
      }
      if ((strlen($username) < 4) || (strlen($username) > 16)) {
        $errors['form-help'][] = 'Invalid username length';
        $errors['username'] = 'Username must be between 4 and 16 characters';
      }
      
      elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors['form-help'][] = 'Email field is invalid';
        $errors['email'] = 'Incorrect format';
      }
      elseif (!checkEmail($email)) { // If the email is available, return FALSE
        $errors['form-help'][] = 'Email address in use';
        $errors['email'] = 'Not available';

        
      }
      if (strlen($password) < 6 || strlen($password) > 16) {
        $errors['form-help'][] = 'Invalid password length';
        $errors['password'] = 'Password must be between 6 and 16 characters';
      }
      if (strlen($confpassword) < 6 || strlen($confpassword) > 16) {
        $errors['form-help'][] = 'Invalid password length';
        $errors['confpassword'] = 'Password must be between 6 and 16 characters';
      }
      
      if ($password != $confpassword) {
        $errors['form-help'][] = 'Passwords do not match';
        $errors['password'] = 'Does not match';
        $errors['confpassword'] = 'Does not match';
      }
      if (empty($errors)) {
        if (!doRegister($username,$email,$password)) {
          $errors['form-help'][] = 'Error processing form. Please try again';
        }
        else {
          $_SESSION['xiweb_auth'] = true;
          $_SESSION['xiweb_auth_username'] = $username;
          redirect("/index.php");
        }
      }
    }
}

include("themes/".$config['theme']."/views/header.php");
include("themes/".$config['theme']."/views/register.php");
include("themes/".$config['theme']."/views/footer.php");
echo $output;