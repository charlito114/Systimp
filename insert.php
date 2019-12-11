<?php

 require_once("db/connection.php");
 session_start();

 $counttemp = "SELECT count(id) as count from temporaryinventory";
 $countresult =  $con->query($counttemp);
 if ($countresult->num_rows > 0) {

     while($row = $countresult->fetch_assoc()) {
         $count= $row['count'];
         }
        } 
if (isset($_POST['submit']))
{

    if($count==0){
        header("location:inventory_add_product.php?message=Error in adding the record");

    }

   else{

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
}
?>
    