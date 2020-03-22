<?php
error_reporting(error_reporting() & ~E_NOTICE);
session_start();

require("conf.php");
$p_id = $_REQUEST['p_id'];
$act = $_REQUEST['act'];
if ($act == 'add' && !empty($p_id)) {
  if (!isset($_SESSION['shopping_cart'])) {

    $_SESSION['shopping_cart'] = array();
  } else {
  }
  if (isset($_SESSION['shopping_cart'][$p_id])) {
    $_SESSION['shopping_cart'][$p_id]++;
  } else {
    $_SESSION['shopping_cart'][$p_id] = 1;
  }
}

if ($act == 'remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
{
  unset($_SESSION['shopping_cart'][$p_id]);
}

if ($act == 'update') {
  $amount_array = $_POST['amount'];
  foreach ($amount_array as $p_id => $amount) {
    $_SESSION['shopping_cart'][$p_id] = $amount;
  }
}

if($act=='Cancel-Cart'){
  unset($_SESSION['shopping_cart']);	
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
  <script type="text/javascript" src="./js/jquery.cycle.lite.min.js"></script>
  <script type="text/javascript" src="./js/jquery.pngFix.pack.js"></script>
  <script type="text/javascript" src="./js/jquery.color.js"></script>
  <script type="text/javascript" src="./js/hoverIntent.js"></script>
  <script type="text/javascript" src="./js/superfish.js"></script>
  <script type="text/javascript" src="./js/slimbox2.js"></script>
  <script type="text/javascript" src="./js/slides.min.js"></script>
  <script type="text/javascript" src="./js/custom.js"></script>
  <script type="text/javascript" src="./js/jquery-ui-1.8.16.custom.min.js"></script>
  <script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body onload="MM_preloadImages('images/buttons/login_hover.png')">

  <!-- START HEADER -->
  <div style="font-family: 'Prompt', sans-serif;"   id="header">

    <div class="container">

      <div id="primary-nav" class="header-right">

        <ul class="sf-menu">
          <li class="current"><a href="./index.php">หน้าแรก</a></li>
          <li><a href="./ended.php">สินค้าที่ชนะการประมูล</a></li>

          <?php
          if (isset($_SESSION['username']))
            echo '<li id="member"><a href="./member.php">ข้อมูลส่วนตัว</a></li>';
          echo '<li><a href="./about.php">รอการอนุมัติการจ่ายเงิน</a></li>';
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
      <div style="border:0px ;font-family: 'Prompt', sans-serif;" id="login-reg">
        <?php
        if (isset($_SESSION['username'])) {
          $username = $_SESSION['username'];
          $sql = "SELECT user_Name, user_Credit FROM users WHERE user_Name = '$username'";
          $result = mysqli_query($connect, $sql);
          $row = mysqli_fetch_array($result);
          echo "<h6 style='color:FFFFFF'>ยินดีต้อนรับ คุณ <b>" . $row[0] . "</b></h6>";

        ?>
          <a id="logout" href="./logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('logout_button','','logout_hover.png',1)"><img src="logout.png" name="logout_button" width="100" height="34" border="0" id="logout_button" /></a>
        <?php
        } else {
        ?>
          <a id="login" href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('login_button','','login_hover.png',1)"><img src="login.png" name="login_button" width="100" height="34" border="0" id="login_button" /></a>
          <a id="register" href="./register.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('signup_button','','signup_hover.png',1)"><img src="signup.png" name="signup_button" width="100" height="34" border="0" id="signup_button" /></a>
        <?php
        }
        ?>

      </div>
    </div>
  </div><!-- END HEADER DIVIDER -->


  <!-- START MAIN CONTAINER -->
  <div  class="centerBox">
    <div class="container">
      <div id="dialog-login" style="display:none" title="กรุณาเข้าสู่ระบบ">
        <form style="font-family: 'Prompt', sans-serif;" id="login-form" action="login.php" method="POST">
          <fieldset>
            <label style="font-family: 'Prompt', sans-serif;" for="username">ชื่อผู้ใช้</label><br />
            <input style="font-family: 'Prompt', sans-serif;" type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" /><br />
            <label style="font-family: 'Prompt', sans-serif;" for="password">รหัสผ่าน</label><br />
            <input style="font-family: 'Prompt', sans-serif;" type="password" name="password" id="password" class="text ui-widget-content ui-corner-all" />
          </fieldset>
        </form>
      </div>
      <!-- START Auction Item CONTAINER -->
      <h1 style="font-family: 'Prompt', sans-serif;color:#007B6E">ตะกร้าสินค้า</h1>
      <div style="background-color:#DCF7F3" id="itemContain" class="itemContain">
          <div style="font-family: 'Prompt', sans-serif;" class="col-md-12">
            <form id="frmcart" name="frmcart" method="post" action="?act=update">
              <table width="100%" border="0" align="center" class="table table-hover">
              
                <tr>
                  <td align="center" bgcolor="#EAEAEA"><strong>No.</strong></td>
                  <td align="center" bgcolor="#EAEAEA"><strong>Item_Id</strong></td>
                  <td align="center" bgcolor="#EAEAEA"><center><strong>image</strong></center></td>
                  <td align="center" bgcolor="#EAEAEA"><strong>สินค้า</strong></td>
                  <td align="center" bgcolor="#EAEAEA"><strong>ราคา</strong></td>
                  <td align="center" bgcolor="#EAEAEA"><strong>จำนวน</strong></td>
                  <td align="center" bgcolor="#EAEAEA"><strong>รวม/รายการ</strong></td>
                  <td align="center" bgcolor="#EAEAEA"><strong>ลบ</strong></td>
                </tr>

                <?php

                if (!empty($_SESSION['shopping_cart'])) {
                  require_once('conf.php');
                  foreach ($_SESSION['shopping_cart'] as $p_id => $p_qty) {

                    $sql = "SELECT * FROM items WHERE item_ID=$p_id and order_out = 1" ;
                    $query = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                      $sum = $row['item_Actual_Price'];
                      $total += $sum;
                      echo "<tr>";
                      echo "<td width='10%'>";
                      echo  $i += 1;
                      echo ".";
                      echo "</td>";
                      echo "<td width='10%'>" . " " . $p_id . "</td>";

                      echo "<td width='10%'>" . "<center><img src='uploads/$row[item_Path]'  width='50'/></center>" . "</td>";
                      echo "<td width='10%'>" . " " . $row["item_Name"] . "</td>";
                      echo "<td width='10%' align='right'>" . number_format($row["item_Actual_Price"], 2) . "</td>";
                      echo "<td width='10%' align='right'>";
                      echo "<input type='text' name='amount[$p_id]' value='1' size='1'/ disabled></td>";

                      echo "<td width='10%' align='right'>" . number_format($sum, 2) . "</td>";
                      echo "<td width='10%' align='center'><a href='cart.php?p_id=$p_id&act=remove' class='btn btn-danger btn-xs'>ลบ</a></td>";

                      echo "</tr>";
                    }
                  }

                  echo "<tr>";
                  echo "<td colspan='6' bgcolor='#CEE7FF' align='right'>Total</td>";
                  echo "<td align='right' bgcolor='#CEE7FF'>";
                  echo "<b style='color:red'>";
                  echo  number_format($total, 2);
                  echo "</b>";
                  echo "</td>";
                  echo '<td><a href="ended.php"><img src="plus.png" width="20px" height="20px"> เพิ่มสินค้า</a></td>';
                  echo "</tr>";
                }

                ?>
              <tr>
           <td  align='right' colspan='7'><b></b></td>
          <td  align='right'><b  style='color:red'><small>*สามารถเพิ่มได้ 1 ชิ้น / 1 สินค้า*</small></td>
         </tr>
                <tr>
                  <td colspan="10" align="center">
                  <br>
                   <center><button style="width:80%" type="button" name="Submit2" onclick="window.location='payment.php';" class="btn btn-primary">
                      <span class="glyphicon glyphicon-shopping-cart"> </span> สั่งซื้อ </button> <a href="cart.php?act=Cancel-Cart" class="btn btn-danger"> ยกเลิกตะกร้าสินค้า </a></center>
                  </td>
                </tr>
               
            </form>
            
          </div>
       
      </div>
      <!-- END Auction Item CONTAINER -->
    </div><!-- END MAIN CONTAINER -->
    <br class="clear" />
    <br class="clear" />
    <br class="clear" />
  </div>

  <!-- START FOOTER -->
  
</body>
</html>
<style>
  h1 {
    text-shadow: 2px 2px 0px #FFFFFF,
     5px 4px 0px rgba(0, 0, 0, 0.15), 
    -1px 8px 0px rgba(206, 177, 165, 0.17);
    color: #333333;
    background: #FFFFFF;
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
