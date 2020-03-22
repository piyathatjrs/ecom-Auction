<?php
error_reporting(error_reporting() & ~E_NOTICE);
session_start();

require_once('conf.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ชำระเงิน</title>
  <!-- font  -->
  <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://cdn.omise.co/card.js"></script>
  <!-- Include CSS -->
  <link href="./css/reset.css" rel="stylesheet" type="text/css" />
  <link href="./css/style.css" rel="stylesheet" type="text/css" />
  <link href="./css/slimbox2.css" rel="stylesheet" type="text/css" />
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link href="../css/slimbox2.css" rel="stylesheet" type="text/css" />
  <link href="../css/reset.css" rel="stylesheet" type="text/css" />

  <link href="../css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
  <link href='http://fonts.googleapis.com/css?family=Oswald|Droid+Sans:400,700' rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!-- Include Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/jquery.cycle.lite.min.js"></script>
  <script type="text/javascript" src="../js/jquery.pngFix.pack.js"></script>
  <script type="text/javascript" src="../js/jquery.color.js"></script>
  <script type="text/javascript" src="../js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="../js/hoverIntent.js"></script>
  <script type="text/javascript" src="../js/superfish.js"></script>
  <script type="text/javascript" src="../js/slimbox2.js"></script>
  <script type="text/javascript" src="../js/slides.min.js"></script>
  <script type="text/javascript" src="../js/custom.js"></script>
  <script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
  <script type="text/javascript" src="../js/jquery-ui-timepicker-addon.js"></script>
  <script type="text/javascript" src="../js/tiny_mce/jquery.tinymce.js"></script>

  <script>
    $(document).ready(function() {
      $(".btn2").click(function() {
        $("#S").show();

        sessionStorage.removeItem('shopping_cart');
      });
    });

    function accept() {}
  </script>
</head>

<body>

  <!-- START HEADER -->
  <div id="header">

    <div style="font-family: 'Prompt', sans-serif;" class="container">

      <div id="primary-nav" class="header-right">

        <ul class="sf-menu">
          <li class="current"><a href="./index.php">หน้าแรก</a></li>
          <li><a href="./ended.php">สินค้าที่ชนะการประมูล </a></li>

          <?php
          if (isset($_SESSION['username']))
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
      <div style="border:0px" id="login-reg">
        <?php
        if (isset($_SESSION['username'])) {
          $username = $_SESSION['username'];
          $sql = "SELECT user_Name, user_Credit FROM users WHERE user_Name = '$username'";
          $result = mysqli_query($connect, $sql);
          $row = mysqli_fetch_array($result);
          echo "<h6 style='color:#FFFFFF'>ยินดีต้อนรับ คุณ <b>" . $row[0] . "</b></h6>";

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
  <div class="centerBox">
    <div class="container">
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
      <!-- START Auction Item CONTAINER -->
      <h1 style="color:#007B6E" id="h">ช่องทางการชำระเงิน <h1> <span style="margin-left:32%">

            <div style="background-color:#EBEBEB;padding-top:50px" id="" class="itemContain">

            
              

                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">

                    <p><a href="cart.php" class="btn btn-info">กลับไปตะกร้าสินค้า</a>&nbsp;<button class="btn btn-info" onClick="window.print()">พิมพ์ใบสเสร็จ</button> </p>

                    <table width="700" border="1" align="center" class="table">
                      <tr>
                        <td style="background-color:#89F79F ;color:red" width="1560" colspan="6" align="center">
                          <B style="font-size:20px">สั่งซื้อสินค้า</B></td>
                      </tr>
                      <tr class="success">
                        <th align="center">ลำดับ</th>
                        <th align="center">รหัสสินค้า</th>
                        <th align="center">สินค้า</th>
                        <th align="center">ราคา</th>
                        <th align="center">จำนวน</th>
                        <th align="center">รวม/รายการ</th>
                      </tr>


                      <?php


                      $total = 0;

                      foreach ($_SESSION['shopping_cart']  as $p_id => $p_qty) {
                        $sql = "SELECT * FROM items WHERE item_ID=$p_id and order_out=1 ";
                        $query = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                        $sum = $row['item_Actual_Price'] * 1;
                        $total += $sum;
                        if ($total != 0) {
                          echo "<tr>";
                          echo "<td align='center'>";
                          echo $i += 1;
                          echo "</td>";
                          echo "<td  width='10%'>" . " " . $p_id . "</td>";
                          echo "<td>" . $row["item_Name"] . "</td>";
                          echo "<td  align='right'>" . number_format($row["item_Actual_Price"], 2) . "</td>";
                          echo "<td  align='right'>1</td>";
                          echo "<td  align='right'>" . number_format($sum, 2) . "</td>";
                          echo "</tr>";
                        }
                        // unset($_SESSION['shopping_cart'][$p_id]);
                      }
                      echo "<tr>";
                      echo "<td  align='right' colspan='5'><b>รวม</b></td>";
                      echo "<td  align='right'>" . "<b  style='color:red'>" . number_format($total, 2) . "<b>" . "</td>";
                      echo "</tr>";
                      ?>
                    </table>
                  </div>
                </div>


              <p style="padding-left:60%"><a class="btn btn-primary btn2" style="background-color:#73F781;color:tomato"><b>ชำระเงิน / เลือกช่องทาง (การชำระเงิน)</b></a>
              

              <div id="S" class="container" hidden><div class="row"><br></div>
                  <div class="row">

                    <div class="col-md-4" >
                  <br>
                     <img class='im' src="pay.png" height="300px">
                    </div>
                    <div class="col-md-1">
                    </div>

                    <div class="col-md-5" style="background-color:#f4f4f4">

                      <h3 align="center" style="color:green">
                        <span class="glyphicon glyphicon-shopping-cart"></span>

                        <!-- form -->
                        confirm cart</h3>
                      <form style="padding:10px" action="upload.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <tr>
                          <td align="right" valign="middle"><b>ช่องทางการชำระเงิน</b></td>
                          <td colspan="2"><label for="pro_qty"></label>
                            :
                            <label name="p_unit" id="p_unit" value="ชำระเงินผ่านธนาคาร" required>
                            ชำระเงินผ่านธนาคาร
                    </label></td>
                        </tr>

                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="text" name="name" class="form-control" require placeholder="ชื่อ-นามสกุล" />
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="text" name="address" class="form-control" row="3" require placeholder="ที่อยู่ในการจัดส่งสินค้า" />
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="text" name="phone" class="form-control" require placeholder="เบอร์โทรศัพท์" />
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12">
                            <input type="text" name="email" class="form-control" require placeholder="อีเมล" />
                          </div>
                        </div>

                    <span>เลือกไฟล์ภาพที่จะอัปโหลด:</span>

                        <input type="file" name="file">
                        <br>
                        <small><span style="color:red">หมายเหตุ :</span> กรุณาชำระเงินให้พอดีกับราคาสินค้าหากท่านโอนเงินเกินราคาสินค้า<br><i style="color:red">**จะไม่มีการโอนคืน**</i> </small>
                            <br>
                            <center> <input type="submit" name="submit" value="Upload"></center>
                      </form>

                    </div>

                  </div><br><br><br><br><br>
                </div>
            </div>
            

            <!-- END Auction Item CONTAINER -->



    </div><!-- END MAIN CONTAINER -->
    <br class="clear" />
    <br class="clear" />
    <br class="clear" />
  </div>

  <!-- START FOOTER -->
  <div style="background: url(BG.png) top center repeat-x" id="footer">

    <div class="container">

      <div id="footer-right">


      </div>

      <br class="clear" />

    </div>

  </div><!-- END FOOTER -->
</body>

</html>
<style>
  body {
    font-family: 'Prompt', sans-serif;
  }

  #h {
    text-shadow: 2px 2px 0px #FFFFFF,
      5px 4px 0px rgba(0, 0, 0, 0.15),
      -1px 8px 0px rgba(206, 177, 165, 0.17);
    color: #333333;
    background: #FFFFFF;
  }

  .stock {

    padding: 5px;
    border-radius: 100%;
    color: #DCF7F3;

  }

  td {
    background-color: rgba(255, 255, 128, .5);
    color: green;
    text-align: center;
    font-size: 20px;
  }

  th,
  tr {
    text-align: center;
    color: #050E93;
    font-size: 15px;
  }
  .col-md-5{
    font-family: 'Prompt', sans-serif;
font-size:15px;
    
  }
  .im{

    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
</style>