<?php 
session_start();
require_once("connection.php");
if(isset($_POST['submit'])){

    $productcode = $_POST['prodcode'];
    $newQuan = $_POST['newQty'];
    $SONum = $_SESSION ['SONum']; 
    $invoiceNum = $_SESSION ['invoiceNum']; 
    
    $availableQuery = ("SELECT  Available, QuantityIssued, Quantity FROM temporaryinvoice  WHERE ProdCode = $productcode  ");
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
    
    if(($newQuan <= $available) && ($qtyIssued< $qtyordered) ){

    $updateQuery = "UPDATE temporaryinvoice 
    SET quantityIssued = '".$newQuan."'
    WHERE prodcode = $productcode  AND SONum = $SONum AND invoiceNum = $invoiceNum";

    if(mysqli_query($con,$updateQuery)){

    $alert = "Successfully updated purchase order!";
    echo $alert;
    echo '<script type="text/javascript">';
    echo 'alert("'.$alert.'")';
    echo '</script>'; 
    header("location:pos.php?message=Quantity has been successfully updated."); // palagay ng alert

    }
    else{
        header("location:pos.php?message=Error in updating quantity."); // palagay ng alert

    }

    
    }

    else{
        $alert = "Error in updating quantity. Please try again";
                echo '<script type="text/javascript">';
                echo 'alert("'.$alert.'")';
                echo '</script>';  
                header("location:pos.php?message=Error in updating quantity. Please try again.");   // palagay ng alert
    }


}


