<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("includes/functions.php");

if (!empty($_SESSION['xiweb_auth'])) {
    $user = authenticate($_SESSION['xiweb_auth_username']);
}