<?php

define('INSTALLED',TRUE);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('PROTOCOL',"http://"); // Protocol to use (http:// or https://) [Default: [http://]
define('BASE_PATH',"jfurnas.localhost/XIWeb"); // Base path of the install (After the protocol, leave out trailing /)

$config['dspdb_host'] = 'localhost'; // Hostname of the DSP Database Server
$config['dspdb_port'] = '3306'; // Port of the DSP Database Server [Default: 3306]
$config['dspdb_user'] = 'dspdb'; // Username of the DSP Database User
$config['dspdb_pass'] = 'dspdb'; // Password of the DSP Database User
$config['dspdb_name'] = 'dspdb'; // Name of the DSP Database

// XIWeb Database Details ($config['xiweb_name'] is required, all the rest will assume settings from above if left blank)

$config['xiweb_host'] = ''; // Hostname of the XIWeb Database Server (Leave blank if the same user as DSP database)
$config['xiweb_port'] = ''; // Port of the XIWeb Database User (Leave blank if the same user as DSP database)
$config['xiweb_user'] = ''; // Username of the XIWeb Database User (Leave blank if the same user as DSP database)
$config['xiweb_pass'] = ''; // Password of the XIWeeb Database User (Leave blank if the same user as DSP database)
$config['xiweb_name'] = 'xiweb'; // Name of the XIWeb Database (Required)

// Account and character settings

$config['allow_account_creation'] = TRUE; // Allow users to create accounts themselves [Default: TRUE]
$config['allow_character_creation'] = TRUE; // Allow players to create new characters from the interface [Default: TRUE]
$config['allow_advanced_jobs'] = FALSE; // Allow players to select advanced jobs at character creation [Default: FALSE]

// Friends list and Messaging system

$config['enable_friends'] = TRUE; // Enable the Friends list [Default: TRUE]
$config['enable_message'] = TRUE; // Enable the Messaging system [Default: TRUE]
?>
