<?php

/* XIWeb Character Controller for the API. 
 * 
 * PARAMS LIST for $params[0] (characters):
 * 
 * 1 - [character name] (or 'list' to list all characters)
 * 2 - [view]/[delete] (if character name specified) or [page number] (if 'list' specified)
 * 3 - [confirm] (if delete specified)
 * 
 *  
 */

require_once('includes/itemFunctions.php');

/* CONTROLLER */

if (count($params) < 2) {
    $result = INVALID_PARAMETER_LENGTH;
}
else {
    if ($params[1] == 'list') { // We want to list all the characters
        $result = 'List all items on the server'; // Remove after development
    }
    else {
        $itemname = strtolower($params[1]);
        $itemname = str_replace(' ','_',$itemname);
        $itemDetails = getItemDetails($itemname);
        
        $result = $itemDetails;
       
        if (empty($itemDetails)) {
            $result = ITEM_DOESNT_EXIST;
        }
    }
}
