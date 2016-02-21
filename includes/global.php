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

$jobs = array(
0 => "",
1 => "war",
2 => "mnk",
3 => "whm",
4 => "blm",
5 => "rdm",
6 => "thf",
7 => "pld",
8 => "drk",
9 => "bst",
10 => "brd",
11 => "rng",
12 => "sam",
13 => "nin",
14 => "drg",
15 => "smn",
16 => "blu",
17 => "cor",
18 => "pup",
19 => "dnc",
20 => "sch",
21 => "geo",
22 => "run"
);
