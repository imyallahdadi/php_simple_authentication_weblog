
<?php
include 'header.php';
?>

<div class="container" style="max-width:400px; margin:50px auto;">

<h1>Registration</h1>
<br></br>


<body>

<?php

include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $email = $_POST['email'] ?? '';
   
    try{

        $sql = "INSERT INTO users (`username`, `email`, `first_name`, `last_name`, `bio`, `password`) VALUES ('$username','$email','$first_name','$last_name','$bio','$password');";
        $result = mysqli_query($conn, $sql);

        if($result === true){
        
            header("Location: ./login.php?msg=$username registered successfully");
        }


    }catch (mysqli_sql_exception $e){
        $message = $e->getMessage();
    }
    
}
?>

    <form action="register.php" method="post">
      <label for="username">Username *</label><br />
      <input type="text" id="username" name="username" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />
      
      <label for="password">Password *</label><br />
      <input type="password" id="password" name="password" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />
      
      <label for="first_name">First name</label><br />
      <input type="text" id="first_name" name="first_name" style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />

      <label for="last_name">Last name</label><br />
      <input type="text" id="last_name" name="last_name" style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />

      <label for="bio">Bio</label><br />
      <input type="text" id="bio" name="bio" style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />

      <label for="email">Email *</label><br />
      <input type="text" id="email" name="email" required style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:1px solid #ccc;" />



      <button type="submit" class="btn primary" style="width:100%;">Submit</button>
      <br></br>
      <a class = "btn" style = "width:100%" href = "/login.php">already have an account?</a> 
    </form>



<?php
if(isset($message)){
  echo "<p>$message</p>";
}
?>



</body>


<?php
include 'footer.php'
?>