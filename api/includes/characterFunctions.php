<?php

/* CHARACTER RELATED FUNCTIONS */

function getCharacterDetails($charname) {
    global $dbconn;
    
    $strSQL = "SELECT accid, charid, charname, nation, pos_zone, gmlevel, isnewplayer, mentor, campaign_allegiance, isstylelocked "
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
            return NULL;
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
            return NULL;
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
            return NULL;
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
            return NULL;
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
            return NULL;
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
            return NULL;
        }
        else {
            return $arrReturn[0];
        }
        
    }
}

function getCharacterVisibility($charid) {
    global $xiconn;
    
    $strSQL = "SELECT visibility "
            . "FROM chars_visibility "
            . "WHERE charid=:charid";
    $statement = $xiconn->prepare($strSQL);
    $statement->bindValue(':charid',$charid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return TRUE;
        }
        else {
            if ($arrReturn[0]['visibility'] == 1) {
                return TRUE;
            }
            else {
            return FALSE;
            }
        }
        
    }
}

?>