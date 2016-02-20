<?php
require_once("includes/config.php");
require_once("includes/global.php");

if (!empty($user['authed'])) {
  $_SESSION['xiweb_auth'] = '';
  $_SESSION['xiweb_auth_username'] = '';
}
redirect("/login.php");
