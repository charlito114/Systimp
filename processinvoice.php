<?php
 require_once("connection.php");
 session_start();
 error_reporting(0);
if (isset($_POST['submit'])){
    $Subtotal =  $_SESSION['Subtotal1'];
    $Total =  $_SESSION['total'];
    $invoiceNum = $_SESSION['invoiceNum'];
    $payment = $_SESSION['payment'];
    $invoiceNum = $_SESSION['invoiceNum'];
    $discount = $_SESSION['discount1'];
    $VAT = $_SESSION['VAT'];
    $chequenumber =  $_SESSION['chequenumber'];
    $banknumber =  $_SESSION['banknumber'];
    if(empty($chequenumber) && empty($banknumber)){
        $insertDetails = "INSERT INTO invoicedetails (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, QuantityIssued, Price) 
        (SELECT invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, ToBeIssued, Price FROM temporaryinvoice)";
        if(mysqli_query($con,$insertDetails)){
            header("message=Successfully added new records");
            $query = "INSERT INTO salesmanagement (Date, salesbeforeVat, discount, vat, salesafterVat, SONum, status)
            VALUES('".$_SESSION['date' ]."', '".$Subtotal."', '".$discount."', '".$VAT."','".$Total."' , '".$_SESSION['SONum' ]."', 'Completed')";
            if(mysqli_query($con,$query)){
             //  $alert = "Successfully added new records!";
             $refreshQuery = " DELETE FROM temporaryinvoice";
             if(mysqli_query($con,$refreshQuery)){
                     $_SESSION['discount'] = 0;
                     $_SESSION['payment'] = 0;
                     $_SESSION['chequenumber']=0;
                     $_SESSION['banknumber']=0;
                     $message = "Successfully Created Invoice";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='view_invoice.php'</script>";
                     //header("location:view_invoice.php?message= Successfully Created Invoice.");
                               
                           }
               else{
                   $alert = mysqli_error($con);
                               
                           }
       
               }
       
                    
                }
        else{
            $alert = mysqli_error($con);
            $refreshQuery = " DELETE FROM temporaryinvoice";
            if(mysqli_query($con,$refreshQuery)){
                    $_SESSION['discount'] = 0;
                    $message = "Error In Creating Invoice";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='order_pending_sos.php'</script>";
                    // header("location:pos.php?message= Error In Creating Invoice.");
                        
                    }
        }
    }
    else{
        $insertCheckDetails = "INSERT INTO checkdetails (invoiceNum, bankNum, checkNum, totalAmount) VALUES ('".$invoiceNum."', '".$banknumber."', '".$chequenumber."', '".$Total."')";
        if(mysqli_query($con,$insertCheckDetails)){
            header("message=Successfully added new records");
            
                
            }
        
    
        $insertDetails = "INSERT INTO invoicedetails (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, QuantityIssued, Price) 
        (SELECT invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, ToBeIssued, Price FROM temporaryinvoice)";
        if(mysqli_query($con,$insertDetails)){
            header("message=Successfully added new records");
     
            $query = "INSERT INTO salesmanagement (Date, salesbeforeVat, discount, vat, salesafterVat, SONum, status)
            VALUES('".$_SESSION['date' ]."', '".$Subtotal."', '".$discount."', '".$VAT."','".$Total."' , '".$_SESSION['SONum' ]."', 'Pending' )";
            if(mysqli_query($con,$query)){
             //  $alert = "Successfully added new records!";
             $refreshQuery = " DELETE FROM temporaryinvoice";
             if(mysqli_query($con,$refreshQuery)){
                     $_SESSION['discount'] = 0;
                     $_SESSION['payment'] = 0;
                     $_SESSION['chequenumber']=0;
                     $_SESSION['banknumber']=0;
                     $message = "Successfully Created Invoice";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='view_invoice.php'</script>";
                     //header("location:view_invoice.php?message= Successfully Created Invoice.");
                               
                           }
               else{
                   $alert = mysqli_error($con);
                               
                           }
       
               }
       
                    
                }
        else{
            $alert = mysqli_error($con);
            $refreshQuery = " DELETE FROM temporaryinvoice";
            if(mysqli_query($con,$refreshQuery)){
                    $_SESSION['discount'] = 0;
                    $message = "Error In Creating Invoice";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='order_pending_sos.php'</script>";
                    //header("location:pos.php?message= Error In Creating Invoice.");
                        
                    }
        }
    
    }
}
    
        
                
    
    ?>