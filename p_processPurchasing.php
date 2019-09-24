<?php

require_once("db/connection.php");
session_start();

if (isset($_POST['submit']))
{
    $PONum = $_SESSION['PONum'];
    echo $PONum;
    $date = $_SESSION['date'];
    $supplier = $_SESSION['SupplierName'];
    $address = $_SESSION['address'];
    $status = $_SESSION['status'];
    $query = "INSERT INTO p_purchasingmanagement (Date, SupplierName, Address, Status)
        VALUES('".$_SESSION['date']."', '".$_SESSION['SupplierName']."', '".$_SESSION['address']."', '".$_SESSION['status']."')";

        if(mysqli_query($con,$query)) { 
            header("message=successfully added new records");
        }
        else { 
            header("message=error in adding the record");
        }


    $POQuery = ("SELECT count(PONum) AS POCOUNT FROM p_purchasingmanagement ");
    $POresult =  $con->query($POQuery);
    if ($POresult->num_rows > 0) {
            // output data of each row
     while($row = $POresult->fetch_assoc()) {
        $PONum= $row['POCOUNT'] ;
        echo $PONum;
            }
    } else {
        echo "0 results";
        }


    $insertDetails = "INSERT INTO p_podetails (PONum, ProductCode, Category, Brand, ProductDesc, Size, Quantity)
        SELECT PONum, ProductCode, Category, Brand, ProductDesc, Size, QuantitytobeOrdered FROM temporarypurchasing";   

        if(mysqli_query($con,$insertDetails))
        { 
            header("message=successfully added new records");
            echo "yay";
        }
        else { 
            $errormessage = mysqli_error($con);
            echo "<script language='javascript'>";
            echo "alert('.$errormessage.')";
            echo '</script>';
           
            header("message=error added new records");
        }
    
    $refreshQuery = "DELETE FROM temporarypurchasing";
    if(mysqli_query($con,$refreshQuery)) {
        //header("location:p_purchase_purchase_history.php?message=successfully added new records");
        session_unset();
        session_destroy();
        $alert = "Purchase has been successfully made!";
                    echo '<script type="text/javascript">';
                    echo 'alert("'.$alert.'")';
                    echo '</script>';  
                    include("p_purchase_purchase_history.php");
    }
    else {
        $alert = mysqli_error($con);
        echo '<script type="text/javascript">';
        echo 'alert("'.$alert.'")';
        echo '</script>';  
        include("p_purchase_purchase_history.php");
    } 
    
}
?>
