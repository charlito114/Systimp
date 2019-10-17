<?php
session_start();
require_once("connection.php");
if(isset($_POST['PONum']))
{
    $PONum = $_POST['PONum'];
    $_SESSION['PONum'] = $PONum;
    

}
    echo    "<table >";
    echo    "<tr>";
    echo        "<th>Date</th>";
    echo        "<th>PO Number</th>";
    echo        "<th>Supplier Name</th>";
    echo        "<th>Address</th>";
    echo       "<th>Status</th>";
    echo    "</tr>";


    $viewOrder = "SELECT * FROM p_purchasingmanagement WHERE PONum = " . $_SESSION['PONum'];
    $result = $con->query($viewOrder);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $status = $row['Status']; //added this part to get the status
        echo "\t<tr><td >" . $row['Date'] . "</td><td>" . $row['PONum'] . "</td><td>"  .  $row['SupplierName'] . "</td><td>" . $row['Address'] .  "</td><td>" . $row['Status']  . "</td></tr>\n";
        }
    } else {
        echo "0 results";
        }
    echo    "</table >";    

    echo    "<table >";
    echo    "<tr>";
    echo        "<th>Product Code</th>";
    echo        "<th>Category</th>";
    echo        "<th>Brand</th>";
    echo        "<th>Description</th>";
    echo        "<th>Size</th>";
    echo       "<th>Quantity Ordered </th>";
    echo        "<th>Quantity to be Received</th>";
    echo        "<th>Status</th>";
    echo    "</tr>";

    $viewDetails = "SELECT * FROM p_podetails WHERE PONum = " . $_SESSION['PONum'];
    $result2 = $con->query($viewDetails);
    if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo "<form method = 'post' action = '' >";
        if($row['status'] == 'Processing' && $status== 'Ongoing'){
        echo "\t<tr><td ><input type = 'submit' name = 'ProductCode' value = '" . $row['ProductCode'] . "' ></td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['ToReceive'] . "</td><td>" . $row['status'] .  "</td> <td><button type = 'submit' name = 'receive'  value = '" . $row['ProductCode'] . "' formaction = 'vpo2.php' > Receive </button></td><td><button type = 'submit' name = 'cancel' formaction = 'vpocancel.php'  value = '" . $row['ProductCode'] . "' > Cancel </button></td></tr>\n";
        }
        else{
        echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] . "</td><td>" . $row['ToReceive'] . "</td><td>" . $row['status'] .  "</td> </tr>\n";

        }
    }
        echo "</form>";
    } 
    else {
        echo "0 results";
        }
    echo    "</table ></br>"; 

    if(isset($_POST['ProductCode'])){
    $ProdDetails = $_POST['ProductCode'];

    echo    "<label> Audit Log </label></br>";
    echo    "<table >";
    echo    "<tr>";
    echo        "<th>Date</th>";
    echo        "<th>Product Code</th>";
    echo        "<th>Quantity Received</th>";
    echo    "</tr>";

    $viewAudit = "SELECT * FROM purchaseaudit WHERE PONum = " . $_SESSION['PONum']. " AND ProductCode = $ProdDetails" ;
    $result2 = $con->query($viewAudit);
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row = $result2->fetch_assoc()) {
            echo "<form method = 'post' action = '' >";
            echo "\t<tr><td >" . $row['Date'] . "</td><td>" . $row['ProductCode'] . "</td><td>"  .  $row['Received'] . "</td></tr>\n";
        }
            echo "</form>";
        } 
        else {
            echo "0 results";
            }

    echo "</table>"; 

        }


    echo "<form method = 'post' action = '' >"; 
    echo "<input type = 'submit' name = 'back'  value = 'Back' formaction =  'sales_orders.php'>";
    echo "</form>"; 
  
//}



?>