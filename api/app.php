<?php
/* XIWeb Main Application for the API. 
 * 
 * Handle all endpoints and routing in here
 * 
 *  Parameters breakdown: [object]/[value]/[action]
 * 
 *  e.g. character/Juthien/view, zone/la-theine-plateau/delete
 * 
 */

$dbconn = new PDO('mysql:host=localhost;dbname=dspdb;charset=utf8', 'user', 'password');
$xiconn = new PDO('mysql:host=localhost;dbname=xiweb;charset=utf8', 'user', 'password');

$api_key = '1'; // Temporary, remove this after testing
$accid = 1015; // Temporary, remove this after getting the authentication system implemented

require_once("defines.php");

if (empty($_GET['api_key'])) {
    $result = API_KEY_MISSING;
}
else {
    if ($_GET['api_key'] != $api_key) {
        $result = API_KEY_INVALID;
    }
}

if (empty($_GET['q'])) {
    $result = MISSING_QUERY_STRING;
}

if (empty($result)) {
    $params = explode('/',$_GET['q']);
    
    switch ($params[0]) {
        case 'character': // The user is viewing a character page
            require_once('characterController.php');
            break;
        case 'zone': // The user is viewing a zone page
            require_once('zoneController.php');
            break;
        case 'account':
            require_once('accountController.php');
            break;
        case 'item':
            require_once('itemController.php');
            break;
        case 'auction-house':
            require_once('ahController.php');
            break;
        default:
            $result = INVALID_ACTION;
    }
}

echo json_encode($result);

?>
