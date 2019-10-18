<?php

$con = mysqli_connect('localhost','root','','inventory');

if (!$con)
{
	die('Please Check Connection!'.mysqli_error());
}

?>