<?php 
error_reporting(0);
session_start();
require_once("connection.php");
if(isset($_POST['submit'])){
    $prodcode =$_POST['prodcode'];
    $inputpw =$_POST['password'];
    $pwQuery = ("SELECT Password FROM users WHERE Email = 'janelle.sy@gmail.com'");
    $result =  $con->query($pwQuery);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $password= $row['Password'];
                }
            } else {
                echo "0 results";
                }
            }
    if($inputpw == $password){
        $deleteQuery = " DELETE FROM temporaryinvoice WHERE ProdCode = $prodcode ";
                                if(mysqli_query($con,$deleteQuery)){
                                    echo '<script language="javascript">';
                                    echo 'alert("Successfully voided item please try again")';
                                    echo '</script>';
                                    include("pos.php");
                                    //header("location:pos.php");//dapat may alert na successfully voided item, please try again
                                        }
                                else{
                                    echo '<script language="javascript">';
                                    echo 'alert("Error in voiding item, please try again")';
                                    echo '</script>';
                                    include("pos.php");
                                    //header("location:pos.php"); //dapat may alert na error in voiding item, please try again
                                        }
                                    }
    else{
        echo '<script language="javascript">';
        echo 'alert("Error in voiding item, please try again")';
        echo '</script>';
        include("pos.php");
        //header("location:pos.php"); //dapat may alert na error in voiding item, please try again

    }   
    
            ?>
