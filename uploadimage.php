
<form action="upload.php" method="post" enctype="multipart/form-data" class="form-horizontal">
<tr>
      <td align="right" valign="middle">ช่องทางการชำระเงิน</td>
      <td colspan="2"><label for="pro_qty"></label>
         :
  <select name="p_unit" id="p_unit" required>
    <option value="">กรุณาเลือก</option>
    <option value="ชำระเงินผ่านธนาคาร">ชำระเงินผ่านธนาคาร</option>
    <option value="ชำระเงินผ่านบัตร">ชำระเงินผ่านบัตร</option>
    <option value="ชำระเงินปลายทาง">ชำระเงินปลายทาง</option>
  </select></td>
</tr>

<div class="form-group">
<div class="col-sm-12">
<input type="text" name="name" class="form-control" require placeholder="ชื่อ-นามสกุล"/>
</div>
</div>

<div class="form-group">
<div class="col-sm-12">
<input type="text" name="address" class="form-control" row="3" require placeholder="ที่อยู่ในการจัดส่งสินค้า"/>
</div>
</div>

<div class="form-group">
<div class="col-sm-12">
<input type="text" name="phone" class="form-control"  require placeholder="เบอร์โทรศัพท์"/>
</div>
</div>

<div class="form-group">
<div class="col-sm-12">
<input type="text" name="email" class="form-control"  require placeholder="อีเมล"/>
</div>
</div>
    
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>


