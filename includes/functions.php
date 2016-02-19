<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * pagePermissions($page): Check the permissions of the page to see if authentication is required
 */
function pagePermissions($page) {
    if ($page == "index") {
        return "require_auth";
    }
}

/*
 * redirect($page): Redirect the visitor to $page, taking into account PROTOCOL and BASE_PATH
 */
function redirect($page) {
    header("Location:". PROTOCOL . BASE_PATH . "$page");
}

function authenticate($username) {
    $user['authed'] = TRUE;
    $user['id'] = '1'; // Hardcoded until database implementation is complete
}