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

if(isset($_SESSION['is_logged']) === true ) {

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
        <a class="btn primary" href="#">Panel</a>
        <a class="btn" href="#">Write</a>
        <a class="btn" href="#">Posts</a>
        <a class="btn" href="settings.php">Setings</a>
        <a class="btn" href="/logout.php" >Log out (<?php echo $_SESSION['username']?>)</a>

      </nav>
    </header>

    <section class="hero">
      <div class="card">
        <h2>Made for speed, readability and style</h2>
        <p>Ship a clean landing page fast. This template includes a hero, feature cards, recent posts list and a simple sidebar — all responsive and easy to customize.</p>

        <div class="features">
          <div class="feature">
            <h4>Lightweight</h4>
            <p>Small CSS footprint so pages load quickly across devices.</p>
          </div>
          <div class="feature">
            <h4>Responsive</h4>
            <p>Layouts adapt from desktop to mobile without extra work.</p>
          </div>
          <div class="feature">
            <h4>Accessible</h4>
            <p>High contrast and clear focus states for better usability.</p>
          </div>
        </div>

        <div class="posts" id="posts">
          <div class="post">
            <div>
              <strong>How I built a tiny static blog</strong>
              <div class="meta">June 23 — 5 min read</div>
            </div>
            <div><a href="#">Read</a></div>
          </div>

          <div class="post">
            <div>
              <strong>Designing a minimal interface</strong>
              <div class="meta">May 12 — 3 min read</div>
            </div>
            <div><a href="#">Read</a></div>
          </div>
        </div>
      </div>

      <aside class="sidebar">
        <div class="card small">
          <h3>About</h3>
          <p class="meta">Hi — I'm a developer who likes clean UI. Use this template as a starting point for your personal site or project.</p>
        </div>

        <div style="height:14px"></div>

        <div class="card small">
          <h3>Newsletter</h3>
          <p class="meta">Get updates once a month.</p>
          <form onsubmit="alert('Subscribed!');return false;" style="margin-top:10px;display:flex;gap:8px">
            <input aria-label="email" placeholder="you@example.com" style="flex:1;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:inherit"/>
            <button class="btn primary" type="submit">Subscribe</button>
          </form>
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
