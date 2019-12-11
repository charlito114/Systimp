<?php 
error_reporting(0);
if(!isset($_SESSION)){
    session_start();
}
require_once("db/connection.php");
if(isset($_POST['submitreturn'])){
$Returned = $_POST['returnvalue'];
$invoiceNum = $_SESSION['invoiceNum'];
$EditCode =  $_POST['submitreturn'];
$returnquery = "UPDATE invoicedetails 
                    SET Returned = Returned + '".$Returned."'
                 
                    WHERE ProdCode = $EditCode  AND invoiceNum = $invoiceNum";
    if(mysqli_query($con,$returnquery)){
        
        $insertaudit = "INSERT INTO auditreturns (invoiceNum, ProdCode, Date, Quantity) VALUES ('".$invoiceNum."', '".$EditCode."', now(), '".$Returned."')";
        if(mysqli_query($con,$insertaudit)){
            $alert = "yay";
        }
        else{
            $alert = mysqli_error($con);
                        echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>';  
                        include("sales_manage_returns.php");

        }
        $alert = "Successfully Processed Return!";
        echo '<script type="text/javascript">';
        echo 'alert("'.$alert.'")';
        echo '</script>'; 
        header("location:sales_manage_returns.php?message= Successfully Processed Return.");
        
            
            
                    }
                    else{
            
                        $alert = mysqli_error($con);
                        echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>';  
                        include("sales_manage_returns.php");

                                
                    }

}

?>