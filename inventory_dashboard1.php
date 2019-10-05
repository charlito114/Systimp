<html>
<head>
</head>
<body>
    <?php 
    require_once("connection.php");
    session_start();
    $LSQuery = ("SELECT count(prodcode) AS LSCount FROM products  WHERE prodquan < repoint");
    $LSResult =  $con->query($LSQuery);
    if ($LSResult->num_rows > 0) {
        // output data of each row
        while($row = $LSResult->fetch_assoc()) {
            $Lowstock= $row['LSCount'];
            $_SESSION['LSCount'] = $Lowstock;
            
            }
        } else {
            echo "0 results";
            }

    $DCQuery = ("SELECT count(prodcode) AS DCount FROM products  WHERE status = 'Discontinued' ");
    $DCResult =  $con->query($DCQuery);
    if ($DCResult->num_rows > 0) {
        // output data of each row
        while($row = $DCResult->fetch_assoc()) {
            $Discontinued= $row['DCount'];
            $_SESSION['DCount'] = $Discontinued;
            
            }
        } else {
            echo "0 results";
            }


    ?>
    <form method = "post">
    <input type = "submit" name = "lowstock"  value = " Low Quantity Products <?php echo $_SESSION['LSCount']?>"  >
    <input type = "submit" name = "discontinued"  value = "Discontinued Products <?php echo $_SESSION['DCount']?>" formaction = "inventory_dashboard2.php">
    
    </form>

<table>
<tr>
        <th>Product Code</th>
        <th>Category</th>
		<th>Brand</th>
		<th>Description</th>
		<th>Size</th>
		<th>Quantity</th>
        <th>Reorder Point</th>
    </tr>


<?php


$viewTop = "SELECT * FROM products WHERE prodquan < repoint";
$search_result = mysqli_query($con, $viewTop);
if ($search_result->num_rows > 0) {
    // output data of each row

    while($row = $search_result->fetch_assoc()) {
        echo "\t<tr><td >" . $row['prodcode'] . "</td><td>" . $row['category'] . "</td><td>"  .  $row['brand'] . "</td><td>" . $row['proddesc'] . "</td><td>" . $row['size'] . "</td><td>" . $row['prodquan'] . "</td><td>" . $row['repoint']  ."</td></tr><br>";
        }
    }
else{
    echo "0 results";
}
?>
</table>
</body>
</html> 