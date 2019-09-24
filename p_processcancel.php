<?php 
if(!isset($_SESSION)){
    session_start();
}
require_once("db/connection.php");
if(isset($_POST['submit']))

{
    $PONum= $_SESSION['PONum'];
    $status = $_POST['reason'];
    $valueToSearch =  $_SESSION['searchvalue'];
    echo $PONum; 
    echo $status; 
    echo $valueToSearch;
    $statusquery = "UPDATE p_podetails 
                    SET status = '".$status."'
                    WHERE ProductCode = $valueToSearch  AND PONum = $PONum";
    if(mysqli_query($con,$statusquery)){
        
        $alert = "Successfully updated purchase order!";
        echo $alert;
        echo '<script type="text/javascript">';
        echo 'alert("'.$alert.'")';
        echo '</script>'; 
        header("location:p_view_purchase_order.php?message=Cancellation Successful.");
        
            
            
                    }
        else{
            
            $alert = mysqli_error($con);
            echo $alert;
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';  
            header("location:p_view_purchase_order.php?message=Error in cancellation. Please try again.");            
        }
        
}
?>