<?php 
if(!isset($_SESSION)){
    session_start();
}
require_once("db/connection.php");
if(isset($_POST['submit'])){
$ReceivedQty = $_POST['receivevalue'];
$PONum = $_SESSION['PONum'];
$EditCode =  $_SESSION['EditCode'];
$receivequery = "UPDATE p_podetails 
                    SET ToReceive = ToReceive - '".$ReceivedQty."', 
                     Received = Received + '".$ReceivedQty."'
                    WHERE ProductCode = $EditCode  AND PONum = $PONum";
    if(mysqli_query($con,$receivequery)){
        
        $alert = "Successfully updated purchase order!";
        echo '<script type="text/javascript">';
        echo 'alert("'.$alert.'")';
        echo '</script>'; 
        header("location:view_pending_order.php?message= Successfully Updated Purchase Order.");
        
            
            
                    }
                    else{
            
                        $alert = mysqli_error($con);
                        echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>';  
                        include("view_purchase_order2.php");

                                
                    }

}