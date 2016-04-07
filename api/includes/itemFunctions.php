<?php

/* ITEM RELATED FUNCTIONS */

function getItemDetails($itemname) {
    global $dbconn;
    
    $strSQL = "SELECT * FROM "
            . "item_basic "
            . "JOIN item_armor ON item_basic.itemid=item_armor.itemid "
            . "WHERE item_basic.name=:itemname";
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
            