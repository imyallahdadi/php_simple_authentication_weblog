<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Iman weblog system</title>
  <meta name="description" content="A clean and smooth HTML template." />
  <link rel="stylesheet" href="./statics/styles.css" />
</head>


<body>
<div class="container" style="max-width:400px; margin:50px auto;">
<h2>Login</h2>

<?php
include 'db.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "select * from users where username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) == 1 ){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['is_logged'] = true;
      $_SESSION['username'] = $row['username'];
      $_SESSION['user_id'] =  $row['user_id'];
      header('Location: user_panel.php');
      exit;
    }else {
        $message = "Invalid username/password. please try again. if you cannot remmember your password please <a href = '/forget_password.php?username=$username' style = 'width:100%'>click here</a>";
        //$username = $_POST['username'] ?? '';

    }
}

if(isset($_SESSION['is_logged']) === true){
  header('Location: user_panel.php');
  exit;
}

?>

    <form action="login.php" method="post">
      <label for="username">Username</label><br />
      <input type="text" id="username" name="username" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />
      
      <label for="password">Password</label><br />
      <input type="password" id="password" name="password" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />
      
      <button type="submit" class="btn primary" style="width:50%;">Login</button>
      <a class = "btn primary" href = "/register.php" style = "width:50%">Sign Up</a><br></br>
    </form>


<?php

if(array_key_exists('msg', $_GET)){
  $message = $_GET['msg'];
}

if(isset($message)){
  echo "<p>$message</p>";
}
?>


</body>



<?php
include 'footer.php'
?>