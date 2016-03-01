<?php

$output .= '
<body>
    <div class="col-sm-5 col-sm-offset-3">
    
      <img src="themes/'.$config['theme'].'/views/images/ff11_logo.png" id="splashlogo">
      
      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-heart"></span> Friends List for - <em>Accountname</em></div>
        <div class="panel-body">
          <table class="table">
            <tbody>';
            if ($friends == 'error') {
              $output .= '
              <tr>
                <td colspan=5><em>Could not retrieve friends list</em></td>
              </tr>';
            }
            elseif ($friends == 'empty') {
              $output .= '
              <tr>
                <td colspan=5><em>You don\'t have any friends</em></td>
              </tr>';
            }
            else {
              if (sizeof($friends['pending']) > 0) {
                $output .= '<tr>';
                  $output .= '<td scope="row" colspan=3 class="warning">Pending Friends</td>';
                $output .= '</tr>';
                foreach ($friends['pending'] as $friend) {
                  $output .= '<tr>';
                  $output .= '<td colspan=2>'.getAccount($friend['accid']).'</td>';
                  $output . '<td><a href="#">Cancel</a></td>';
                  $output .= '</tr>';
                }
              }
              if (sizeof($friends['online']) > 0) {
                $output .= '<tr>';
                $output .= '<td scope="row" colspan=3 class="success">Online Friends</td>';
                $output .= '</tr>';
                foreach ($friends['online'] as $fr) {
                  $output .= '<tr>';
                  $output .= '<td>'.getAccount($fr[0]).'</td>';
                  $output .= '<td>'.$fr['character'][0]['charname'].'</td>';
                  $output .= '<td>'.getZoneName($fr['character'][0]['pos_zone']).'</td>';
                  $output .= '</tr>';
                }
              }
              if (sizeof($friends['offline']) > 0) {
                $output .= '<tr>';
                $output .= '<td scope="row" colspan=3 class="danger">Offline Friends</td>';
                $output .= '</tr>';
                foreach ($friends['offline'] as $fr) {
                  $output .= '<tr>';
                  $output .= '<td>'.getAccount($fr).'</td>';
                  $output .= '</tr>';
                }
              }
            }
            $output .= '
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>';