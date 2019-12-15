<?php

 require_once("config.php");
 

        
if (isset($_POST['submit']))
{

    $filter = [];
    $option = [];
    // select data in descending order from table/collection "users"
    $read = new MongoDB\Driver\Query($filter, $option);
    $result = $conn->executeQuery("$dbname.$temporder", $read);
    foreach ($result as $res) {
        $id= $res->_id;
        $res->category;
        $res->brand;	
       $res->proddesc;	
       $res->size;	
       $res->prodquan;	
       $res->order;
       $newquan = ($res->prodquan) - ($res->order);
       $updatedquan =floatval($newquan);
    echo $updatedquan;
       $update = new MongoDB\Driver\BulkWrite();
       $update->update(
           ['_id' => new MongoDB\BSON\ObjectId($id)],
           ['$set' => ['prodquan' => ($updatedquan)]]
       );
       
       $result1 = $conn->executeBulkWrite("$dbname.$c_users", $update);

      
    }
 

    $single_insert = new MongoDB\Driver\BulkWrite();
        $single_insert->delete(array());
        $conn->executeBulkWrite("$dbname.$temporder", $single_insert);

   // header("Location:inventory.php");

}
?>