<div class="container cart">
<?php
    // if (!isset($_SESSION['is_member'])) {
    //   header("Location: module.php?module=member&file=login");
    // }
    error_reporting( error_reporting() & ~E_NOTICE );
    $p_id = $_REQUEST['p_id'];//รับการเรียกของ id
    $act = $_REQUEST['act'];//รับการเรียกของ act

      if($act=='add' && !empty($p_id)) {
      if(!isset($_SESSION['shopping_cart']))
      {

        $_SESSION['shopping_cart']=array();
      }else{

      }
      if(isset($_SESSION['shopping_cart'][$p_id])) {
        $_SESSION['shopping_cart'][$p_id]++;
      }else {
        $_SESSION['shopping_cart'][$p_id]=1;
      }
    }

    if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
    {
      unset($_SESSION['shopping_cart'][$p_id]);
    }

    if($act=='update') { //อัพเดตร
      $amount_array = $_POST['amount'];
      foreach($amount_array as $p_id=>$amount) {
        $_SESSION['shopping_cart'][$p_id]=$amount;
      }
    }

    //ยกเลิกตะกร้าสินค้า
    if ($act == 'Cancel-Cart') {//ถ้า $act เท่ากับ Cancel-Cart ให้ทำการ unset ค่าSESSION ของ shopping_cart
      unset($_SESSION['shopping_cart']);
    }
    print_r($_SESSION);
    echo "<Br>" . $_REQUEST['item_ID'];
    echo "<Br>" . $act;

 ?>
 <div class="container primary-sec">
<div class="row mt">
  <!-- &product_id=$row_showproduct[id] -->
      <div class="col-lg-12">
              <div class="content-panel">
      <h4><i class="fa fa-angle-right"></i> ตะกร้าสินค้า</h4>
                  <section id="no-more-tables">
                    <form id="frmcart" class="frmcart" action="module.php?module=order&file=cart&act=update" name="frmcart" method="post">
                      <table class="table table-bordered table-striped table-condensed cf">
                          <thead class="cf">
                          <tr>
                              <th class="numeric">No.</th>
                              <th class="numeric">สินค้า</th>
                              <th class="numeric">ราคา</th>
                              <th class="numeric">จำนวน</th>
                              <th class="numeric">รวมรายการ</th>
                              <th class="numeric">ลบ</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                            if (!empty($_SESSION['shopping_cart'])) {
                                  foreach ($_SESSION['shopping_cart'] as $p_id=>$p_qty) {
                                    $query = "SELECT * FROM items WHERE item_ID = '$p_id' ";
                                    $result = mysqli_query($connect,$query);
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { //while loop
                                      $sum = $row['item_Actual_Price'] * $p_qty; //ราคาคูณด้วยจำนวน
                                      $total += $sum; //บวกเพิ่มค่าทีละ 1
                            ?>
                          <tr>
                              <td class="numeric" data-title="No."><?php echo $i += 1;?></td>
                              <td class="numeric" data-title="สินค้า"><?php echo $row['item_Name']; ?></td>
                              <td class="numeric" data-title="Price"><?php echo number_format($row['item_Actual_Price'],2);?></td>
                              <td class="numeric" data-title="Numitem"><input type="text" name="<?php echo amount[$p_id];?>" value="<?php echo $p_qty;?>"></td>
                              <td class="numeric" data-title="Allitem"><?php echo number_format($sum,2); ?> บาท</td>
                              <td class="numeric" data-title="Delete"><a href="module.php?module=order&file=cart&item_ID=<?php echo $row['item_ID'];?>&act=remove" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
                          </tr>
                                <?php
                              }
                            }
                          ?>
                        </tbody>

                          <tr bgcolor="#fff">
                            <td class="numeric" colspan="5" align="right">Total</td>
                            <td class="numeric" align='right' data-title="Allprice"><?php echo number_format($total,2); ?> บาท</td>
                          </tr>
                          <?php
                            }
                           ?>
                          <tr style="border: none;">
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td class="numeric" bgcolor="#fff" colspan="5" align="right" style="border: none;">
                              <a href="module.php?module=order&file=cart&act=Cancel-Cart" class="btn btn-danger"> ยกเลิกตะกร้าสินค้า </a>
                              <!-- cart.php?act=Cancel-Cart -->
                              <!-- <button type="submit" name="button" id="button" class="btn btn-warning"> คำนวณราคาใหม่ </button> -->
                              <button type="button" name="Submit2"  onclick="window.location='module.php?module=order&file=confirm';" class="btn btn-primary">สั่งซื้อ </button>
                            </td>
                          </tr>
                      <p align="center"> <a href="module.php?module=page&file=shop" class="btn btn-primary">กลับไปเลือกสินค้า</a> </p>
                      </table>
                      </form>
                      <!-- <div class="button-cart" align="right">
                          <button type="submit" name="button" id="button" class="btn btn-warning"> คำนวณราคาใหม่ </button>
                          <button type="button" name="Submit2"  onclick="window.location='confirm.php';" class="btn btn-primary">สั่งซื้อ </button>
                      </div> -->
                  </section>
              </div><!-- /content-panel -->
          </div><!-- /col-lg-12 -->
      </div><!-- /row -->
      </div>
      </div>
