<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Simple & Smooth</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container" style="max-width:400px; margin:50px auto;">
    <h2>Login</h2>
    <form action="login.php" method="post">
      <label for="username">Username</label><br />
      <input type="text" id="username" name="username" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />
      
      <label for="password">Password</label><br />
      <input type="password" id="password" name="password" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />
      
      <button type="submit" class="btn primary" style="width:100%;">Login</button>
    </form>
  </div>
</body>
</html>
