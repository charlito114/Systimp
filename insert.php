<?php

 require_once("db/connection.php");
 session_start();

if (isset($_POST['submit']))
{

    $query = "INSERT INTO products (category, brand, proddesc, size, prodquan, repoint, price) 
    VALUES('".$_SESSION['category']."', '".$_SESSION['brand']."', '".$_SESSION['proddesc']."','".$_SESSION['size']."','".$_SESSION['quantity']."' ,'".$_SESSION['repoint']."' ,'".$_SESSION['price']."' )";

   if(mysqli_query($con,$query)){
    echo '<script language="javascript">';
    echo 'alert("The inventory list has been successfully updated!")';
    echo '</script>';
    include("inventory.php");
                
					session_unset(); 
					session_destroy();
                }
    else{
        header("location:inventory.php?message=Error in adding the record");
    }
    
}
?>
    