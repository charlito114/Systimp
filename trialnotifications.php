<?php
session_start();
require_once("db/connection.php");

?>

<html>
<head></head>
<body>

<form method = "post" >
<table>
<th></th>

<?php
$getNotifs ="SELECT * FROM notifications";
$search_result = mysqli_query($con, $getNotifs);
    if ($search_result->num_rows > 0) {
        while($row = $search_result->fetch_assoc()) {

            $status = $row['status'];
            if($status == 'Unread'){
            echo "\t<tr><button type = 'submit' name = 'notification'  style = 'background-color: grey; border:0.5;' value = '" . $row['notifID'] . "' > " . $row['date']  . "<br>". $row['description'] . "   </button></tr><br>";
            }
            else if($status == 'Read') {
                echo "\t<tr><button type = 'submit' name = 'notification'  value = '" . $row['notifID'] . "' >  " . $row['date']  . "<br>". $row['description'] . "    </button></tr><br>";

            }
    }
 }
 ?>

</table>
</form>

<?php

if(isset($_POST['notification'])) {
    $notifID = $_POST['notification']; 
    $specificNotif ="SELECT * FROM notifications WHERE notifID = $notifID";
    $search_result = mysqli_query($con, $specificNotif);
    if ($search_result->num_rows > 0) {
        while($row = $search_result->fetch_assoc()) {
            $redirect = $row['type'];
            $code = $row['code'];
        }
    }

    $updateStatus = "UPDATE notifications 
    SET status = 'Read' 
    WHERE notifID = $notifID";

    if(mysqli_query($con,$updateStatus)){
        $alert = 'Yay';
     }

     else{
        $alert = mysqli_error($con);
        echo $alert;
                }


    if($redirect == 'Inventory' ){
        header("location:purchase_purchase_cart.php");       

    }
    else if($redirect == 'Purchase' ){
        $_SESSION['PONum'] = $code;
        header("location:view_pending_order.php");       

    }
    
}
?>