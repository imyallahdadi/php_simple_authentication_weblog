<?php

$imgePath = $_GET['imgsrc'];
$imageData = file_get_contents($imgePath);
echo $imageData;

?>