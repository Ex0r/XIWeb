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
            if ($params[2] == 'view') { // If they are viewing the character
                $charname = $params[1];
                $charDetails = getCharacterDetails($charname);
                if ($charDetails == CHARACTER_DOESNT_EXIST) {
                    $result = $charDetails;
                }
                else {
                    $charID = $charDetails['charid'];
                    $result = $charID;
                    $charJobs = getCharacterJobs($charID);
                    $charLook = getCharacterLook($charID);
                    $charProfile = getCharacterProfile($charID);
                    $charEquipment = getCharacterEquipment($charID);
                    $charSkills = getCharacterSkills($charID);
                    $charStats = getCharacterStats($charID);
                    $charInventory = getCharacterInventory($charID);
                    $charExp = getCharacterExperience($charID);
                    
                    // Now we have to merge all of the arrays together so we can return it.
                    $result = array_merge(
                        $charDetails,
                        $charJobs,
                        $charLook, 
                        $charProfile, 
                        $charEquipment,
                        $charSkills,
                        $charStats,
                        $charInventory,
                        $charExp
                    );
                }
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


function getCharacterDetails($charname) {
    global $dbconn;
    
    $strSQL = "SELECT * "
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
            return CHARACTER_DOESNT_EXIST;
        }
        else {
            $arrReturn[0]['merits'] = '';
            $arrReturn[0]['missions'] = '';
            $arrReturn[0]['assault'] = '';
            $arrReturn[0]['campaign'] = '';
            $arrReturn[0]['quests'] = '';
            $arrReturn[0]['keyitems'] = '';
            $arrReturn[0]['spells'] = '';
            $arrReturn[0]['set_blue_spells'] = '';
            $arrReturn[0]['abilities'] = '';
            $arrReturn[0]['titles'] = '';
            $arrReturn[0]['zones'] = '';
            $arrReturn[0]['unlocked_weapons'] = '';

            return $arrReturn[0];
        }
        
    }
}

/* CHARACTER RELATED FUNCTIONS */

function getCharacterJobs($charid) {
    global $dbconn;
    
    $strSQL = "SELECT * "
            . "FROM char_jobs "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
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

function getCharacterLook($charid) {
    global $dbconn;
    
    $strSQL = "SELECT * "
            . "FROM char_look "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return array(NULL);
        }
        else {
            return $arrReturn[0];
        }
        
    }
}

function getCharacterProfile($charid) {
    global $dbconn;
    
    $strSQL = "SELECT * "
            . "FROM char_profile "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
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

function getCharacterEquipment($charid) {
    global $dbconn;
    
    $strSQL = "SELECT * "
            . "FROM char_equip "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return array(NULL);
        }
        else {
            return $arrReturn;
        }
        
    }
}

function getCharacterSkills($charid) {
    global $dbconn;
    
    $strSQL = "SELECT skillid, value, rank "
            . "FROM char_skills "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return array(NULL);
        }
        else {
            return $arrReturn;
        }
        
    }
}

function getCharacterStats($charid) {
    global $dbconn;
    
    $strSQL = "SELECT * "
            . "FROM char_stats "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return array(NULL);
        }
        else {
            return $arrReturn;
        }
        
    }
}


function getCharacterInventory($charid) {
    global $dbconn;
    
    $strSQL = "SELECT * "
            . "FROM char_inventory "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return array(NULL);
        }
        else {
            return $arrReturn[0];
        }
        
    }
}


function getCharacterExperience($charid) {
    global $dbconn;
    
    $strSQL = "SELECT * "
            . "FROM char_exp "
            . "WHERE charid=:charid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return array(NULL);
        }
        else {
            return $arrReturn[0];
        }
        
    }
}

?>