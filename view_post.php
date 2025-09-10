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

    if(array_key_exists('post_id' , $_GET)){
        $post_id = $_GET['post_id'];
    }

    $sql = "SELECT * FROM posts WHERE post_id =" . $post_id;
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    print_r($rows);


    $sql = "SELECT category_name FROM categories WHERE category_id = " . $rows[0][2];
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_all($result);
    $category_name = $category[0][0];



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
        <a class="btn" href="write_post.php">Write</a>
        <a class="btn primary" href="my_posts.php">Posts</a>
        <a class="btn" href="settings.php">Setings</a>
        <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>

      </nav>
    </header>

    <h2>My posts</h2>


<?php



  foreach($rows as $row){


    echo 'title: ' , $row[3] , ', publication_date: ' , $row[5] , ' <a href="/view_post.php?post_id=' . $row[0] . '">view post</a><br>';
  }

  
  if(isset($message)){
    echo "<p>$message</p>";
  }
?>

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
