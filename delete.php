<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$id = $_POST['remove'];

$delete = new MongoDB\Driver\BulkWrite();
$delete->delete(
    ['_id' => new MongoDB\BSON\ObjectId($id)],
    ['limit' => 0]
);

$result = $conn->executeBulkWrite("$dbname.$temptable", $delete);


//redirecting to the display page (index.php in our case)
header("Location:inventory_add_product.php");
?>

