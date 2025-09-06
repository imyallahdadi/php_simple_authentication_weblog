<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Iman weblog system</title>
  <meta name="description" content="A clean and smooth HTML template." />
  <link rel="stylesheet" href="./statics/styles.css" />
  <script src="/statics/functions.js"></script>
</head>

<?php

session_start();

include 'db.php';

if(isset($_SESSION['is_logged']) === true ) {

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_POST['user_id'];
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $password_change = false;

    if($password === ""){
      $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio`= '$bio' WHERE `user_id` = " . intval($user_id);
    }else{ 
      $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `bio`= '$bio', `password`= '$password' WHERE `user_id` = " . intval($user_id);
      $password_change = true;
    }
 
    try {
      $result = mysqli_query($conn, $sql);

      if($result === true){
        if($password_change === true) header("Location: ./logout.php");
        else header("Location: ./settings.php");
      }

    } catch (mysqli_sql_exception $e){
      $message = $e->getMessage();
      print($message);
    }
    exit;
  }

  try{

    $sql = "SELECT * FROM users WHERE user_id = " . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sql);
    $user_information = mysqli_fetch_assoc($result);
    //print_r($user_information);


  }catch (mysqli_sql_exception $e){
      $message = $e->getMessage();
  }


?>


<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">SS</div>
        <div>
          <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
          <p class="lead">A minimal, responsive template for your website</p>
        </div>
      </div>

      <nav>
        <a class="btn" href="user_panel.php">Panel</a>
        <a class="btn" href="#">Write</a>
        <a class="btn" href="#">Posts</a>
        <a class="btn primary" href="settings.php">Setings</a>
        <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>

      </nav>
    </header>


    <img src="<?='/get_image.php?imgsrc=statics/images/' . md5($_SESSION['user_id']) . '.png'; ?>" onerror="this.src='/statics/images/user.png'" width="200" height="200"></img>

    <input type="file" id="imageUpload" accept="image/*">
    <progress id="uploadProgress" max="100" value="0"></progress>
    <div id="message"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/statics/upload.js"></script>



    <form action="settings.php" method="POST">
    <h2>Update User</h2>
      <!-- Hidden user_id -->
      <input type="hidden" name="user_id" value="<?= $user_information['user_id']; ?>">

      <label for="username">Username</label>
      <input type="text" id="username" name="username" value="<?= $user_information['username']; ?>" disabled><br><br>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= $user_information['email']; ?>" disabled><br><br>

      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" value="<?= $user_information['first_name']; ?>"><br><br>

      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" value="<?= $user_information['last_name']; ?>"><br><br>

      <label for="bio">Bio</label>
      <textarea id="bio" name="bio"><?= $user_information['bio']; ?></textarea><br><br>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" value=""><br><br>

      <button type="submit">Update</button>
    </form>


<?php } else{ ?>

  <script>
      alert('لطفاً ابتدا وارد حساب کاربری شوید.');
      window.location.href = 'login.php';
  </script>

<?php } ?>

    <footer>
      © <span id="year"></span> Iman weblog system — All rights reserved ♥
    </footer>
  </div>

  <script>
    // tiny script for year and small accessibility helpers
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>
