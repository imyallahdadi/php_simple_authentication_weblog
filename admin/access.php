<?php

function getUserIP() {
    $ip = '';

    # the vulnerability is here:
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] !== '') {
        // Use the forwarded IP address if it exists
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] !== '') {
        // Use the remote IP address as a fallback
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Additional checks and validation can be added here, depending on your requirements

    return $ip;
}

if(getUserIP() != '192.168.118.1' and getUserIP() != '127.0.0.1'){
    echo "Access denied!";
    die;
}

?>