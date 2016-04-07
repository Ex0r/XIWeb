<?php

/* ITEM RELATED FUNCTIONS */

function getItemDetails($itemname) {
    global $dbconn;
    
    $strSQL = "SELECT * FROM item_basic WHERE name=:itemname";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':itemname',$itemname);
    
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

function getItemType($itemid) {
    global $dbconn;
    
    if (!empty(isItemWeapon($itemid))) {
        return 'weapon';
    }
    elseif (!empty(isItemFurnishing($itemid))) {
        return 'furnishing';
    }
    elseif (!empty(isItemArmor($itemid))) {
        return 'armor';
    }
    elseif (!empty(isItemUsable($itemid))) {
        return 'usable';
    }
}

function isItemWeapon($itemid) {
    global $dbconn;
    
    $strSQL = "SELECT * FROM item_weapon WHERE itemid=:itemid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':itemid',$itemid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return false;
        }
        else {
            return true;
        }
    }
}

function isItemFurnishing($itemid) {
    global $dbconn;
   
    $strSQL = "SELECT * FROM item_furnishing WHERE itemid=:itemid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':itemid',$itemid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return false;
        }
        else {
            return true;
        }
    }
}

function isItemArmor($itemid) {
    global $dbconn;
    
    $strSQL = "SELECT * FROM item_armor WHERE itemid=:itemid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':itemid',$itemid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return false;
        }
        else {
            return true;
        }
    }
}

function isItemUsable($itemid) {
    global $dbconn;
    
    $strSQL = "SELECT * FROM item_usable WHERE itemid=:itemid";
    $statement = $dbconn->prepare($strSQL);
    $statement->bindValue(':itemid',$itemid);
    
    if (!$statement->execute()) {
        return UNKNOWN_ERROR;
    }
    else {
        $arrReturn = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($arrReturn)) {
            return false;
        }
        else {
            return true;
        }
    }
}
    
            