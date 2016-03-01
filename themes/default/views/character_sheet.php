<?php

$char = $char[0];

$output .= '
<body>
    <div class="col-sm-5 col-sm-offset-3">
    
      <img src="themes/'.$config['theme'].'/views/images/ff11_logo.png" id="splashlogo">
      
      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit"></span> Character Sheet</em></div>
        <div class="panel-body">';
if (empty($char['charid'])) {
  $output .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span> Error retrieving character. Please check the Character ID and try again.</div>';
}
elseif (characterVisible($char['charid']) == 1 && ($char['accid'] != $user['id'])) {
  $output .= '<div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> This character is hidden from view</div>';
}
else {
  $output .= '
          <div class="text-center"><img src="themes/'.$config['theme'].'/views/images/portraits/HumeMale1b.jpg"></div>
          <p class="text-center"><strong>'.getTitle($char['title']).'</strong></p>
          <p class="text-center">'.$char['mlvl'].strtoupper($jobs[$char['mjob']]).(!empty($char['sjob']) ? '/'.$char['slvl'].strtoupper($jobs[$char['sjob']]) : '').'</p>
          ';
}
$output .= '
        </div>
      </div>
    </div>
  </body>';