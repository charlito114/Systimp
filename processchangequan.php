<?php 
error_reporting(0);
session_start();
require_once("connection.php");
if(isset($_POST['submit'])){
    $productcode = $_SESSION['ProdCode'];
    $newQuan = $_POST['newQty'];
    $SONum = $_SESSION ['SONum']; 
   // $invoiceNum = $_SESSION ['invoiceNum']; 
    
    /*$availableQuery = ("SELECT  Available, QuantityIssued, Quantity FROM temporaryinvoice  WHERE ProdCode = $productcode  ");
    $result2 = $con->query($availableQuery);
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row = $result2->fetch_assoc()) {
            $available = $row['Available'];
            $qtyIssued = $row['QuantityIssued'];
            $qtyordered = $row['Quantity'];
            
            }
        } 
        else {
            echo "0 results";
            }
    
   if(($newQuan <= $available) && ($qtyIssued< $qtyordered) ){ */
    $updateQuery = "UPDATE temporaryinvoice 
    SET ToBeIssued = '".$newQuan."', 
    TotalPrice = Price * '".$newQuan."'
    WHERE prodcode = $productcode  AND SONum = $SONum";
    if(mysqli_query($con,$updateQuery)){
    //$message = "Successfully updated purchase!";
    //header("location:pos.php?message=".$message);
        $message = "Quantity has been successfully updated";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";
    //header("location:pos.php?message=Quantity has been successfully updated."); // palagay ng alert
    }
    else{
        $message = "Error in updating quantity";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";
      //  $message = "Error in updating quantity. Please try again";
       // header("location:pos.php?message=".$message);
        //header("location:pos.php?message=Error in updating quantity."); // palagay ng alert
    }
    
    /*}
    else{
       // $message = "Error in updating quantity. Please try again";
       // header("location:pos.php?message=".$message);
                header("location:pos.php?message=Error in updating quantity. Please try again.");   // palagay ng alert
    }
    */
}