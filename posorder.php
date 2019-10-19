<?php
session_start();
require_once("connection.php");

    $SONum = $_SESSION ['SONum']; 
    $invoiceNum = $_SESSION ['invoiceNum']; 

    echo "<label> SO Number: " . $SONum . "</label><br>"; 
    echo "<label> Invoice Number: " . $invoiceNum . "</label><br>";

    echo    "<table >";

    echo    "<tr>";
    echo        "<th>Product Code</th>";
    echo        "<th>Category</th>";
    echo        "<th>Brand</th>";
    echo        "<th>Description</th>";
    echo        "<th>Size</th>";
    echo        "<th>Quantity</th>";
    echo        "<th>Total Price</th>";
    echo    "</tr>";

    

    $viewDetailsQuery = "SELECT * FROM temporaryinvoice";
    $result2 = $con->query($viewDetailsQuery);
    if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo "<form method = 'post' action = '' >";
        echo "\t<tr><td >" .  $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>" . $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" .  $row['QuantityIssued'] . "</td><td>" .  $row['Price'] . " </td></tr><br>";
        echo "</form>";
        }
    } 
    echo    "</table ><br>";  

    
    $SubtotalQuery = "SELECT SUM(Price) AS Subtotal FROM temporaryinvoice";
    $Subtotalresult =  $con->query($SubtotalQuery);
        if ($Subtotalresult->num_rows > 0) {
            // output data of each row
            while($row = $Subtotalresult->fetch_assoc()) {
                $Subtotal= $row['Subtotal'];
                echo "Subtotal: " .  $Subtotal . "<br>";
                }
            } else {
                echo "0 results";
                }
        $VAT = $Subtotal * 0.12; 
        echo "12% VAT: " .  $VAT . "<br>";
        $Total = $Subtotal + $VAT; 
        echo "Total: " .  $Total . "<br>";


?>

<html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
#voidModal, #qtyModal, #truncateModal, #addModal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.bigmodal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 70%;
}

.smallmodal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

/* The Close Button */
.close1, .close2, .close3, .close4 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close1:hover,
.close1:focus, .close2:hover, .close2:focus, .close3:hover, .close3:focus, .close4:hover, .close4:focus  {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
</head>

<body>
<!-- Modal for voiding an item -->
<button id="voidBtn">Void Item</button>
<div id="voidModal" class="modal">
  <div class="smallmodal-content">
    <span class="close1">&times;</span>
    <form method = "post" action = "processvoiditem.php"> 
    <label>Product Code: </label><input type = "number" name= prodcode><br>
    <label>Password: </label><input type = "password" name= password><br>
    <button type = "submit" name = "submit"> Submit </button>
    </form>
  </div>
</div>

<!-- Modal for voiding the whole sale -->
<button id="truncateBtn">Void Sale</button>
<div id="truncateModal" class="modal">
  <div class="smallmodal-content">
    <span class="close2">&times;</span>
    <form method = "post" action = "processTruncate.php"> 
    <label>Please request for manager approval </label><br>
    <label>Password: </label><input type = "password" name= password><br>
    <button type = "submit" name = "submit"> Submit </button>
    </form>
  </div>
</div>
<br>

<!-- Modal for changing the quantity -->
<button id="qtyBtn">Change Quantity</button>
<div id="qtyModal" class="modal">
  <div class="smallmodal-content">
    <span class="close3">&times;</span>
    <form method = "post" action = "processchangequan.php"> 
    <label>Change Item Quantity<label><br>
    <label>Product Code: </label><input type = "number" name= prodcode><br>
    <label>Quantity: </label><input type = "number" name= newQty><br>
    <button type = "submit" name = "submitqty"> Submit </button>
    </form>
  </div>
</div>

<!-- Modal for changing the quantity -->
<button id="addBtn">Add Products</button>
<div id="addModal" class="modal">
  <div class="bigmodal-content">
    <span class="close4">&times;</span>
    <form method = "post" action = "processposadd.php"> 
    <label>Add Products<label><br>
    <label>Product Code: </label><input type = "number" name= prodcode><br>
    <label>Quantity: </label><input type = "number" name= newQty><br><br>
    <label>Sales Order Product Details<label>
    <table> 
      <tr>
        <td> Product Code </td>
        <td> Category </td>
        <td> Brand </td>
        <td> Product Description </td>
        <td> Size </td>
        <td> Quantity Ordered </td>
        <td> Quantity Available </td>
        <td> Quantity Issued </td>
      </tr>


    <?php 
     $viewDetailsQuery = "SELECT * FROM salesorderdetails WHERE SONum = $SONum";
     $result = $con->query($viewDetailsQuery);
     if ($result->num_rows > 0) {
     // output data of each row
     // gets variables from table
         while($row = $result->fetch_assoc()) {
             echo    "<form method = 'post' >"; 
             echo "\t<tr><td >" . $row['ProdCode'] . "</td><td>" . $row['Category'] . "</td><td>"  .  $row['Brand'] . "</td><td>" . $row['ProdDesc'] . "</td><td>" . $row['Size'] . "</td><td>" .  $row['ProdQuan'] . "</td><td>" .  $row['Available'] . "</td><td>" .  $row['Issued'] ."</td></tr><br>";
             echo    "</form >"; 
 
         }
      }
    ?>
    </table>
    <button type = "submit" name = "submit"> Submit </button>
    </form>
  </div>
</div>


<script>
// Get the modal
var modal = document.getElementById("voidModal");
var modal2 = document.getElementById("qtyModal");
var modal3 = document.getElementById("truncateModal");
var modal4 = document.getElementById("addModal");



// Get the button that opens the modal
var btn = document.getElementById("voidBtn");
var btn2 = document.getElementById("qtyBtn");
var btn3 = document.getElementById("truncateBtn");
var btn4 = document.getElementById("addBtn");



// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];
var span2 = document.getElementsByClassName("close2")[0];
var span3 = document.getElementsByClassName("close3")[0];
var span4 = document.getElementsByClassName("close4")[0];


// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

btn2.onclick = function() {
  modal2.style.display = "block";
}

btn3.onclick = function() {
  modal3.style.display = "block";
}

btn4.onclick = function() {
  modal4.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  
}

span2.onclick = function() {
  modal2.style.display = "none";
}

span3.onclick = function() {
  modal3.style.display = "none";
}

span4.onclick = function() {
  modal4.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  else if (event.target == modal2) {
    modal2.style.display = "none";
  }

  else  if (event.target == modal3) {
    modal3.style.display = "none";
  }

  else if (event.target == modal4) {
    modal4.style.display = "none";
  }
}
</script>



</body>
</html> 