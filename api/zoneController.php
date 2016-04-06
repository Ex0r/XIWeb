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
    
    $result = 'Viewing zone information for '.$params[1];  // Remove after development
}
            
?>