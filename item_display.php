<?php
require('./conf.php');
$sql_update = "UPDATE items SET item_Status = 1 WHERE (UNIX_TIMESTAMP(item_Close_Date) - UNIX_TIMESTAMP()) <0";

$result = mysqli_query($connect, $sql_update);

$sql = "SELECT * FROM items WHERE item_Status = 0 ORDER BY UNIX_TIMESTAMP(item_Close_Date)";

$result = mysqli_query($connect, $sql);



while ($row = mysqli_fetch_array($result)) {
	$id[] = $row['item_ID'];
	$name[] = $row['item_Name'];
	$price[] = $row['item_Actual_Price'];
	$highest_bidder[] = $row['user_Name'];
	$date[] = $row['item_Close_Date'];
	$path[] = str_replace('..','.',$row['item_Path']);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	
	<!-- font  -->
	<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">


    <!-- Include CSS -->
    <link href="./css/jquery.countdown.css" rel="stylesheet" type="text/css" />

    <!-- Include Scripts -->

    <script type="text/javascript" src="./js/jquery.countdown.js"></script>
<script type="text/javascript">
function highlight(periods) {
		if ($.countdown.periodsToSeconds(periods) <= 30) {
        	$(this).addClass('highlight');
    	}
		else {
			$(this).removeClass('highlight');
		}
	}
$(document).ready(function(){
	<?php
		for($i=0;$i<count($id);$i++) {
			echo '$("#item_time_'.$id[$i].'").countdown({
				until: new Date("'.$date[$i].'"),
				format: "dHMS",
				onTick: highlight,
				onExpiry: function() {
					$.ajax({
						type: "POST",
						url: "ajax_bid_winner_process.php",
						data: {
							itemid:'.$id[$i].'
						},
						dataType: "json",
						success: function(data) {
							$("#bid").attr("id","ended");
							$("#ended").attr("src","./images/buttons/ended.png");
							$("#time_box").countdown("destroy");
						}
					});
				}
			});';
		}
	?>


    });

</script>
</head>
<body>
<?php
if (isset($id)) {
for($i=0;$i<count($id);$i++) {
	echo '<div style="background-color:#FF8383;width:200px" id="item'.$id[$i].'" class="itemBox">';
	echo '<p class="item_head"><strong style="color:#FFFFFF">'.$name[$i].'</strong></p>';
    echo '<a calss="zoom" href="bid.php?id='.$id[$i].'"><img src="'.$path[$i].'" width="195px" height="167px" alt="" /></a>';
    echo '<p style="color:red" class="item_price">'.$price[$i].' บาท</p>';
	echo '<p style="color:#65F143" class="item_highest_bidder">'.$highest_bidder[$i].'</p>';
    echo '<div style="color:#FFFFFF" id="item_time_'.$id[$i].'" class="item_time">'.$date[$i].'</div>';
    echo '<a href="bid.php?id='.$id[$i].'"><img class"item_image" src="open.png" alt="Bid Now" width="138" height="47" /></a>';
    echo '</div>';
}
}
?>
</body>
</html>
<?php

mysqli_close($connect);
?>
<style>
body{

font-family: 'Prompt', sans-serif;
}
.itemBox {
  transition: box-shadow .1s;
 
  
}
.itemBox:hover {
  box-shadow: 0 0 50px rgba(33,33,33,.2); 
}
.item_image{
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}

</style>
