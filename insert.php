<?php

 require_once("config.php");
 

        
if (isset($_POST['submit']))
{

    $filter = [];
    $option = [];
    // select data in descending order from table/collection "users"
    $read = new MongoDB\Driver\Query($filter, $option);
    $result = $conn->executeQuery("$dbname.$temptable", $read);
    foreach ($result as $res) {
      $res->category;
        $res->brand;	
       $res->proddesc;	
       $res->size;	
       $res->prodquan;	
       $res->repoint;
        $res->price;
        $single_insert = new MongoDB\Driver\BulkWrite();
        $single_insert->insert($res);
        $conn->executeBulkWrite("$dbname.$c_users", $single_insert);

      
    }
    $single_insert = new MongoDB\Driver\BulkWrite();
        $single_insert->delete(array());
        $conn->executeBulkWrite("$dbname.$temptable", $single_insert);

    header("Location:inventory_add_product.php");

}
?>
    