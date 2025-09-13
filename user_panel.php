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
      .user-list{
        background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
        padding:24px;
        max-height: 500px;
        overflow-y: auto;      
        border-radius:var(--radius);
        box-shadow:0 6px 30px rgba(2,6,23,0.6);
        border:1px solid rgba(255,255,255,0.03)
      }
      .card-posts{
        background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
        padding:24px;
        max-height: 1000px;
        overflow-y: auto;      
        border-radius:var(--radius);
        box-shadow:0 6px 30px rgba(2,6,23,0.6);
        border:1px solid rgba(255,255,255,0.03)
      }

      .user-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #080c3fff;
        border-radius: 9999px;   /* بیضی/کپسولی */
        padding: 5px 12px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: background 0.3s;
    } 

    .user-item img {
      width: 50px;
      height: 50px;
      border-radius: 50%;   /* گرد کردن عکس */
      object-fit: cover;
    }

    .user-item:hover {
      background: #080622ff;
    }

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

if(isset($_SESSION['is_logged']) === true ) {

  $sql = "SELECT * FROM posts";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_fetch_all($result);

  $sql = "SELECT user_id,username FROM users ORDER BY user_id";
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result);


function get_username($conn, $post_user_id){
  $sql = "SELECT username FROM users WHERE user_id =" . $post_user_id;
  $result = mysqli_query($conn, $sql);
  $get_uname = mysqli_fetch_assoc($result);
  return $get_uname['username'];

}

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
        <a class="btn primary" href="user_panel.php">Panel</a>
        <a class="btn" href="write_post.php">Write</a>
        <a class="btn" href="my_posts.php">Posts</a>
        <a class="btn" href="settings.php">Setings</a>
        <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>

      </nav>
    </header>

    <section class="hero">
      <div class="card-posts">
        <h2>Explore, enjoy and learn...</h2>

        <div class="features">
        <h1>All posts</h1>
        </div>

        <div class="posts" id="posts">

          <?php foreach($rows as $row){ ?>

          <div class="post">
            <div>
              <strong><?php echo get_username($conn, $row[1]) . ' | ' . $row[3];  ?></strong>
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

        <div class="user-list">
          <h3>Users</h3>
          <?php foreach($users as $user){
            $user_id = md5($user[0]);
          ?>
          <div class="user-item">
            <img src="<?='/get_image.php?imgsrc=statics/images/' . $user_id . '.png'; ?>" onerror="this.src='/statics/images/user.png'" alt="avatar"></img>
            <span><a href="<?='/accounting.php?username=' . $user[1] ?>"><?php echo $user[1]; ?></a></span>
          </div>
          <?php } ?>
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
