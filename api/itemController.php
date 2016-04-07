<?php

/* XIWeb Item Controller for the API. 
 * 
 * PARAMS LIST for $params[0] (items):
 * 
 * 1 - [item name] (or 'list' to list all characters)
 * 2 - [details]/[page number] (if 'list' specified)
 * 
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
        $itemID = $itemDetails['itemid'];
        
        if ($params[2] == 'type') {
            
            $result = getItemType($itemID);
           
            if (empty($itemDetails)) {
                $result = ITEM_DOESNT_EXIST;
            }
        }
        elseif ($params[2] == 'details') { // We are listing all the details of this item

            $result = $itemDetails;
            $result['type'] = getItemType($itemID);

            if (empty($itemDetails)) {
                $result = ITEM_DOESNT_EXIST;
            }
        }
        else {
            $result = INVALID_PARAMETER;
        }
    }
}
