<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Confirm</title>
</head>

<body>
    <?php
    // Include the database configuration file
    session_start();
    require("conf.php");
    $statusMsg = '';
    $username = $_SESSION['username'];

    // File upload path
    $targetDir = "";
    $p_unit = $_POST['p_unit'];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $order_date = date("Y-m-d H:i:s");
    $status = 1;
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileName)) {
                // Insert image file name into database
                $insert = $connect->query("INSERT into tb_order (payment,name,address,email,phone,order_status,order_date,order_path,username) VALUES ('" . $p_unit . "','" . $name . "','" . $address . "','" . $email . "','" . $phone . "','" . $status . "','" . $order_date . "','" . $targetFilePath . "','" . $username . "')");
                if ($insert) {
                    
                    $total = 0;
                
                    foreach ($_SESSION['shopping_cart']  as $p_id => $p_qty) {
                        $sql = "SELECT * FROM items WHERE item_ID=$p_id";
                        $query = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                        $sum = $row['item_Actual_Price'] * 1;
                        $total += $sum;
                        if ($total != 0) {
                           
                          $sql_update_item = "UPDATE items SET order_out = 2 WHERE item_ID = '$p_id '";
                            mysqli_query($connect, $sql_update_item);

                            $sql_update_tb_oder = "UPDATE tb_order SET item_id = $p_id WHERE item_ID = '$p_id '";
                            mysqli_query($connect, $sql_update_tb_oder);
                
                            
                        }
                        
                         //unset($_SESSION['shopping_cart'][$p_id]);
                    }
                    
                    

                     $statusMsg = header('Location:pay_load.php');
                } else {
                    $statusMsg = "file upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    echo $statusMsg;




    ?>
   
</body>

</html>