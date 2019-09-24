<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php

session_unset(); 
session_destroy();
$alert = "You have successfully logged out!";
echo '<script type="text/javascript">';
echo 'alert("'.$alert.'")';
echo '</script>';
include("login.php");
?>

</body>
</html>