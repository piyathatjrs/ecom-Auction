<?php
session_start();
require("conf.php");
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE user_Name = '$username'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
mysqli_close($connect);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
    
    <!-- Include CSS -->
	<link href="./css/ajax.css" rel="stylesheet" type="text/css" />
	<!-- font  -->
	<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">


    <!-- Include Scripts -->
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="./js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
			$("#submit_address").click(function() {
				$(".loading").show(500);
				$("#user-address-form").hide(0);
				$("#message_address").hide(0);

				$.ajax({
					type: 'POST',
					url: 'ajax_member_address.php',
					dataType: 'json',
					data: {
						user: '<?php echo $row['user_Name']; ?>',
						address: $("#address").val(),
						postal: $("#postal").val()
					},
					success: function(data) {
						$(".loading").hide(500);
						$("#message_address").removeClass();
						if (data.error === true) {
							$("#message_address").addClass("message-error");
						}
						else $("#message_address").addClass("message-success");
							$("#message_address").text(data.msg).show(500);
							$("#user-address-form").show(500);
						},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						$(".loading").hide(500);
						$("#message_address").removeClass().addClass("message-error").text("There was an AJAX error").show(500);
						$("#user-address-form").show(500);
					}
				});
				return false;
			});
		});

	</script>
</head>
<body>
<!-- START MAIN CONTAINER -->
<div class="centerBox">
<div class="container">
<h1 style="color:#090D3E">แก้ไขที่อยู่</h1>
	<div id="message_address" style="display:none;">
    </div>
	<div class="form-container">
      		<form id="user-address-form" class="common-form">
    <table>
    	<tr>
    		<td class="label"><h4>ที่อยู่</h4></td>
    		<td class="field"><textarea class="input" id="address" name="address" rows="4"><?php echo $row['user_Address']; ?></textarea></td>
        	<td class="status"></td>
    	</tr>

    	<tr>
        	<td class="label"><h4>รหัสไปรษณีย์</h4></td>
    		<td class="field"><input class="input" value="<?php echo $row['user_Postal']; ?>" id="postal" name="postal" type="text" /></td>
            <td class="status"></td>
        </tr>
	</table>
    <p align="left">
    <input type="image" src="./images/submit.png" value="Submit" name="submit_address" id="submit_address" />
    </p>
    </form>
	</div>
    <div class="loading" style="display:none">
    Please wait<br />
    <img src="images/ajax-loader.gif" title="Loader" atl="Loader" />
    </div>
  </div>
       <br class="clear" />
       <br class="clear" />
    </div>

</div><!-- END MAIN CONTAINER -->


</body>
</html>
<style>
body , h1 ,li{
  font-family: 'Prompt', sans-serif;
}
  h1 {
    text-shadow: 2px 2px 0px #FFFFFF,
     5px 4px 0px rgba(0, 0, 0, 0.15), 
    -1px 8px 0px rgba(206, 177, 165, 0.17);
    color: #333333;
    
  }
  </style>
