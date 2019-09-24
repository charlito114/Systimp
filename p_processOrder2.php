<?php

 require_once("db/connection.php");
 session_start();

if (isset($_POST['submit']))
{
    
    $TotalQuery = ("SELECT SUM(TotalPrice) FROM temporaryorders");
	$total = mysqli_fetch_row(mysqli_query($con, $TotalQuery));
    $date = $_SESSION['date' ];
    $customer = $_SESSION['customer' ];
    $address = $_SESSION['address' ];
    echo $customer;
    $query = "INSERT INTO ordermanagement (Date, CustomerName, Address, TotalAmount)
     VALUES('".$_SESSION['date' ]."', '".$_SESSION['customer' ]."', '".$_SESSION['address' ]."' , '".$total[0]."')";
     if(mysqli_query($con,$query)){
        header("message=Successfully added new records");
                        
                    }
        else{
            header("message=Error in adding the record");
        }
     

        $insertDetails = "INSERT INTO salesorderdetails (SONum, ProdCode, Category, Brand, ProdDesc, Size, ProdQuan, Available, Price, TotalPrice)
        SELECT SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, Available, Price, TotalPrice FROM temporaryorders";
        if(mysqli_query($con,$insertDetails)){
            header("message=Successfully added new records");
                    
                }
        else{
            header("message=Error in adding the record");
                }

        $refreshQuery = " DELETE FROM temporaryorders";
        if(mysqli_query($con,$refreshQuery)){
            header("location:p_order_sales_orders.php?message=Successfully added new records");
					session_unset(); 
					session_destroy();
                }
        else{
            header("location:p_order_sales_orders.php?message=Error in adding the record");
                }
    
}
?>
    