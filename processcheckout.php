<?php

 require_once("db/connection.php");
 session_start();

if (isset($_POST['submit']))
{
    $TotalQuery = ("SELECT SUM(price) FROM temporaryinvoice");
    $total = mysqli_fetch_row(mysqli_query($con, $TotalQuery));
    $minusVat = $total[0]  - ($total[0] * .12);
    
    $query = "INSERT INTO salesmanagement (Date, salesbeforeVat, salesafterVat, SONum)
     VALUES('".$_SESSION['date' ]."', '".$total[0]."', '".$minusVat."' , '".$_SESSION['SONum' ]."')";
     if(mysqli_query($con,$query)){
        $alert = "Successfully added new records!";
                        
                    }
        else{
            $alert = mysqli_error($con);
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>'; 
        }
     

        $insertDetails = "INSERT INTO invoicedetails (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, QuantityIssued, Price)
        SELECT invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Quantity, QuantityIssued, Price FROM temporaryinvoice";
        if(mysqli_query($con,$insertDetails)){
            header("message=Successfully added new records");
                    
                }
        else{
            $alert = mysqli_error($con);
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>'; 
                }

        $refreshQuery = " DELETE FROM temporaryinvoice";
        if(mysqli_query($con,$refreshQuery)){
                    $alert = "Checkout successful!";
                    echo '<script type="text/javascript">';
                    echo 'alert("'.$alert.'")';
                    echo '</script>';  
                    include("order_sales_orders.php");
                }
        else{
            $alert = mysqli_error($con);
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';  
            include("order_sales_orders.php");
                }
                
                
    
}
?>