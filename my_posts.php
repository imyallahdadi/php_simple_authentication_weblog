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
    $title = $_POST['title'];
    $category_id = $_POST['categories'];
    $content = $_POST['content'];

    try{

      $sql = "INSERT INTO posts (`user_id`, `category_id`, `title`, `content`) VALUES ('$user_id','$category_id','$title','$content');";
      $result = mysqli_query($conn, $sql);

      if($result === true){
        header("Location: ./my_posts.php");
      }

    }catch (mysqli_sql_exception $e){
      $message = $e->getMessage();
    }

  
  }
  
  
  $sql = "SELECT * FROM categories";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result);

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
        <a class="btn primary" href="blog_post.php">Write</a>
        <a class="btn" href="my_posts.php">Posts</a>
        <a class="btn" href="settings.php">Setings</a>
        <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>

      </nav>
    </header>


    <form action="write_post.php" method="POST">
    <h2>write a blog post</h2>
      <!-- Hidden user_id -->
      <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

      <label for="title">Title</label><br>
      <input type="text" id="title" name="title" value="" placeholder = "title" require><br><br>

      <label for="categories">categories</label><br>
      <select id="categories" name="categories" style = "width:20%; height:10%;">
        <?php foreach($rows as $row){
          echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';

        }
        ?>
      </select><br><br>

      <label for="content">content</label><br>
      <textarea id="content" name="content" style = "width: 500px; height:200px;" placeholder = "Hi, in this post I want to talk about..." require></textarea><br><br>

      <button type="submit">Post</button>
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
