<?php

 require_once("db/connection.php");
 session_start();

if (isset($_POST['submit']))
{

    $query = "INSERT INTO products (category, brand, proddesc, size, prodquan, repoint, price) 
    SELECT category, brand, proddesc, size, prodquan, repoint, price FROM temporaryinventory ";
   if(mysqli_query($con,$query)){
    echo '<script language="javascript">';
    echo 'alert("The inventory list has been successfully updated!")';
    echo '</script>';
    include("inventory.php");
                
				
                }
    else{
        header("location:inventory.php?message=Error in adding the record");
    }
    
}
?>
    