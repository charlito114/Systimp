<html>
<head>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>

</head>
<body>
    <form method="post">
    Select Report Date: <input type="date" name="date">
    <input type="submit" name = "submit">
    </form>

    <?php 
    session_start();
    require_once("connection.php");
    if (isset($_POST['submit']))
    { 
        $tempdate = $_POST['date'];
        $date = date('Y-m-d', strtotime($tempdate));
        $query = "SELECT * FROM inventoryreport WHERE date = '$date'";
        $search_result = filterTable($query);

    }
        else {
            $date = date('Y-m-d');
          //  echo $date;
            $query = "SELECT * FROM inventoryreport WHERE date LIKE '$date' ";
            $search_result = filterTable($query);
        }


        function filterTable($query)
        {
            $con = mysqli_connect("localhost", "root", "", "inventory");
            $filter_Result = mysqli_query($con, $query);
            return $filter_Result;
        }
        

    ?>
 
 <button onclick = "printContent('report')"> Print </button> 
    <div id = "report"> 
    <label> Jansy Commercial </label><br>
    <label> 528A T. Alonzo St., Sta. Cruz Manila </label><br>
    <label> Tel: 554 15 89 | Tel Fax: 554 15 87  </label><br>
    <label> Email: jansycommercial@yahoo.com </label><br>
    <br>

        <table  >
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Product Code</th>
            <th>Description</th>
            <th>Size</th>
            <th>Reorder Point</th>
            <th>Stocks Available</th>
        </tr>

        <?php

        if ($search_result->num_rows > 0) {
            // output data of each row

            while($row = $search_result->fetch_assoc()) {
                echo "\t<tr><td >" . $row['date'] . "</td><td>" . $row['category'] . "</td><td>"  .  $row['brand'] . "</td><td>" . $row['prodcode'] . "</td><td>" . $row['proddesc'] . "</td><td>" . $row['size'] . "</td><td>" . $row['repoint'] . "</td><td>" . $row['prodquan'] .    "</td></tr>\n";
                }
            } 
            
            #please add these error checking codes
            else {
                $alert = mysqli_error($con);
                echo '<script type="text/javascript">';
                echo 'alert("'.$alert.'")';
                echo '</script>';  
            }

        ?>
        </table>
    </div>
    
    </body>
    </html>