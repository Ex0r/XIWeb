<?php

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

?>