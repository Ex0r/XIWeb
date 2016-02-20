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

if (!empty($_COOKIE['xiweb_auth_username'])) {
  $_SESSION['xiweb_auth'] = true;
  $_SESSION['xiweb_auth_username'] = $_COOKIE['xiweb_auth_username'];
  authenticate($_SESSION['xiweb_auth_username']);
}

$username = '';
$password = '';

if (!empty($_POST['auth'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $errors['form-help'][] = 'Missing required fields';
        if (empty($_POST['username'])) {
            $errors['form-help'][] = 'Username field required';
            $errors['username'] = 'Required';
        }
        else {
            $username = $_POST['username'];
        }
        if (empty($_POST['password'])) {
            $errors['form-help'][] = 'Password field required';
            $errors['password'] = 'Required';
        }
        else {
            $password = $_POST['password'];
        }
    }
    else {
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      if (!doLogin($username,$password)) {
        $errors['form-help'][] = 'Could not log in using the credentials provided';
        $errors['username'] = 'Invalid';
        $errors['password'] = 'Invalid';
      }
    }
    if (!empty($_POST['remember_me'])) {
        $remember_me = true;
        setcookie('xiweb_auth_username',$username);
    }
    else {
      $_COOKIE['xiweb_auth_username'] = '';
    }
}

include("views/header.php");
include("views/login.php");
include("views/footer.php");
echo $output;