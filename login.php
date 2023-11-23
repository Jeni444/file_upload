<?php
session_start();

$connect=mysqli_connect("localhost","root","","machinetest");




// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user information from the database
    $sql = mysqli_query($connect,"SELECT username, password FROM user WHERE username = '$username'");
 
    
        $row= mysqli_fetch_array($sql);
   
        $num=mysqli_num_rows($sql);


        if ($username && password_verify($password, $row['password'])) {
            $_SESSION['user_id']= $row['username'];
            header("Location: upload.php"); // Redirect to the user dashboard
            exit();
        } else {
            echo "Invalid username or password. Please try again.";
        }
    }

?>























<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Animated Login Form Flat Responsive Widget Template :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Animated Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free Web Designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->

<style>
.button-link {
    text-decoration: none;
}

.button-link button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}


</style>
<link href='css/bootstrap.min.css' media='all' rel='stylesheet'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/animate.min.css"> 
<!-- //Custom Theme files -->
<!-- web font -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'><!--web font-->
<!-- //web font --> 
</head>
<body>
	<!-- main-agileits -->
	<div class="agileits">
		<h1>Login</h1>
		<div class="w3-agileits-info">
			<form class='form animate-form' id='form1' action="login.php"   method="post">
				<p class="w3agileits">Login</p>
				<div class='form-group has-feedback w3ls'>
					<label class='control-label sr-only' for='username'>Username</label> 
					<input class='form-control' id='username' name='username' placeholder='Username' type='text'>
					
				</div>
				
				<div class='form-group has-feedback w3ls'>
					<label class='control-label sr-only' for='password'>password</label> 
					<input class='form-control' id='password' name='password' placeholder='password' type='text'>
					
				</div>
               
				<div class='submit w3-agile'>
					<input class='btn btn-lg' type='submit'  name="login" value="Login"'>
				</div>
			</form>
		</div>	
	</div>	
	<!-- //agileits -->
	<!-- copyright -->
	<div class="w3-agile-copyright">
    <div class='submit w3-agile'>
    <a href="upload.php" class="button-link">
    <button type="button">upload</button>
</a>

				</div>
	</div>
	<!-- //copyright -->  
	<!-- js -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src='js/jquery.validate.min.js'></script>
	<script src='js/formAnimation.js'></script>
	<script src='js/shake.js'></script> 
	<!-- //js -->
</body>
</html>


</body>
</html>