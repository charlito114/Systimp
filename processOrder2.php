<?php

 require_once("db/connection.php");
 session_start();

 $counttemp = "SELECT count(SONum) as count from temporaryorders";
 $countresult =  $con->query($counttemp);
 if ($countresult->num_rows > 0) {

     while($row = $countresult->fetch_assoc()) {
         $count= $row['count'];
         }
        } 

if (isset($_POST['submit']))
{
    if($count==0){
        header("location:order_add_order.php?message=Error in adding the record");

    }
    else{

    $SONum =  $_SESSION['SONum'] ;
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
            header("location:view_sales_order.php?message=Successfully added new records");
					//session_unset(); 
                   // session_destroy();
                    
                }
        else{
            header("location:order_sales_orders.php?message=Error in adding the record");
            $alert = mysqli_error($con);
           
                }
            }
    
}
?>
    