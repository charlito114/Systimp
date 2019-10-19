<?php
session_start();
require_once("connection.php");
//if(isset($_POST['checkout']))
//{
    $SONum = $_SESSION ['SONum']; 
    $date = date('Y-m-d');
    $_SESSION['date' ] = $date;
    echo "Date: " . $date . "<br>" ;
    $InvoiceQuery = ("SELECT count(invoiceNum) AS INVOICECOUNT FROM salesmanagement ");
    $result =  $con->query($InvoiceQuery);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $invoiceNum= $row['INVOICECOUNT'] +1 ;
            $_SESSION['invoiceNum'] = $invoiceNum;
            echo "Invoice Num: " .  $_SESSION['invoiceNum'] . "<br>";
            }
        } 
    else {
            echo "0 results";
        }
    $customerDetails = ("SELECT  customerName, address FROM ordermanagement WHERE SONUm = $SONum ");
    $result2 = $con->query($customerDetails);
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row = $result2->fetch_assoc()) {
            
            echo "Customer Name: " . $row['customerName']. "<br>";
            echo "Address: " . $row['address'] . "<br>";
            }
           
            // echo "</form>";
        } 
        else {
            echo "0 results";
            }
    echo "Sales Order Details: <br>";
    echo "<form method = 'post' action = '' >";
    echo    "<table >";
    echo    "<tr>";
    echo        "<th>Product Code</th>";
    echo        "<th>Category</th>";
    echo        "<th>Brand</th>";
    echo        "<th>Description</th>";
    echo        "<th>Size</th>";
    echo        "<th>Available</th>";
    echo       "<th>Quantity Ordered</th>";
    echo        "<th>Issued</th>";
    echo        "<th>Item Price</th>";
    echo        "<th>Total Price</th>";
    echo    "</tr>";

    $viewSODetails = ("SELECT  * FROM salesorderdetails WHERE SONUm = $SONum ");
    $result3 = $con->query($viewSODetails);
    if ($result3->num_rows > 0) {
        // output data of each row
        while($row = $result3->fetch_assoc()) {
            echo "\t<tr><td >" . $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Available'] . "</td><td>" . $row['ProdQuan'] . "</td><td>" . $row['Issued'] . "</td><td>" . $row['Price'] . "</td><td>" . $row['TotalPrice'] ."</td><td><button type = 'submit' name = 'addtocart'  value = '" . $row['ProdCode'] . "' > Add to Cart </button></td></tr><br>";
            }
           
            // echo "</form>";
        } 
       
    echo "</table >";
   
    echo   "</form>";
        
        if(isset($_POST['addtocart']))
            {

            $itemSelected =  $_POST['addtocart'];
            $selectDetails =  "SELECT * FROM salesorderdetails WHERE SONum = $SONum AND ProdCode = $itemSelected";
            $result = $con->query($selectDetails);
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $prodcode= $row['ProdCode'];
                $category = $row['Category'];
                $brand= $row['Brand'];
                $proddesc= $row['ProdDesc'];
                $size= $row['Size'];
                $prodquan= $row['ProdQuan'];
                $available= $row['Available']; //added this 
                $price= $row['Price'];
                $_SESSION['prodcode'] = $prodcode;
                $_SESSION['category'] = $category;
                $_SESSION['brand'] = $brand;
                $_SESSION['proddesc'] = $proddesc;
                $_SESSION['size'] = $size;
                $_SESSION['prodquan'] = $prodquan;
                $_SESSION['price '] = $price;
                $_SESSION['available'] = $available; //added this 




            }
        }
            else {
                echo "0 results";
            }
        

            echo "<form method = 'post' action = '' >";
            echo "<label>Product Code: </label> <input type = 'text' name = 'prodcode' value = $prodcode readonly><br>";
            echo "<label>Category: </label> <input type = 'text' name = 'category' value = $category readonly><br>";
            echo "<label>Brand: </label> <input type = 'text' name = 'brand' value = $brand readonly><br>";
            echo "<label>Product Description: </label> <input type = 'text' name = 'proddesc' value = $proddesc readonly><br>";
            echo "<label>Size: </label> <input type = 'text' name = 'size' value = $size readonly><br>";
            echo "<label>Quantity Issued </label> <input type = 'number' name = 'quantityIssued'><br>";
            echo "<input type = 'submit' name = 'add'  value = 'add' formaction = 'proceed_checkout.php'>";
            echo "<input type = 'submit' name = 'cancel'  value = 'cancel' formaction = 'proceed_checkout.php'>";
            echo "</form >";
            
            }

            
            if(isset($_POST['add'])){
                 $available= $_SESSION['available']; // added this 

                $quantityIssued = $_POST['quantityIssued'];
                $_SESSION['quantityIssued'] = $quantityIssued;
                $priceQuery= ("SELECT price FROM products WHERE prodcode = '".$_SESSION['prodcode']."' ");
                $price = mysqli_fetch_row(mysqli_query($con, $priceQuery));
                $totalPrice = $quantityIssued * $price[0];
                $_SESSION['totalPrice'] = $totalPrice;

                // edited from here
                if($_SESSION['prodquan'] >= $quantityIssued && $available >= $quantityIssued){
    
                $InvoiceDetailsQuery = "INSERT INTO temporaryinvoice (invoiceNum, SONum, ProdCode, Category, Brand, ProdDesc, Size, Available, Quantity, QuantityIssued, Price)
                --added available in both columns and values 

                VALUES ('". $_SESSION['invoiceNum']."','". $_SESSION['SONum']."', '". $_SESSION['prodcode']."', '". $_SESSION['category']."','". $_SESSION['brand']."','". $_SESSION['proddesc']."' ,'". $_SESSION['size']."',  '". $_SESSION['available']."', '". $_SESSION['prodquan']."' , '".$_SESSION['quantityIssued']."'  , '". $_SESSION['totalPrice']."'  )";

                    if(mysqli_query($con,$InvoiceDetailsQuery)){
                        $alert = "Successfully added new records!";
                        
                    }
                    else{
                        $alert = mysqli_error($con);
                        echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>';  
                    }

                }

                else{
                    $alert = "Exceeded expected quantity. Please try again!";
                    echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>';  
                }
               
               // up to here

            }


            echo    "<table >";

                echo    "<tr>";
                echo        "<th>Product Code</th>";
                echo        "<th>Category</th>";
                echo        "<th>Brand</th>";
                echo        "<th>Description</th>";
                echo        "<th>Size</th>";
                echo       "<th>Quantity Ordered</th>";
                echo        "<th>Quantity Issued</th>";
                echo        "<th>Total Price</th>";
                echo    "</tr>";

                
           
                $viewDetailsQuery = "SELECT * FROM temporaryinvoice";
                $result2 = $con->query($viewDetailsQuery);
                if ($result2->num_rows > 0) {
                // output data of each row
                while($row = $result2->fetch_assoc()) {
                    echo "<form method = 'post' action = '' >";
                    echo "\t<tr><td >" .  $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>" . $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" . $row['Quantity'] ."</td><td>" . $row['QuantityIssued'] . "</td><td>" .  $row['Price']  ."</td><td><button type = 'submit' name = 'remove'  value = '" . $row['ProdCode'] . "' > Remove </button></td></tr><br>";
                    echo "</form>";
                    }
                } 
                echo    "</table >";    
                

                
                if(isset($_POST['remove'])){
                    $deleteProd = $_POST['remove'];
                    $deleteQuery = " DELETE FROM temporaryinvoice WHERE prodcode = $deleteProd ";
                    if(mysqli_query($con,$deleteQuery)){
                        header("location:proceed_checkout.php");
                            }
                    else{
                        echo '<script type="text/javascript">';
                        echo 'alert("'.$alert.'")';
                        echo '</script>'; 
                            }
                }
            ?>

    <form method = "post" action = "">
    <input type = "submit" name = "submit"  value = "submit" formaction = "pos.php" > <!-- edited this -->
    <input type = "submit" name = "back"  value = "back" formaction = "" >
    </form>
    <?php 


     if(isset($_POST['back'])){
        
        $refreshQuery = "DELETE FROM temporaryinvoice";
        if(mysqli_query($con,$refreshQuery)){
            header("location:sales_orders.php");
            session_unset(); 
            session_destroy();

                }
        else{
            $alert = mysqli_error($con);
            echo '<script type="text/javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';    
                }
    }
    ?>
    </body>
    </html>
           
    


    

    

