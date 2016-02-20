<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("includes/functions.php");

global $dbconn;
global $xiconn;
$dbconn = new PDO('mysql:host='.$config['dspdb_host'].';dbname='.$config['dspdb_name'].';charset=utf8mb4', $config['dspdb_user'], $config['dspdb_pass']);
$xiconn = new PDO('mysql:host='.$config['xiweb_host'].';dbname='.$config['xiweb_name'].';charset=utf8mb4', $config['xiweb_user'], $config['xiweb_pass']);


if (!empty($_SESSION['xiweb_auth'])) {
    $user = authenticate($_SESSION['xiweb_auth_username']);
}
