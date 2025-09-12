<?php
session_start();
include 'header.php';
include 'db.php';
?>


<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">SS</div>
        <div>
          <h1>Welcome</h1>
          <p class="lead">wish you have a good time</p>
        </div>
      </div>
      <nav>
        <a class="btn" href="login.php">Login</a>
        <a class="btn" href="register.php">Sign-up</a>
      </nav>
    </header>
  </div>
    
  



<?php
include 'footer.php';
?>
