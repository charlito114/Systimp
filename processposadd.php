<?php 
error_reporting(0);
session_start();
require_once("connection.php");
if(isset($_POST['submit'])){
    $addcode =$_POST['prodcode'];
    $qty =$_POST['newQty'];
    $SONum = $_SESSION ['SONum']; 
    $invoiceNum = $_SESSION ['invoiceNum']; 


    echo $addcode;
    echo $qty; 
    echo $SONum;

    $addQuery = ("SELECT * FROM salesorderdetails WHERE SONum = $SONum AND ProdCode = $addcode");
    $result =  $con->query($addQuery);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $prodcode= $row['ProdCode'];

                $desc = $row['ProdDesc'];
                $size = $row['Size'];
                $qtyordered = $row['ProdQuan'];
                $totalPrice = $row['TotalPrice'];
                $available = $row['Available'];
                $qtyIssued = $row['QuantityIssued'];


                }
            } else {
                echo '<script language="javascript">';
                echo 'alert("Product not listed in customer sales order")';
                echo '</script>';
                include("pos.php");
                //header("location:pos.php?message=Error in adding the product. Please try again.");           //palagay ng alert      
                }

                // alert not working 
    
    if(($qty <= $available) && ($qtyIssued< $qtyordered) ){
    $insertQuery = "INSERT INTO temporaryinvoice (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Available, Quantity, QuantityIssued, Price)
    VALUES('". $invoiceNum."', '". $SONum."','". $prodcode."', '". $category."', '". $brand."','". $desc."','". $size."' ,'". $available."' ,'". $qtyordered."' ,'". $qty."' ,'". $totalPrice."')";
    if(mysqli_query($con,$insertQuery)){
        header("location:pos.php?message=Successfully added the product!");  // palagay ng alert
    }
    else{
        header("location:pos.php?message=Error in adding the product. Please try again.");   //palagay ng alert 
        }

    }
    else{
                echo '<script language="javascript">';
                echo 'alert("Product not listed in customer sales order")';
                echo '</script>';
                include("pos.php");
                //header("location:pos.php?message=Error in adding the product. Please try again.");   // palagay ng alert
    }
}
  
            