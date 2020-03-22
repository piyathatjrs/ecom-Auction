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
  <title>Confirm</title>
  <!-- font  -->
  <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://cdn.omise.co/card.js"></script>
  <!-- Include CSS -->
  <link href="../css/reset.css" rel="stylesheet" type="text/css" />
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link href="../css/slimbox2.css" rel="stylesheet" type="text/css" />
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
    console.log(document.write)

    function accept() {
    }

  </script>


</head>


<body>
  
  <form style="padding:50px">
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

          <p><a href="cart.php" class="btn btn-primary">กลับไปตะกร้าสินค้า</a>&nbsp;<button class="btn btn-info" onClick="window.print()">พิมพ์ใบสเสร็จ</button> </p>

          <table width="700" border="1" align="center" class="table">
            <tr>
              <td style="background-color:#89F79F ;color:red" width="1560" colspan="6" align="center">
                <strong>สั่งซื้อสินค้า</strong></td>
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
              $sql = "SELECT * FROM items WHERE item_ID=$p_id";
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


    </div>
  </form>
  <p style="padding-left:60%"><a class="btn btn-primary btn2" style="background-color:#73F781;color:tomato"><b>ชำระเงิน / เลือกช่องทาง (การชำระเงิน)</b></a>
    <div id="S" class="container" hidden>
      <div class="row">

      <div class="col-md-5" style="background-color:#000000">


        <h3 align="center" style="color:green">
            <span class="glyphicon glyphicon-shopping-cart"></span>

          <!-- form -->
            confirm cart</h3>
          <form style="padding:20px;background-color:#000000" action="upload.php" method="post" enctype="multipart/form-data" class="form-horizontal">
          
          </form>

        </div>
        <div class="col-md-1" >
          </div>
        
        <div class="col-md-5" style="background-color:#f4f4f4">

          <h3 align="center" style="color:green">
            <span class="glyphicon glyphicon-shopping-cart"></span>

          <!-- form -->
            confirm cart</h3>
          <form style="padding:20px" action="upload.php" method="post" enctype="multipart/form-data" class="form-horizontal">
            <tr>
              <td align="right" valign="middle">ช่องทางการชำระเงิน</td>
              <td colspan="2"><label for="pro_qty"></label>
                :
                <select name="p_unit" id="p_unit" required>
                  <option value="">กรุณาเลือก</option>
                  <option value="ชำระเงินผ่านธนาคาร">ชำระเงินผ่านธนาคาร</option>
                  <option value="ชำระเงินผ่านบัตร">ชำระเงินผ่านบัตร</option>
                </select></td>
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

            เลือกไฟล์ภาพที่จะอัปโหลด:

            <input type="file" name="file">
            <br>
            <small><span style="color:red">หมายเหตุ :</span> กรุณาชำระเงินให้พอดีกับราคาสินค้าหากท่านโอนเงินเกินราคาสินค้า<br><i style="color:red">**จะไม่มีการโอนคืน**</i> <small>
                <br>
                <center> <input type="submit" name="submit" value="Upload"></center>
          </form>

        </div>
        
      </div><br><br><br><br><br>
    </div>

</body>

</html>
<style>
  body {

    font-family: 'Prompt', sans-serif;
    background-color: #DCF7F3;
  }

  td {
    background-color: rgba(255, 255, 128, .5);
    color: green;
    text-align: center;
  }

  th {
    text-align: center;
    color: #050E93;
  }
</style>