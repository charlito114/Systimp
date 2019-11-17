<?php

 require_once("connection.php");
 session_start();

if (isset($_POST['submit']))
{
    $TotalQuery = ("SELECT SUM(TotalPrice) FROM temporaryinvoice");
    $total = mysqli_fetch_row(mysqli_query($con, $TotalQuery));
    $discount = $_SESSION['discount'];
    $finalAmount = ($total[0]  + ($total[0] * .12)) - $discount;
    $invoiceNum = $_SESSION['invoiceNum'] ;
    
    $query = "INSERT INTO salesmanagement (Date, salesbeforeVat, salesafterVat, SONum)
     VALUES('".$_SESSION['date' ]."', '".$total[0]."', '".$finalAmount."' , '".$_SESSION['SONum' ]."')";
     if(mysqli_query($con,$query)){
        $alert = "Successfully added new records!";
                        
                    }
        else{
            $alert = mysqli_error($con);
            echo $alert;

        }

        $insertDetails = "INSERT INTO invoicedetails (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, QuantityIssued, Price) 
        (SELECT invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, ToBeIssued, Price FROM temporaryinvoice)";
        if(mysqli_query($con,$insertDetails)){
            header("message=Successfully added new records");
                    
                }
        else{
            $alert = mysqli_error($con);
            echo $alert;
        }

        $refreshQuery = " DELETE FROM temporaryinvoice";
        if(mysqli_query($con,$refreshQuery)){
				//	session_unset(); 
                //    session_destroy();
                $_SESSION['discount'] = 0;
                    $alert = "Checkout successful!";
                    echo '<script type="text/javascript">';
                    echo 'alert("'.$alert.'")';
                    echo '</script>';  
                    include("sales_sales_list.php");
                }
        else{
            $alert = mysqli_error($con);
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';  
            include("sales_sales_list.php");
                }
                

    }
    ?>