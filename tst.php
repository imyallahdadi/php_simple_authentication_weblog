
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<?php
include 'db.php';


?>
<style>
.user-list {
  width: 250px;          /* اندازه فیلد اصلی */
  max-height: 200px;     /* حداکثر ارتفاع */
  overflow-y: auto;      /* اسکرول عمودی */
  border: 1px solid #ccc;
  border-radius: 12px;
  padding: 10px;
  background: #fafafa;
}

.user-item {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #f0f0f0;
  border-radius: 9999px;   /* بیضی/کپسولی */
  padding: 5px 12px;
  margin-bottom: 8px;
  cursor: pointer;
  transition: background 0.3s;
}

.user-item:hover {
  background: #e0e0e0;
}

.user-item img {
  width: 30px;
  height: 30px;
  border-radius: 50%;   /* گرد کردن عکس */
  object-fit: cover;
}


</style>
<body>


  <div class="user-list">
    <h3>Users</h3>
    <?php foreach($users as $user){
      $user_id = md5($user[0]);
    ?>
    <div class="user-item">
      <img src="<?='/get_image.php?imgsrc=statics/images/' . $user_id . '.png'; ?>" onerror="this.src='/statics/images/user.png'" width="200" height="200"></img>
      <span><?php echo $user[1]; ?></span>
    </div>
    <?php } ?>
  </div>
  
</body>
</html>
