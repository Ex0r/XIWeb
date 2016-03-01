<?php

$output .= '
<body>
    <div class="col-sm-5 col-sm-offset-3">
    
      <img src="themes/'.$config['theme'].'/views/images/ff11_logo.png" id="splashlogo">
      
      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-edit"></span> Character List for - <em>Accountname</em></div>
        <div class="panel-body">
          <p>
            <span class="small"><em>Characters marked <strong>invisible</strong> will only appear to you and GMs/Admins</em></span><br />
            <span class="small"><em><strong>Deleted</strong> characters are untrievable</em></span><br />
            <span class="small"><em>Your <strong>favorited</strong> character will be used for all default character transactions</em></span>
          </p>
          <p><span class="glyphicon glyphicon-info-sign"></span> Click on a character to view their character sheet</p>
          '.($config['allow_character_creation'] ? '<p><button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create Character</button></p>' : '').'
          <table class="table">
            <thead>
              <tr>
                <th>Character Name</th>
                <th>Level</th>
                <th>Current Zone</th>
                <th>Controls</th>
              </tr>
            </thead>
            <tbody>';
            if ($chars == 'error') {
              $output .= '
              <tr>
                <td colspan=5><em>Could not retrieve characters</em></td>
              </tr>';
            }
            elseif ($chars == 'empty') {
              $output .= '
              <tr>
                <td colspan=5><em>You don\'t have any characters '.($config['allow_character_creation'] ? 'use the \'Create Character\' button above to make one' : '').'</em></td>
              </tr>';
            }
            else {
              foreach ($chars as $char) {
                if (characterFavorited($char['charid'],$user['id'])) {
                  $output .= '<tr class="success">';
                }
                elseif (characterVisible($char['charid']) == 1) {
                  $output .= '<tr class="warning">';
                }
                else {
                  $output .= '<tr>';
                }
                $output .= '
                <td><a href="characters.php?id='.$char['charid'].'">'.$char['charname'].'</a></td>
                <td>'.$char['mlvl'].strtoupper($jobs[$char['mjob']]).(!empty($char['sjob']) ? '/'.$char['slvl'].strtoupper($jobs[$char['sjob']]) : '').'</td>
                <td>'.getZoneName($char['pos_zone']).'</td>
                <td>'.(characterVisible($char['charid']) == 0 ? '<span class="glyphicon glyphicon-eye-open" title="Make Character Hidden"></span>' : '<span class="glyphicon glyphicon-eye-close" title="Make Character Visible"></span>').' | '.(characterFavorited($char['charid'],$user['id']) ? '<span class="glyphicon glyphicon-heart" title="Make Character Favorite"></span>' : '<span class="glyphicon glyphicon-heart-empty" title="Unfavorite Character"></span>').' | <span class="glyphicon glyphicon-remove" title="Delete Character"></span></td>
              </tr>';
              }
            }
            $output .= '
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>';