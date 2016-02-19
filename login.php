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
        $page = "index.php";
    }
    redirect($page);
}

$data = array();
$errors = array();

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
            $errors['form-help'][] = 'Password field required fields';
            $errors['password'] = 'Required';
        }
        else {
            $password = $_POST['password'];
        }
    }
    if (!empty($_POST['remember_me'])) {
        $remember_me = true;
    }
}


include("views/login.php");
echo $output;