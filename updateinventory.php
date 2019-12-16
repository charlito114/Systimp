<?php

 require_once("config.php");
 session_start();

        
if (isset($_POST['add']))
{

    $order = $_POST['quantity'];
    $filter = ["prodcode" => $_SESSION['prodcode']];
    $option = [];
    // select data in descending order from table/collection "users"
    $read = new MongoDB\Driver\Query($filter, $option);
    $result = $conn->executeQuery("$dbname.$c_users", $read);
    $id= 0;
    $updatedquan = 0;
    foreach ($result as $res) {
       

        if($res->prodquan< $order)	{
            header("location:order_add_order2.php?message= Invalid Quantity. Please try again.");

        }
     
        else{
        
        $id = $res->_id;
        echo $id;
        $res->category;
        $res->brand;	
        $res->proddesc;	
        $res->size;	
        $res->prodquan;	
        $res->status;	
        $newquan = ($res->prodquan) - $order;
        $updatedquan =floatval($newquan);
        }
    }
    

    $update = new MongoDB\Driver\BulkWrite();
    $update->update(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => ['prodquan' => ($updatedquan)]]
    );
    
    $result1 = $conn->executeBulkWrite("$dbname.$c_users", $update);

}
?>