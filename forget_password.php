<?php
include 'header.php';
?>

<div class="container" style="max-width:400px; margin:50px auto;">

<h1>Forget assword</h1>
<br></br>

<body>

<?php

include 'db.php';
include 'functions.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST['username'] ?? '';
    
  $sql = "select * from users where username = '$username'";
  $result = mysqli_query($conn, $sql);
  
  if($result && mysqli_num_rows($result) == 1 ){

    $row = mysqli_fetch_assoc($result);
    $random_string = md5(generateRandomString(10));
    $sql = "UPDATE users SET `token` = '$random_string' WHERE username = '$username'";
    $update_result = mysqli_query($conn, $sql);

    //must email to user
    $message = "The reset link has been sent to your email: " . $row['email'] . "<br>";
    $message .= "http://" .  $_SERVER['SERVER_NAME'] . "/reset_password.php?token=$random_string";


  }else{
    $message = "Invalid username. please try again.";
  }

}


?>


    <form action="forget_password.php" method="post">
      <label for="username">Enter your username</label><br />
      <input type="text" id="username" name="username" value = "<?php if(array_key_exists('username', $_GET)) echo $_GET['username']; ?>" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />

      <button type="submit" class="btn primary" style="width:100%;">Submit</button>
      
    </form>



<?php
if(isset($message)){
  echo "<p>$message</p>";
}
?>

</body>

<?php
include 'footer.php'
?>