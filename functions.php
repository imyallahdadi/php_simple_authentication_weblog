<?php

function generateRandomString($length = 16) {
    // Characters to pick from
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        // cryptographically secure random index
        $index = random_int(0, $charactersLength - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}


?>
