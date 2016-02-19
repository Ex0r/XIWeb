<?php
require_once("includes/global.php");
require_once("includes/config.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (empty($user['authed'])) {
    redirect(PROTOCOL . BASE_PATH . "/login.php");
}
