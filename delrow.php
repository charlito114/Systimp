<?php
error_reporting(0);
 require_once("db/connection.php");
 session_start();



if (isset($_POST['remove']) )
{
    $todelete =  $_POST['remove'];
    $query = "UPDATE products SET status = 'Discontinued' WHERE prodcode = $todelete";


   if( mysqli_query($con,$query) ){
    echo '<script language="javascript">';
    echo 'alert("This item is deleted")';
    echo '</script>';
    include("inventory_remove_product.php");
    //header("location:inventory_remove_product.php?message=Successfully removed product from database");
                
                }
    else{
        echo '<script language="javascript">';
        echo 'alert("Error")';
        echo '</script>';
        include("inventory_remove_product.php");
        //header("location:inventory_remove_product.php?message=Error in removing the product");
    }

    
}
else{
    echo '<script language="javascript">';
    echo 'alert("This item cannot be deleted due to pending transactions. Please try again")';
    echo '</script>';
    include("inventory_remove_product.php");
   
}

?>