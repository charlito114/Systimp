<?php 
require_once("db/connection.php");
if(isset($_POST['submit']))

{
    session_start();
    $SONum= $_SESSION['SONum'];
    $updatevalue = $_POST['updatevalue'];
    $valueToSearch = $_POST['submit'] ;
    $statusquery = "UPDATE salesorderdetails 
                    SET ProdQuan = '".$updatevalue."'
                    WHERE ProdCode = $valueToSearch  AND SONum = $SONum";
    if(mysqli_query($con,$statusquery)){
        $alert = "Successfully updated purchase order!";
        echo $alert;
        echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';  
            header("location:view_pending_so.php?message=Successfully Updated Sales Order");

            
            
                    }
        else{
            $alert = mysqli_error($con);
            echo $alert;
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';  
            header("location:view_pending_so.php?message=Error in updating Sales order");
            
            
        }
        
}
?>