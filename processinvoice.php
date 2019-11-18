<?php

 require_once("connection.php");
 session_start();

if (isset($_POST['submit']))
{
    $Subtotal =  $_SESSION['Subtotal1'];
    $Total =  $_SESSION['total'];
    $invoiceNum = $_SESSION['invoiceNum'];
    $payment = $_SESSION['payment'];
    echo $payment;
    $invoiceNum = $_SESSION['invoiceNum'];

    
    if($payment != 0 ){
        $insertDetails = "INSERT INTO invoicedetails (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, QuantityIssued, Price) 
        (SELECT invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, ToBeIssued, Price FROM temporaryinvoice)";
        if(mysqli_query($con,$insertDetails)){
            header("message=Successfully added new records");

            $query = "INSERT INTO salesmanagement (Date, salesbeforeVat, salesafterVat, SONum)
            VALUES('".$_SESSION['date' ]."', '".$Subtotal."', '".$Total."' , '".$_SESSION['SONum' ]."')";
            if(mysqli_query($con,$query)){
             //  $alert = "Successfully added new records!";
             $refreshQuery = " DELETE FROM temporaryinvoice";
             if(mysqli_query($con,$refreshQuery)){
                     $_SESSION['discount'] = 0;
                     $_SESSION['payment'] = 0;
                     header("location:view_invoice.php?message= Successfully Created Invoice.");

                               
                           }
               else{
                   $alert = mysqli_error($con);
                   echo $alert;
                               
                           }
       
               }
       
                    
                }
        else{
            $alert = mysqli_error($con);
            echo $alert;
            $refreshQuery = " DELETE FROM temporaryinvoice";
            if(mysqli_query($con,$refreshQuery)){
                    $_SESSION['discount'] = 0;
                    header("location:pos.php?message= Error In Creating Invoice.");

                        
                    }
        }

    }
    else{
        header("location:pos.php?message= Please enter an amount and try again.");

    }
    

        
                

    }

    ?>