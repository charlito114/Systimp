<?php 
if(!isset($_SESSION)){
    session_start();
}
require_once("db/connection.php");
if(isset($_POST['submit']))
{
    $PONum= $_SESSION['PONum'];
    $status = $_POST['cancelreason'];
    $EditCode =  $_SESSION['EditCode'];
    echo $PONum; 
    echo $status; 
    echo $EditCode;
    $cancelQuery = "UPDATE p_podetails 
                    SET status = '".$status."'
                    WHERE ProductCode = $EditCode  AND PONum = $PONum";
    if(mysqli_query($con,$cancelQuery)){
        
        $alert = "Successfully cancelled an item in purchase order!";
        echo $alert;
        echo '<script type="text/javascript">';
        echo 'alert("'.$alert.'")';
        echo '</script>'; 
        header("location:view_purchase_order.php?message=Cancellation Successful.");
        
            
            
                    }
                    else{
            
                        $alert = mysqli_error($con);
                        echo $alert;
                        echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>';  
                                
                    }
}
  
        
?>