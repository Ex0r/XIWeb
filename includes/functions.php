<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * pagePermissions($page): Check the permissions of the page to see if authentication is required
 */
function pagePermissions($page) {
    if ($page == "index") {
        return "require_auth";
    }
}

/*
 * redirect($page): Redirect the visitor to $page, taking into account PROTOCOL and BASE_PATH
 */
function redirect($page) {
    header("Location:". PROTOCOL . BASE_PATH . "$page");
}

function checkUsername($username) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE login=:login";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':login',$username);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }    
}

function checkEmail($email) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE email=:email";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':email',$email);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }    
}

function getNextAccountID() {
  global $dbconn;
  
  $strSQL = "SELECT MAX(id) AS total FROM accounts";
  $statement = $dbconn->prepare($strSQL);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 0;
    }
    else {
       return $arrReturn[0]['total'] + 1;
    }
  }
}

function doRegister($username,$email,$password) {
  global $dbconn;
  
  $next_id = getNextAccountID();
  
  $strSQL = "INSERT INTO accounts (`id`,`login`,`email`,`password`,`timecreate`,`timelastmodify`) VALUES (:next_id,:login,:email,PASSWORD(:password),:timestamp,:timestamp)";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':next_id',$next_id);
  $statement->bindValue(':login',$username);
  $statement->bindValue(':email',$email);
  $statement->bindValue(':password',$password);
  $statement->bindValue(':timestamp',date('Y-M-D h:m:s',time()));
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return FALSE;
  }
  else {
    return TRUE;
  }
}

function authenticate($username) {
  global $dbconn;
    
  $strSQL = "SELECT * FROM accounts WHERE (login = :username OR email = :username)";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':username',$username);
  if (!$statement->execute()) { 
    watchdog($statement->errorInfo(),'SQL'); 
  }
  else {
    $arrReturn = $statement->fetchAll(); 
  }
  if (!empty($arrReturn)) {
    $user['id'] = $arrReturn[0]['id'];
  }
  else {
    $user['id'] = 0;
  }
   
  $user['authed'] = TRUE;
  return $user;
}

function doLogin($username,$password) {
   global $dbconn;
   
  $strSQL = "SELECT * FROM accounts WHERE (login = :username OR email = :username) AND password = PASSWORD(:password)";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':username',$_POST['username']);
  $statement->bindValue(':password',$_POST['password']);
  if (!$statement->execute()) { 
    watchdog($statement->errorInfo(),'SQL'); 
  }
  else {
    $arrReturn = $statement->fetchAll(); 
  }
  if (!empty($arrReturn)) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}