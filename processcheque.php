<?php

 require_once("connection.php");
 session_start();

if (isset($_POST['receive'])){

    $invoiceNum =  $_POST['receive'];

    $updateStatus = "UPDATE checkdetails 
                        SET Status = 'Received'
                        WHERE invoiceNum = '".$invoiceNum."'";
                        
     if(mysqli_query($con,$updateStatus)){
        header("location:sales_pending_cheques.php?message= Successfully Received Payment.");
     }

     else{
        $alert = mysqli_error($con);
        echo $alert;
        header("location:sales_pending_cheques.php?message= Error In Receiving Payment.");       
                }

}
?>
