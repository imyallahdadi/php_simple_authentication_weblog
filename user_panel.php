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

  $sql = "SELECT * FROM posts";
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
          <p class="lead">Wish you have a good time...</p>
        </div>
      </div>

      <nav>
        <a class="btn primary" href="user_panel.php">Panel</a>
        <a class="btn" href="write_post.php">Write</a>
        <a class="btn" href="my_posts.php">Posts</a>
        <a class="btn" href="settings.php">Setings</a>
        <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>

      </nav>
    </header>

    <section class="hero">
      <div class="card">
        <h2>Explore, enjoy and learn...</h2>

        <div class="features">
        <h1>All posts</h1>

        </div>

        <div class="posts" id="posts">

          <?php foreach($rows as $row){

            $sql = "SELECT username FROM users WHERE user_id =" . $row[1];
            $result = mysqli_query($conn, $sql);
            $get_uname = mysqli_fetch_all($result);
            $username = $get_uname[0][0];

          
          ?>

          <div class="post">
            <div>
              <strong><?php echo $username . ' | ' . $row[3];  ?></strong>
              <div class="meta"><?php echo $row[5];  ?></div>          
            </div>
            <div><a href="/view_post.php?post_id=<?php echo $row[0] ?>">Read</a></div>
          </div>

          <?php } ?>

        </div>
      </div>

      

      <aside class="sidebar">

        <div class="card small">
          <h3>Search</h3>
          <p class="meta">in all users and posts...</p>
          <form onsubmit="alert('Subscribed!');return false;" style="margin-top:10px;display:flex;gap:8px">
            <input aria-label="email" placeholder="name, email, title, ..." style="flex:1;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:inherit"/>
            <button class="btn primary" type="submit">FInd</button>
          </form>
        </div>
       
        <div style="height:14px"></div>

        <div class="card small">
          <h3>Users</h3>
          <p class="meta">Hi — I'm a developer who likes clean UI. Use this template as a starting point for your personal site or project.</p>
          <p class="meta">Hi — I'm a developer who likes clean UI. Use this template as a starting point for your personal site or project.</p>

        </div>

      </aside>
    </section>

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
