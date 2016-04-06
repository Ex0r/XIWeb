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

if (count($params) < 2) {
    $result = INVALID_PARAMETER_LENGTH;
}
else {
    if ($params[1] == 'list') { // We want to list all the characters
        
        $result = 'List all characters on the server';  // Remove after development
    }
    else {
        if (count($params) >= 3) {
            if ($params[2] == 'view') { // If they are viewing the character
                
                $result = 'Viewing character'; // Remove after development
            }
            elseif ($params[2] == 'delete') { // If they decided to delete the character
                if (!empty($params[3]) && $params[3] == 'confirm') { // They've confirmed deletion, so let's delete
                    
                    $result = 'Deleting character with confirmation';  // Remove after development
                }
                else { // They haven't confirmed yet, so let's prompt them to make sure they want to delete
                    
                    $result = 'Deleting character';  // Remove after development
                }
            }
            else {
                $result = INVALID_PARAMETER; // They gave us an invalid parameter, let's inform them
            }
        }
        else {
            $result = INVALID_PARAMETER_LENGTH;
        }
    }
}
            
?>