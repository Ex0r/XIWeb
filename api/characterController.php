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

require_once('includes/characterFunctions.php');

/* CONTROLLER */

if (count($params) < 2) {
    $result = INVALID_PARAMETER_LENGTH;
}
else {
    if ($params[1] == 'list') { // We want to list all the characters
        if ($params[2] == 'all') {         
            $result = 'List all characters on the server';  // Remove after development
        }
        else {
            $result = 'List all of my characters'; // Remove after development
        }
    }
    else {
        if (count($params) >= 3) {
            $charname = $params[1];
            
            $charDetails = getCharacterDetails($charname);
            
            if (empty($charDetails)) {
                $result = CHARACTER_DOESNT_EXIST;
            }
            else {
                $result = $charDetails;
                $charID = $charDetails['charid'];
                if ($params[2] == 'view') { // If they are viewing the character
                    $result['jobs'] = getCharacterJobs($charID);
                    $result['look'] = getCharacterLook($charID);
                    $result['profile'] = getCharacterProfile($charID);
                    $result['stats'] = getCharacterStats($charID);
                    $result['skills'] = getCharacterSkills($charID);
                    $result['spells'] = getCharacterSpells($charID);
                    $result['equipment'] = getCharacterEquipment($charID);
                    $result['inventory'] = getCharacterInventory($charID);
                    $result['visibility'] = getCharacterVisibility($charID);
                    $result['points'] = getCharacterPoints($charID);
                    $result['storage'] = getCharacterStorage($charID);
                }
                elseif ($params[2] == 'jobs') {
                    $result['jobs'] = getCharacterJobs($charID);
                }
                elseif ($params[2] == 'stats') {
                    $result['stats'] = getCharacterStats($charID);
                }
                elseif ($params[2] == 'details') {
                    $result = getCharacterDetails($charname);
                }
                elseif ($params[2] == 'visibility') {
                    $result['visibility'] = getCharacterVisibility($charID);
                }
                elseif ($params[2] == 'storage') {
                    $result['storage'] = getCharacterStorage($charID);
                }
                elseif ($params[2] == 'points') {
                    $result['points'] = getCharacterPoints($charID);
                }
                elseif ($params[2] == 'profile') {
                    $result['profile'] = getCharacterProfile($charID);
                }
                elseif ($params[2] == 'inventory') {
                    $result['inventory'] = getCharacterInventory($charID);
                }
                elseif ($params[2] == 'equipment') {
                    $result['equipment'] = getCharacterEquipment($charID);
                }
                elseif ($params[2] == 'experience') {
                    $result['experience'] = getCharacterExperience($charID);
                }
                elseif ($params[2] == 'skills') {
                    $result['skills'] = getCharacterSkills($charID);
                }
                elseif ($params[2] == 'spells') {
                    $result['spells'] = getCharacterSpells($charID);
                }
                elseif ($params[2] == 'look') {
                    $result['look'] = getCharacterLook($charID);
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
        }
        else {
            $result = INVALID_PARAMETER_LENGTH;
        }
    }
}
