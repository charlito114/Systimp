<?php
/*
 * Connection to MongoDB
 * 
 * $connection = new MongoClient(); // connects to localhost:27017
 * 
 * For remote host connection
 * 
 * $connection = new MongoClient( "mongodb://example.com" ); // connect to a remote host (default port: 27017)
 * $connection = new MongoClient( "mongodb://example.com:65432" ); // connect to a remote host at a given port
 * 
 * Connection using database username and password
 * 
 * $connectionUrl = sprintf('mongodb://%s:%d/%s', $host, $port, $database);
 * $connection = new Mongo($connectionUrl, array('username' => $username, 'password' => $password));
 * 
 * */
 
	$dbhost = 'localhost';
	$dbport = '27017';
	$dbname = 'jansy';
	$c_users = 'products';
	$temptable = 'temporaryproducts';
    $conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");

  /*  $filter = ["category" => "pvc blue"];
$option = [];
// select data in descending order from table/collection "users"
$read = new MongoDB\Driver\Query($filter, $option);
$result = $conn->executeQuery("$dbname.$c_users", $read);

*/


?>

<<!--html>
<head></head>
<body>
<table>
<tr>
<th> Product Code </th>
<th> Category </th>
<th> Brand </th>
</tr> -->
<?php
/*foreach ($result as $res) {
		echo "<tr>";
		echo "<td>".$res->prodcode."</td>";
		echo "<td>".$res->category."</td>";
        echo "<td>".$res->brand."</td>";	
        echo "</tr>";

	}*/
	?>
<!--</table>
</body>
</html>-->






    


