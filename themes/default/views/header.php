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
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Characters <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><span class="glyphicon glyphicon-plus"></span> Create Character</a></li>
            <li><a href="characters.php"><span class="glyphicon glyphicon-eye-open"></span> View All Characters</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 1</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 2</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 3</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 4</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 5</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 6</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 7</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 8</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 9</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 10</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 11</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 12</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 13</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 14</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 15</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Character 16</a></li>
          </ul>
        </li>
        <li><a href="#">Auction House</a></li>
        <li><a href="#">World Map</a></li>
        <li><a href="#">Beastiary</a></li>
        <li><a href="#">Item Browser</a></li>
        <li><a href="#">Support System</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Account</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="#">Friends <span class="badge">10</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Messages <span class="badge">1</span><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><span class="glyphicon glyphicon-edit"></span> Compose Message</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> View Messages</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  ';   
  }  
    