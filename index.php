<?php 

include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
    
    $sql = "SELECT id FROM trial WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);
    
  
      
    if($count == 1) {
       session_register("myusername");
       $_SESSION['login_user'] = $myusername;
       
       header("location: welcome.php");
    }else {
       $error = "Your Login Name or Password is invalid";
    }
 }
?>


<html>
<head>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body background = "background.png">

<div class = "header">
<header> JANSY COMMERCIAL </header>
</div>

<div class="container">
    <form method="post" action="">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <label> Username </label>
                <input type="text" class="textbox" id="txt_uname" name="username" placeholder="Username" />
            </div>
            <div>
                <label> Password </label>
                <input type="password" class="textbox" id="txt_uname" name="password" placeholder="Password"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit" />
            </div>
        </div>
    </form>
</div>

</body>
</html>