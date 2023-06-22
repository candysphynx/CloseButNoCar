<?php
/* Verification de l'existance d'une session*/
function isConnected() {
    if(isset($_SESSION['user_id'])) {
        // session isn't started
        
        return true;
    }
    return false;
}
/* Création de la session + Cookie*/ 
function createUserSession($user_id) {
    $_SESSION['user_id'] = $user_id;
}
/* Récuperer la valeur d'une des clefs créés de la session courante */

function getValueByKey($key) {
    return $_SESSION[$key];
}
/* Creer une valeur dans la session courante */

function setValue($key,$value) {
    $_SESSION[$key] = $value;
}

/* Stopper la session */

function destroySession () {
    session_destroy();
    
}