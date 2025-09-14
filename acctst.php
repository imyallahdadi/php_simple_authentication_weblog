<?php
include "header.php";
?>
<style>
    .card img {
      width: 250px;
      height: 250px;
      border-radius: 10%;   
      object-fit: cover;
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
include 'functions.php';
 
if(isset($_SESSION['is_logged']) === true){ ?>

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
        <a class="btn" href="my_posts.php">Posts</a>
        <a class="btn" href="settings.php">Setings</a>
        <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>

      </nav>
    </header>


<?php
    if(array_key_exists('username', $_GET)){ 
        $username=$_GET['username'];
        $username_safe = mysqli_real_escape_string($conn, $username);

        $sql="SELECT * FROM users WHERE username='$username_safe'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);

        $sql="SELECT * FROM posts WHERE user_id= " . $row['user_id'] . " ORDER BY post_id";
        $result=mysqli_query($conn, $sql);
        $user_posts=mysqli_fetch_all($result);        

        ?>


   <section class="hero">
        <div class="card-posts">
            <br>
            <div>
                <h1>All posts of <?php echo $username_safe ?></h1>
            </div>
            <div class="posts" id="posts">

            <?php foreach($user_posts as $user_post){ ?>

            <div class="post">
                <div>
                <strong><?php echo categoryid_to_name($conn, $user_post[2]) . ' | ' . $user_post[3] . ' | ' .  $row['username'] ?></strong>
                <div class="meta"><?php echo $user_post[5];  ?></div>          
                </div>
                <div><a href="/view_post.php?post_id=<?php echo $user_post[0] ?>">Read</a></div>
            </div>

            <?php } ?>

            </div>
        </div>

      

      <aside class="sidebar">

        <div class="card small">
            <img src="<?='/get_image.php?imgsrc=statics/images/' . md5($row['user_id']) . '.png'; ?>" onerror="this.src='/statics/images/user.png'" alt="logo" width="300" height="300"></img>
            <h2><?php echo $row['username']; ?></h2>
            <p class="username">First name: <?php echo $row['first_name']; ?></p>
            <p class="username">Last name: <?php echo $row['last_name']; ?></p>
            <p class="bio">Bio: <?php echo $row['bio']; ?></p>
            <p class="email">Email: <?php echo $row['email']; ?></p>
            <p class="registration">Register date: <?php echo $row['registration_data']; ?></p>

        </div>
       

      </aside>
    </section>
<?php }else{ ?>

  <script>
      alert('Username not found :(');
      window.location.href = 'user_panel.php';
  </script>



<?php } }else{ ?>

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




