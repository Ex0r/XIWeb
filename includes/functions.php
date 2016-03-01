<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
function getCharacterName($charid) {
  global $dbconn;
  
  $strSQL = "SELECT charname FROM chars WHERE charid=:charid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return '';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return '';
    }
    else {
      return $arrReturn[0]['charname'];
    }
  }
}

function getCharacter($charid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM chars JOIN char_stats ON chars.charid=char_stats.charid JOIN char_jobs ON chars.charid=char_jobs.charid WHERE chars.charid=:charid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}
 
function getCharacterList($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM chars JOIN char_stats ON chars.charid=char_stats.charid JOIN char_jobs ON chars.charid=char_jobs.charid WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

/*
 * pagePermissions($page): Check the permissions of the page to see if authentication is required
 */
function pagePermissions($page) {
    global $xiconn;
    
    $strSQL = "SELECT * FROM page_permissions WHERE pagename = :pagename";
    $statement = $xiconn->prepare($strSQL);
    $statement->bindValue(':pagename',$page);
    
    if (!$statement->execute()) {
      watchdog($statement->errorInfo(),'SQL');
      return 'no_auth';
    }
    else {
      $arrReturn = $statement->fetchAll();
      
      if (empty($arrReturn)) {
        return 'no_auth';
      }
      else {
        return $arrReturn[0]['permission'];
      }
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

function characterVisible($charid) {
  global $xiconn;
  
  $strSQL = "SELECT * FROM chars_visibility WHERE charid=:charid";
  $statement = $xiconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    return FALSE;
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return FALSE;
    }
    else {
      return $arrReturn[0]['status'];
    }
  }
}

function characterFavorited($charid,$accid) {
  global $xiconn;
  
  $strSQL = "SELECT * FROM chars_favorites WHERE charid=:charid AND accid=:accid";
  $statement = $xiconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    return FALSE;
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
}

function getZoneName($zoneid) {
  global $dbconn;
  
  $strSQL = "SELECT name FROM zone_settings WHERE zoneid=:zoneid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':zoneid',$zoneid);
  
  if (!$statement->execute()) {
    return 'Error retrieving zone name';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'Error retrieving zone name';
    }
    else {
      return str_replace('_',' ',$arrReturn[0]['name']);
    }
  } 
}

function getTitle($titleid) {
  global $xiconn;
  
  $strSQL = "SELECT title FROM titles WHERE titleid=:titleid";
  $statement = $xiconn->prepare($strSQL);
  $statement->bindValue(':titleid',$titleid);
  
  if (!$statement->execute()) {
    return 'Error retrieving zone name';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'Error retrieving zone name';
    }
    else {
      return ucwords(strtolower(str_replace('_',' ',$arrReturn[0]['title'])));
    }
  } 
}

function getFriendsList($accid) {
  global $xiconn;
  
  $friendsList = array();
  
  $strSQL = "SELECT * FROM accounts_friends WHERE accid=:accid OR friendaccid=:accid";
  $statement = $xiconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      foreach ($arrReturn as $fr) {
        if ($fr['status'] == 0) {
          $friendsList['pending'][] = $fr;
        }
        elseif ($fr['status'] == 1) {
          $friendsList['accepted'][] = $fr;
        }
      }
      return $friendsList;
    }
  }
}

function isOnline($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts_sessions WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return FALSE;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
}

function getAccount($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE id=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return NULL;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return NULL;
    }
    else {
      return $arrReturn[0]['login'];
    }
  }
}

function getOnlineCharacterID($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts_sessions WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return NULL;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return NULL;
    }
    else {
      return $arrReturn[0]['charid'];
    }
  }
}