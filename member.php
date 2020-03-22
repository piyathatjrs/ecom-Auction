<?php
session_start();
require('conf.php');
if (is_null($_SESSION['username']))
	header("Location: index.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
    <title>ข้อมูลส่วนตัว</title>
    <!-- font  -->
 <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">




    <!-- Include CSS -->
    <link href="./css/reset.css" rel="stylesheet" type="text/css" />
    <link href="./css/style.css" rel="stylesheet" type="text/css" />
    <link href="./css/slimbox2.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Oswald|Droid+Sans:400,700' rel='stylesheet' type='text/css' />
    <link href="./css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />

    <!-- Include Scripts -->
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.cycle.lite.min.js"></script>
    <script type="text/javascript" src="js/jquery.pngFix.pack.js"></script>
    <script type="text/javascript" src="js/jquery.color.js"></script>
    <script type="text/javascript" src="js/hoverIntent.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/slimbox2.js"></script>
    <script type="text/javascript" src="js/slides.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
 	<script type="text/javascript" src="./js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $("#member-tabs").tabs();
        });
    </script>
</head>
<body>

<!-- START HEADER -->
<div style=" font-family: 'Prompt', sans-serif;" id="header">

	<div class="container">

    	<div id="primary-nav" class="header-right">

            <ul class="sf-menu">
                <li class="current"><a href="./index.php">หน้าแรก</a></li> 
                <li><a href="./ended.php">สินค้าที่ชนะการประมูล</a></li>
              
                <?php
				if($_SESSION['username'] != "")
                    echo '<li id="member"><a href="./member.php">ข้อมูลส่วนตัว</a></li>';
                    echo '<li><a href="./about.php">สินค้าอนุมัติการจ่ายเงิน</a></li>';
                    echo '<li><a href="cart.php">ตะกร้าสินค้า</a></li>';  

				?>

             </ul>
        </div>

        <!-- LOGO -->
    	<a href="./index.php"><img src="logo.png" border="0" alt="Simple Auction" /></a>

        <br class="clear" />

    </div>

</div><!-- END HEADER -->


<!-- HEADER DIVIDER -->
<div style="background: url(BG.png) top center repeat-x" id="head-break">
<div class="outer">
<div class="announcement">
<h1 >สำหรับสมาชิก</h1>
<h1>แก้ไขข้อมูลส่วนตัว</h1>
</div>
</div>
</div><!-- END HEADER DIVIDER -->


<!-- START MAIN CONTAINER -->
<div class="centerBox">
<div class="container" align="">
	<div id="dialog-login" style="display:none" title="Login Box">
    	<form id="login-form" action="login.php" method="POST">
        <fieldset>
        	<label for="username">Username</label><br />
            <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" /><br />
            <label for="password">Password</label><br />
            <input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all" />
        </fieldset>
        </form>
    </div>
      <div id="join-date">
        	<h5 style="color:#007B6E">เป็นสมาชิกตั้งแต่ : <?php
				$username = $_SESSION['username'];
				$sql = "SELECT * FROM users WHERE user_Name = '$username'";
				$result = mysqli_query($connect, $sql);
				$row = mysqli_fetch_array($result);
				echo date("D d-M-Y",$row['user_Date']);
				mysqli_close($connect);
			?></h5>
     	</div>
    <h1 style="color:#007B6E">ยินดีต้อนรับ <b style="color:orange"><?php echo $_SESSION['username']; ?></b> </h1>

    	<div id="member-tabs">
        	<ul>

            	<li><a href="./member_user.php">ข้อมูลผู้ใช้</a></li>
            	<li><a href="./member_address.php">แก้ไขที่อยู่</a></li>
                <li><a href="./member_password.php">เปลี่ยนรหัสผ่าน</a></li>
          		<li><a href="./member_auction_history.php">ประวัติการประมูล</a></li>
            </ul>
        </div>
       <br class="clear" />
       <br class="clear" />

</div><!-- END MAIN CONTAINER -->

</div>

<!-- START FOOTER -->
<div style="background: url(BG.png) top center repeat-x" id="footer">

	<div class="container">

    	
        
      <div style="color:black" id="footer-left">
      <h6>แจ้งปัญหา</h6>
        ติดต่อ 
      
          <img src="F.png" width="20px" height="20px"> : <b>coolsnap@gmail.com</b><br>
        <span style="text-align:center" ><img src="line-icon.png" width="20px" height="20px"> : <b>@coolsnap777</b></span>
        <br> <img src="p.png" width="20px" height="20px"> : <b>12-1231212-1</b><br>
      
      
      </div>

        </div>

        <br class="clear" />

  </div>

</div><!-- END FOOTER -->
</body>
</html>

<style>
body , h5 ,li{
  font-family: 'Prompt', sans-serif;
}
  h1 {
    text-shadow: 2px 2px 0px #FFFFFF,
     5px 4px 0px rgba(0, 0, 0, 0.15), 
    -1px 8px 0px rgba(206, 177, 165, 0.17);
    color: #333333;
    
  }
</style>

