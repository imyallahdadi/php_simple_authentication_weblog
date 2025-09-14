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
<style>
    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* عکس پر کنه */
      border-radius: inherit; /* گردی همون لوگو */
    }

</style>

<?php

session_start();

include 'db.php';
include 'functions.php';

if(isset($_SESSION['is_logged']) === true ) {

  


  $sql = "SELECT * FROM posts WHERE user_id = " . $_SESSION['user_id'];
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result);
?>


<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">
          <img src="<?='/get_image.php?imgsrc=statics/images/' . md5($_SESSION['user_id']) . '.png'; ?>" onerror="this.src='/statics/images/user.png'" alt="logo"></img>
        </div>
        <div>
          <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
          <p class="lead">Wish you have a good time...</p>
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


    <div class="posts" id="posts">

      <?php foreach($rows as $row){ ?>

      <div class="post">
        <div>
          <strong><?php echo '- category: ' . categoryid_to_name($conn, $row[2]) . ' | title: ' , $row[3] , ' | publication_date: ' , $row[5] . '<br>'; ?></strong>
          <div class="meta"><?php echo $row[5];  ?></div>          
        </div>
        <div>
          <a href="/view_post.php?post_id=<?php echo $row[0] ?>">Read | </a>
          <a href="/view_post.php?post_id=<?php echo $row[0] ?>">edit | </a>
          <a href="/view_post.php?post_id=<?php echo $row[0] ?>">delete</a>
        </div>
      </div>

      <?php } ?>

    </div>


<?php

  echo "<br>";

  if(array_key_exists('msg' , $_GET)){
    $message = $_GET['msg'];
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
