<?php
/* Verification de l'existance d'une session*/
function isConnected() {
    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        // session isn't started
        return false;
    }
    return true;
}
/* Création de la session + Cookie*/ 
function createSession($user_id) {
   session_start([
    'cookie_lifetime' => 600,
    ]); 
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

function detroySession () {
    session_destroy();
}