<?php
session_start();
require('./conf.php');

$sql_update = "UPDATE items SET item_Status = 1 WHERE (UNIX_TIMESTAMP(item_Close_Date) - UNIX_TIMESTAMP()) < 0";
$result = mysqli_query($connect, $sql_update);


$username = $_SESSION['username'];
if($username==''){
	header('Location: http://www.google.com');
}
// $sql = "SELECT user_Name, user_Credit FROM users WHERE user_Name = '$username'";
// $result = mysqli_query($connect, $sql);
// $row = mysqli_fetch_array($result);

$sql = "SELECT * FROM items I WHERE  item_Status = 1 AND user_Name = '$username' AND order_out=1  
ORDER BY UNIX_TIMESTAMP(item_Close_Date)";
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($result)) {
	$p_id[] = $row['item_ID'];
	$name[] = $row['item_Name'];
	$price[] = $row['item_Actual_Price'];
	$highest_bidder[] = $row['user_Name'];
	$date[] = $row['item_Close_Date'];
	$path[] = str_replace('..', '.', $row['item_Path']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="UTF-8" />
</head>

<body>
	<?php

	if (isset($p_id)) {
		for ($i = 0; $i < count($p_id); $i++) {
			echo '<div style="background-color:white" id="item' . $p_id[$i] . '" class="itemBox">';
			echo '<p class="item_head"><strong>' . $name[$i] . '</strong></p>';
			echo '<a href="bid.php?id=' . $p_id[$i] . '"><img src="' . $path[$i] . '" width="195" height="167" alt="" /></a>';
			echo '<p class="item_price">' . $price[$i] . ' บาท</p> ';
			echo '<p class="item_highest_bidder">' . $highest_bidder[$i] . '</p>';
			//echo '<a href="bid.php?id='.$p_id[$i].'"><img class"item_image" src="./images/buttons/ended.png" alt="Bid Now" width="138" height="47" /></a>';
			echo '<a href="cart.php?p_id=' . $p_id[$i] . '&act=add"><img class"item_image" src="./images/buttons/carts.png" alt="Bid Now" width="128" height="47" /></a>';
			echo '<br></div>';
			
		}
	}
	?>
</body>

</html>
<?php

mysqli_close($connect);
?>