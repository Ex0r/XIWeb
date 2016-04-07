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
                if ($params[2] == 'view') { // If they are viewing the character
                    $result = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['jobs'] = getCharacterJobs($charID);
                    $result['look'] = getCharacterLook($charID);
                    $result['profile'] = getCharacterProfile($charID);
                    $result['stats'] = getCharacterStats($charID);
                    $result['equipment'] = getCharacterEquipment($charID);
                    $result['inventory'] = getCharacterInventory($charID);
                    
                }
                elseif ($params[2] == 'jobs') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['jobs'] = getCharacterJobs($charID);
                }
                elseif ($params[2] == 'stats') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['stats'] = getCharacterStats($charID);
                }
                elseif ($params[2] == 'profile') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['profile'] = getCharacterProfile($charID);
                }
                elseif ($params[2] == 'inventory') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['inventory'] = getCharacterInventory($charID);
                }
                elseif ($params[2] == 'equipment') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['equipment'] = getCharacterEquipment($charID);
                }
                elseif ($params[2] == 'experience') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['experience'] = getCharacterExperience($charID);
                }
                elseif ($params[2] == 'skills') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['skills'] = getCharacterSkills($charID);
                }
                elseif ($params[2] == 'spells') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
                    $result['jobs'] = getCharacterSpells($charID);
                }
                elseif ($params[2] == 'look') {
                    $res = $charDetails;
                    $charID = $charDetails['charid'];
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


function getCharacterDetails($charname) {
    global $dbconn;
    
    $strSQL = "SELECT charid, charname, nation, pos_zone, gmlevel, isnewplayer, mentor, campaign_allegiance, isstylelocked "
            . "FROM chars "
            . "WHERE charname=:charname";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charname',$charname);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return NULL;
        }
        else {
            return $arrReturn[0];
        }
        
    }
}

