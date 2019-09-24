<?php 
require_once("db/connection.php");
if(isset($_POST['submit']))

{
    session_start();
    $PONum= $_SESSION['PONum'];
    $receivedquantity = $_POST['quantityReceived'];
    $valueToSearch =  $_SESSION['searchvalue'];
    $statusquery = "UPDATE p_podetails 
                    SET receivedquantity = '".$receivedquantity."'
                    WHERE ProductCode = $valueToSearch  AND PONum = $PONum";
    if(mysqli_query($con,$statusquery)){
        $alert = "Successfully updated purchase order!";
        echo $alert;
        echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';  
            header("location:p_view_purchase_order.php?message=Successfully Updated Purchase Order");

            
            
                    }
        else{
            $alert = mysqli_error($con);
            echo $alert;
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';  
            header("location:p_view_purchase_order.php?message=Error in updating purchase order");
            
            
        }
        
}
?>