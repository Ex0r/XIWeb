<?php

$output = 
'<!DOCTYPE html>
<html lang="en">
  <head>
    <title>XIWeb</title>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> <!-- load bootstrap via CDN -->
    <link rel="stylesheet" type="text/css" href="themes/'.$config['theme'].'/views/css/stylesheet.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="themes/'.$config['theme'].'/views/js/ajax.js"></script>
  </head>';
  if (!empty($user['authed'])) {
    $output .= '
  
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">XIWeb</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="'.PROTOCOL . BASE_PATH .'/index.php">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Characters <span class="caret"></span></a>
          <ul class="dropdown-menu">
            '.($config['allow_character_creation'] ? '<li><a href="#"><span class="glyphicon glyphicon-plus"></span> Create Character</a></li>' : '').'
            <li><a href="'.PROTOCOL . BASE_PATH .'/characters.php"><span class="glyphicon glyphicon-eye-open"></span> View All Characters</a></li>
            <li role="separator" class="divider"></li>';
            $characters = getCharacterList($user['id']);
              if ($characters !== 'empty' && $characters !== 'error') {
                foreach ($characters as $character) {
                  $output .= '
            <li><a href="'.PROTOCOL . BASE_PATH .'/characters.php?id='.$character['charid'].'"><span class="glyphicon glyphicon-user"></span> '.$character['charname'].'</a></li>
                  ';
                }
              }
            $output .= '
          </ul>
        </li>
        '.($config['enable_ah'] ? '<li><a href="#">Auction House</a></li>' : '').'
        <li><a href="#">World Map</a></li>
        '.($config['enable_beastiary'] ? '<li><a href="#">Beastiary</a></li>' : '').'
        '.($config['enable_item_browser'] ? '<li><a href="#">Items</a></li>' : '').'
        '.($config['enable_support'] ? '<li><a href="#">Support</a></li>' : '').'
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Account</a></li>
        <li><a href="'.PROTOCOL . BASE_PATH .'/logout.php">Logout</a></li>';
        if ($config['enable_friends']) {
          $output .= '
        <li><a href="#">Friends <span class="badge">10</span></a></li>
          ';
        }
        if ($config['enable_messages']) {
          $output .= '
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Messages '.(getNewMessageCount($user['id']) > 0 ? '<span class="badge">'.getNewMessageCount($user['id']).'</span>' : '').'<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><span class="glyphicon glyphicon-edit"></span> Compose Message</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> View Messages '.(getNewMessageCount($user['id']) > 0 ? '<span class="badge">'.getNewMessageCount($user['id']).'</span>' : '').'</a></li>
          </ul>
        </li>
          ';
        }
        $output .= '
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  ';   
  }  
    