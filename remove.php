<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$id = $_POST['remove'];

$update = new MongoDB\Driver\BulkWrite();
$update->update(
    ['_id' => new MongoDB\BSON\ObjectId($id)],
    ['$set' => ['status' => 'unavailable']]
);

$result = $conn->executeBulkWrite("$dbname.$c_users", $update);


//redirecting to the display page (index.php in our case)
header("Location:inventory.php");
?>
