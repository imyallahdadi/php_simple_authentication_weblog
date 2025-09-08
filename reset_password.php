<?php
include 'header.php';
?>

<div class="container" style="max-width:400px; margin:50px auto;">

<h1>Reset password</h1>
<br></br>

<body>


<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
    
  $sql = "UPDATE users SET `password` = '$password' WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  
  if($result === true ){
    $sql = "UPDATE users SET `token` = NULL WHERE username = '$username'";
    $token_null = mysqli_query($conn, $sql);

    header("Location: ./login.php?msg=The new password chenged successfully");
  }
}


if(array_key_exists('token', $_GET)){

    $token = $_GET['token'];


    $sql = "SELECT * FROM users WHERE token = '$token'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) == 1 ){
        $row = mysqli_fetch_assoc($result);
        $token_result = true;
    }
}

if(isset($token_result) === true){?>


    <form action="reset_password.php" method="post">
      
      <label for="password">New Password</label><br />
      <input type="password" id="password" name="password" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />
      
      <button type="submit" class="btn primary" style="width:50%;">Reset password</button>
      <input type="hidden" id="username" name="username" value="<?php echo $row['username']; ?>" style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />


    </form>



<?php
}else{
    echo 'the provided token is not valid or expired, <a href="/login.php">go back</a> ';
}


?>






</body>

<?php
include 'footer.php'
?>