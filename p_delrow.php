<?php

 require_once("db/connection.php");
 session_start();

if (isset($_POST['remove']) && $_SESSION['countorder']!= 1 || $_SESSION['countpurchase']!= 1 )
{
    $todelete =  $_SESSION['search'];
    $query = "DELETE FROM products WHERE prodcode = $todelete";


   if( mysqli_query($con,$query) ){
    header("location:p_inventory_remove_product.php?message=Successfully removed product from database");
                
					session_unset(); 
					session_destroy();
                }
    else{
        header("location:p_inventory_remove_product.php?message=Error in removing the product");
    }

    
}
else{
    echo '<script language="javascript">';
    echo 'alert("This item cannot be deleted due to pending transactions. Please try again")';
    echo '</script>';
    include("p_inventory_remove_product.php");
    session_unset(); 
	session_destroy();
}
?>