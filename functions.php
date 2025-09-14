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

function uid_to_uname($conn, $post_user_id){
  $sql = "SELECT username FROM users WHERE user_id =" . $post_user_id;
  $result = mysqli_query($conn, $sql);
  $get_uname = mysqli_fetch_assoc($result);
  return $get_uname['username'];

}

function categoryid_to_name($conn, $category_id){
  $sql = "SELECT category_name FROM categories WHERE category_id =" . $category_id;
  $result = mysqli_query($conn, $sql);
  $get_categoryname = mysqli_fetch_assoc($result);
  return $get_categoryname['category_name'];

}


?>
