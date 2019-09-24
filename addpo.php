<html>
<head>
<title> Add Purchasae Order </title>

</head>

<body style = "background-color: #F0F3E1; font-family: Calibri; margin: 0%; " >

    <?php 
    session_start(); 
    require_once("db/connection.php");
    $date = date('Y-m-d');
    $_SESSION['date' ] = $date;
    echo "Date: " . $date . "<br>" ; 
    $POQuery = ("SELECT count(PONum) AS POCount FROM p_purchasingmanagement");
        $POresult =  $con->query($POQuery);
        if ($POresult->num_rows > 0) {
            // output data of each row
            while($row = $POresult->fetch_assoc()) {
                $PONum= $row['POCount'] + 1 ;
                $_SESSION['PONum'] = $PONum;
                echo "PO Num: " .  $_SESSION['PONum'] . "<br>";
                }
            } else {
                echo "0 results";
                }
    ?> 
    
    <form method = "post" action = "addpo.php" > 
        Supplier Name<input type = "text" name = "Supplier"> <br>
        Address <input type = "text" name = "Address"> <br>
        <input type = "submit" name = "proceed"  value = "proceed">
    </form>

    <?php
    if(isset($_POST['proceed']))
    {
        $supplier = $_POST['Supplier'];
        $address = $_POST['Address'];
        $_SESSION['SupplierName'] = $supplier;
        $_SESSION['address'] = $address; 
    }
    ?>


    <form method = "post" action = "">
    Product Code<input type = "text" name = "prodcode"> 
    <input type = "submit" name = "search"  value = "search">
    <input type = "submit" name = "add"  value = "add">
   

<?php 
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['prodcode'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM products WHERE prodcode  = ".$valueToSearch;
    $search_result = filterTable($query);
}

else {
    $query = "SELECT * FROM products WHERE prodcode =' ' ";
    $search_result = filterTable($query);
}

function filterTable($query)
{
    $con = mysqli_connect("localhost", "root", "", "inventory");
    $filter_Result = mysqli_query($con, $query);
    return $filter_Result;
}


if ($search_result->num_rows > 0) {
// output data of each row

while($row = $search_result->fetch_assoc()) {
    
    $prodcode= $row['prodcode'];
    $category = $row['category'];
    $brand= $row['brand'];
    $proddesc= $row['proddesc'];
    $size= $row['size'];
    $PONum = $_SESSION['PONum'];
    $_SESSION['prodcode'] = $prodcode;
    $_SESSION['category'] = $category;
    $_SESSION['brand'] = $brand;
    $_SESSION['proddesc'] = $proddesc;
    $_SESSION['size'] = $size;

    echo "<label>" . $prodcode . "</label><br>";
    echo "<label>" . $category . "</label><br>";
    echo "<label>" . $brand . "</label><br>";
    echo "<label>" . $proddesc . "</label><br>";
    echo "<label>" . $size . "</label><br>";
    echo "<input type = 'number' name = 'quantity'  value = 'quantity'>";
    }
}
 

#please add these error checking codes
else if (isset($_POST['search']) &&($search_result->num_rows == 0)){
echo '<script language="javascript">';
echo 'alert("Invalid Search Parameter. Please Try Again")';
echo '</script>';
}

if(isset($_POST['add']) && $_POST['add']){    
    $quantity = $_POST['quantity'];
    $_SESSION['quantity'] = $quantity;

    $PurchaseOrderQuery = "INSERT INTO temporarypurchasing (PONum, ProductCode, Category, Brand, ProductDesc, Size, QuantitytobeOrdered)
    VALUES('". $_SESSION['PONum']."', '". $_SESSION['prodcode']."','". $_SESSION['category']."', '". $_SESSION['brand']."', '". $_SESSION['proddesc']."','". $_SESSION['size']."','". $_SESSION['quantity']."')";
    if(mysqli_query($con,$PurchaseOrderQuery)){
        header("message=Successfully added new records");  
            }
    else{
        header("message=Error in adding the record");
            }

    echo    "<table >";

    echo    "<tr>";
    echo        "<th>Product Code</th>";
    echo        "<th>Category</th>";
    echo        "<th>Brand</th>";
    echo        "<th>Description</th>";
    echo        "<th>Size</th>";
    echo        "<th>Quantity</th>";
    echo        "<th>Quantity to be Ordered</th>";
    echo    "</tr>";

    $viewDetailsQuery = "SELECT * FROM temporarypurchasing";
    $result = $con->query($viewDetailsQuery);
    if ($result->num_rows > 0) {
    // output data of each row
    // gets variables from table
        while($row = $result->fetch_assoc()) {
            echo "\t<tr><td >" . $row['ProductCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProductDesc'] . "</td><td>" . $row['Size'] . "</td><td>" .  $row['QuantitytobeOrdered'] . "</td></tr>\n";
        }
    } else { echo "0 results"; }
    echo "</table >";    
    echo "<input type = 'submit' name = 'submit'  value = 'submit' formaction = 'processPurchasing.php'>";
    }



    if(isset($_POST['submit'])){
        $refreshQuery = " DELETE FROM temporarypurchasing";
        if(mysqli_query($con,$refreshQuery)){
            header("location:purchase_orders.php");
            session_unset(); 
			session_destroy();

                }
        else{
            header("location:purchase_orders.php");
                }
    }
?>

</form>
</body>

</html>