<?php
session_start();
include 'header.php';
include 'db.php';
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
  </style>

<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">Logo</div>
        <div>
          <h1>Welcome</h1>
          <p class="lead">We wish you a great time</p>
        </div>
      </div>
      <nav>
        <a class="btn login" href="login.php">Login</a>
        <a class="btn primary" href="register.php">Sign Up</a>
      </nav>
    </header>

    <div class="hero">
      <div class="hero-card">
        <h2>Content Sharing Platform</h2>
        <p>Here you can read posts, leave comments, and interact with others. To get full access and participate in discussions, you need to log in.</p>

        <div class="features">
          <div class="feature">
            <h4>Read Posts</h4>
            <p>You need to log in to see the full list of posts.</p>
          </div>
          <div class="feature">
            <h4>Write post</h4>
            <p>Write usefull posts to help other people.</p>
          </div>
          <div class="feature">
            <h4>User Profile</h4>
            <p>Your saved posts are kept in your personal profile.</p>
          </div>
        </div>

        <div style="margin-top:18px;display:flex;gap:10px">
          <a class="btn primary" href="login.php">Log in to view posts</a>
          <a class="btn login" href="register.php">Sign Up Now</a>
        </div>
      </div>

      <aside class="cta-box">
        <div class="notice">
          <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent1),var(--accent2));display:grid;place-items:center;font-weight:700;color:#031024">!</div>
          <div class="need-login">
            <div><strong>Limited Access</strong></div>
            <div style="color:var(--muted);font-size:14px">To view content and post comments you need to log in. This helps protect the user experience and prevent spam.</div>
          </div>
        </div>

        <div style="margin-top:14px;text-align:center">
          <a class="btn primary" href="login.php">Login / Continue</a>
        </div>

        <div style="margin-top:14px;color:var(--muted);font-size:13px;text-align:center">
          Not sure yet? You can preview a limited part of the site without logging in, but all features are only available to logged-in users.
        </div>
      </aside>
    </div>


<?php
include 'footer.php';
?>
</body>
</html>
