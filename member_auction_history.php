<link href="./css/ajax.css" rel="stylesheet" type="text/css" />
<!-- font  -->
<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

<?php
session_start();
require("./conf.php");

$userid = $_SESSION['userid'];

$sql = "SELECT  * FROM bid     WHERE  user_ID = '$userid' ORDER BY UNIX_TIMESTAMP(bid_Date) DESC ";

$result = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_array($result)) {
	$username[] = $row['user_Name'];
	$itemname[] = $row['item_Name'];
	$date[] = $row['bid_Date'];
	$price[] = $row['bid_Price'];

}
?>
<div id="auction_history">
<h1 style="color:#090D3E"> ประวัติการประมูล </h1>
<table>
<tr>
<th>วันที่ประมูล</th>
<th>ชื่อสินค้า</th>
<th>ราคา</th>

</tr>
<?php
if (isset($username)) {
for($i=0; $i<count($username); $i++) {
	echo "<tr>";
	echo "<td>$date[$i]</td>";
	echo "<td>$itemname[$i]</td>";
	echo "<td>$price[$i] บาท</td>";
	// echo "<td>$order_status[$i] </td>";
	echo "</tr>";
}
}
mysqli_close($connect);
?>
</table>
</div>
<style>
  body,th,td,h1 {

    font-family: 'Prompt', sans-serif;
  }

  h1 {
    text-shadow: 2px 2px 0px #FFFFFF,
     5px 4px 0px rgba(0, 0, 0, 0.15), 
    -1px 8px 0px rgba(206, 177, 165, 0.17);
    color: #333333;
   
  }
  .itemContain{

    -webkit-box-shadow: -10px 0px 13px -7px #000000, 
    10px 0px 13px -7px #000000, 
    31px 7px 50px 29px rgba(0,0,0,0); 
  box-shadow: -10px 0px 13px -7px #000000, 
  10px 0px 13px -7px #000000, 
  31px 7px 50px 29px rgba(0,0,0,0);
  }

  
</style>
