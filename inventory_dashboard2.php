<html>
<head>
</head>
<body>
    <?php 
       if(isset($_POST['discontinued']))
       {
    require_once("connection.php");
    session_start();
    $Lowstock = $_SESSION['LSCount'];
    $Discontinued = $_SESSION['DCount'];
       }


    ?>
    <form method = "post">
    <input type = "submit" name = "lowstock"  value = " Low Quantity Products <?php echo $Lowstock?>" formaction = "inventory_dashboard1.php"  >
    <input type = "submit" name = "discontinued"  value = "Discontinued Products <?php echo $Discontinued?>">
    
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


$viewTop = "SELECT * FROM products WHERE status = 'Discontinued'";
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