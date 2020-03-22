<?php
session_start();
require("./conf.php");

$itemid = $_POST['itemid'];
$user = $_POST['user'];
$sql = "UPDATE items SET item_Status = 1 , status_payment = 1 WHERE item_ID = '$itemid'";
mysqli_query($connect, $sql);



mysqli_close($connect);
?>  
