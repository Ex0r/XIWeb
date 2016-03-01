<?php
require_once("includes/config.php");
require_once("includes/global.php");


// If the page requires authentication, and you are not authenticated, redirect to the login page

if (pagePermissions(basename($_SERVER['SCRIPT_FILENAME'],".php")) == 'require_auth') {
    if (empty($user['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirect("/login.php"); // Should be changed to the login page once it's completed
    }
}

// If we are viewing a character sheet, let's include the view for that. Otherwise, let's display the main characters display

if (!empty($_GET['id'])) {
    $charid = $_GET['id'];
    $char = getCharacter($charid);
    $page = "character_sheet";
}
else {
  $chars = getCharacterList($user['id']);
  $page = "characters";
}

include("themes/".$config['theme']."/views/header.php");
include("themes/".$config['theme']."/views/$page.php");
include("themes/".$config['theme']."/views/footer.php");
echo $output;
