<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Iman weblog system</title>
  <meta name="description" content="A clean and smooth HTML template." />
  <link rel="stylesheet" href="./statics/styles.css" />
  <script src="/statics/functions.js"></script>
  <style>
    .posts-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1rem;
      margin-top: 2rem;
    }
    .post-card {
      background: #fff;
      border-radius: 12px;
      padding: 1.2rem;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .post-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .post-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: .5rem;
      color: #1d3557;
    }
    .post-meta {
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 1rem;
    }
    .btn-view {
      display: inline-block;
      background: #007BFF;
      color: #fff;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      text-decoration: none;
      transition: background 0.2s ease;
    }
    .btn-view:hover {
      background: #0056b3;
    }
  </style>
</head>

<?php
session_start();
include 'db.php';

if(isset($_SESSION['is_logged']) === true ) {

    if(array_key_exists('post_id' , $_GET)){
        $post_id = $_GET['post_id'];
    

        $sql = "SELECT * FROM posts WHERE post_id =" . $post_id;
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result);

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
          <a class="btn" href="my_posts.php">Posts</a>
          <a class="btn" href="settings.php">Setings</a>
          <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>
        </nav>
      </header>

      <h2>My Posts</h2>

      <div class="posts-container">
          <div class="post-card">
            <div class="post-title"><?php echo "Title: " . htmlspecialchars($rows[0][3]); ?></div>
            <div class="post-meta">
              Category: <?php echo htmlspecialchars($category_name); ?><br>
              Published: <?php echo htmlspecialchars($rows[0][5]); ?><br>
              content: <?php echo htmlspecialchars($rows[0][4]); ?>
            </div>
          </div>
      </div>

    <?php }else{
      $message = "no post found :(";
    }





    if(isset($message)){
      echo "<p>$message</p>"; 
    }
    ?>

    <footer>
      © <span id="year"></span> Iman weblog system — All rights reserved ♥
    </footer>
  </div>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
<?php } else { ?>
  <script>
      alert('لطفاً ابتدا وارد حساب کاربری شوید.');
      window.location.href = 'login.php';
  </script>
<?php } ?>
</html>
