<?php
session_start();
include 'access.php';
include '../header.php';
include '../db.php';

if (array_key_exists('operation', $_GET)){
  $op = $_GET['operation'];
  if($op == 'search' && isset($_GET['keyword'])){
    $sql = "SELECT * FROM users WHERE username LIKE '%$_GET[keyword]%' OR email LIKE '%$_GET[keyword]%'";

  }elseif($op == 'delete' && isset($_GET['user_id'])){
    $GET_user_id=(int)$_GET['user_id'];
    $sql = "DELETE FROM users WHERE user_id='$GET_user_id'";
    $result = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM users ORDER BY user_id";

  }elseif($op == 'export-user' && isset($_GET['user_id'])){
    $GET_user_id=(int)$_GET['user_id'];
    $sql = "SELECT * FROM users WHERE user_id='$GET_user_id'";
    $result = mysqli_query($conn, $sql);
    $export_user = mysqli_fetch_assoc($result);
    $sql = "SELECT * FROM users ORDER BY user_id";

  }elseif($op == 'import-user' && isset($_GET['obj'])){
    $import = unserialize(base64_decode($_GET['obj']));
    $sql = "SELECT * FROM users ORDER BY user_id";

  }else{
    $sql = "SELECT * FROM users ORDER BY user_id";
  }

}else{
    $sql = "SELECT * FROM users ORDER BY user_id";

}

  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result);

?>
  <style>
    :root{
      --bg:#0f172a; /* navy */
      --card:#0b1320;
      --accent1:#7c3aed;
      --accent2:#06b6d4;
      --muted:rgba(255,255,255,0.65);
      --glass: rgba(255,255,255,0.04);
      --radius:16px;
      font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, 'Helvetica Neue', Arial;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;background:linear-gradient(180deg,var(--bg) 0%, #071026 100%);color:#fff}
    .container{max-width:1100px;margin:40px auto;padding:28px}

    header{
      display:flex;align-items:center;justify-content:space-between;gap:20px;background:linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));padding:18px;border-radius:20px;backdrop-filter: blur(6px);box-shadow:0 6px 30px rgba(2,6,23,0.6);
    }
    .brand{display:flex;align-items:center;gap:16px}
    .logo{width:68px;height:68px;border-radius:14px;background:linear-gradient(135deg,var(--accent1),var(--accent2));display:grid;place-items:center;font-weight:800;font-size:22px;color:#031024;box-shadow:0 6px 18px rgba(124,58,237,0.25)}
    h1{margin:0;font-size:20px}
    .lead{margin:0;font-size:13px;color:var(--muted)}

    nav{display:flex;gap:10px}
    .btn{display:inline-flex;align-items:center;gap:10px;padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:600}
    .btn.login{background:transparent;border:1px solid rgba(255,255,255,0.08);color:var(--muted)}
    .btn.primary{background:linear-gradient(90deg,var(--accent1),var(--accent2));color:#031024}

    /* Hero */
    .hero{display:grid;grid-template-columns:1fr 420px;gap:28px;margin-top:28px;align-items:center}
    .hero-card{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.015));padding:28px;border-radius:var(--radius);box-shadow:0 12px 40px rgba(2,6,23,0.6)}
    .hero h2{margin:0 0 8px;font-size:28px}
    .hero p{color:var(--muted);margin:0 0 18px}

    .cta-box{background:linear-gradient(90deg, rgba(124,58,237,0.12), rgba(6,182,212,0.08));padding:18px;border-radius:14px}
    .notice{background:var(--glass);padding:14px;border-radius:12px;color:var(--muted);display:flex;gap:12px;align-items:center}
    .notice strong{color:#fff}

    /* cards */
    .features{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:18px}
    .feature{background:linear-gradient(180deg, rgba(255,255,255,0.015), rgba(255,255,255,0.01));padding:14px;border-radius:12px}
    .feature h4{margin:0 0 6px}
    .feature p{margin:0;color:var(--muted);font-size:13px}

    footer{margin-top:28px;text-align:center;color:var(--muted);font-size:13px}

    /* responsive */
    @media (max-width:900px){
      .hero{grid-template-columns:1fr;}
      .features{grid-template-columns:repeat(2,1fr)}
      .container{padding:18px}
    }
    @media (max-width:560px){
      .features{grid-template-columns:1fr}
      .logo{width:56px;height:56px;font-size:18px}
    }

    /* subtle floating animation */
    .logo, .hero-card{transform-origin:center;animation:float 8s ease-in-out infinite}
    @keyframes float{0%{transform:translateY(0)}50%{transform:translateY(-6px)}100%{transform:translateY(0)}}

    .need-login{display:flex;flex-direction:column;gap:12px}


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

    .user-item a.delete {
      color: red;
      cursor: pointer;
      text-decoration: none;

    }

    .user-item:hover {
      background: #080622ff;
    }
    .user-list{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      padding:24px;
      max-height: 500px;
      overflow-y: auto;      
      border-radius:var(--radius);
      box-shadow:0 6px 30px rgba(2,6,23,0.6);
      border:1px solid rgba(255,255,255,0.03)
    }

  </style>

<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">Logo</div>
        <div>
          <h1>Welcome admin</h1>
          <p class="lead">We wish you a great time</p>
        </div>
      </div>
    </header>

    <section class="hero">
      <div class="hero-card">
        <h2>Admin panel</h2>
        <div>
            <h4><a class="btn primary" href="backup.php">Downlaod latest backup of MySQL</a></h4><br>
        </div>
        <div>
          <?php
          if(@$export_user) echo '<a class="btn primary" href=?operation=import-user&obj=' . base64_encode(serialize($export_user)) . '>Load user?</a>';
          if(@$import) {
            echo "<pre>";
            var_dump($import);
          }
          
          ?>
        </div>
      </div>
    
      <aside class="sidebar">

        <div class="user-list">
          <div class="card small">
            <h3>Search</h3>
            <p class="meta">in all users and posts...</p>
            <form action="" method="GET" style="margin-top:10px;display:flex;gap:8px">
              <input type="hidden" value="search" name="operation">
              <input name="keyword" placeholder="name, email, title, ..." style="flex:1;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:inherit"/>
              <button class="btn primary" type="submit">FInd</button>
            </form>
          </div>
       

          <h3>Users</h3>
          <?php foreach($users as $user){
            $user_id = md5($user[0]);
          ?>
          <div class="user-item">
            <img src="<?='/get_image.php?imgsrc=statics/images/' . $user_id . '.png'; ?>" onerror="this.src='/statics/images/user.png'" alt="avatar"></img>
            <span style="display:flex; justify-content:space-between; flex:1; align-items:center;">
              <a href="<?='/accounting.php?username=' . $user[1] ?>"><?php echo $user[1]; ?></a>
              <a class="delete" href="<?='?operation=delete&user_id=' . $user[0]; ?>">Delete</a>
            </span>
              <a class="delete" href="<?='?operation=export-user&user_id=' . $user[0]; ?>">Export</a>
          </div>
          <?php } ?>
        </div>

      </aside>
    </section>


<?php
include '../footer.php';
?>
</body>
</html>
