<?php 
error_reporting(0);
session_start();
require_once("connection.php");
if(isset($_POST['submitvoid'])){
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
        $deleteQuery = "DELETE FROM temporaryinvoice";
                                if(mysqli_query($con,$deleteQuery)){
                                  //  $message = "Successfully voided item";
                                 //   header("location:pos.php?message=".$message);
                                 $_SESSION['Subtotal']=0;
                                 $_SESSION['discount']=0;
                                 $_SESSION['Total']=0;

                                 $message = "Sales Order Successfully Voided";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";
                    
                                    //header("location:pos.php?message=success");//dapat may alert na successfully voided item, please try again
                                        }
                                else{

                                    $message = "Error in voiding Sales Order";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";
                                 //   $message = "Error in voiding item please try again";
                                  //  header("location:pos.php?message=".$message);
                                   //header("location:pos.php?message=ERROR"); //dapat may alert na error in voiding item, please try again
                                        }
                                    }
    else{

        $message = "Incorrect Password";
echo "<script type='text/javascript'>alert('$message');";
echo "window.location.href='pos.php'</script>";
       // $message = "Error in voiding item, please try again";
       // header("location:pos.php?message=".$message);
        //header("location:pos.php"); //dapat may alert na error in voiding item, please try again
    }
            ?>