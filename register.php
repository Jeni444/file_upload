<?php
session_start();

$connect=mysqli_connect("localhost","root","","machinetest");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) 
{
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $_POST["email"];

    // Check if the username is unique
    $stmt = mysqli_query($connect,"SELECT id FROM user WHERE username = $username");
    if(mysqli_num_rows($stmt)>0)
    {
        $r=  mysqli_fetch_row($stmt);
   
        echo "Username is already taken. Please choose a different username.";
    }
     else {
        // Insert new user into the database
        $stmt = mysqli_query($connect,"INSERT INTO user VALUES('','$username','$password','$email')");
        
        echo "Registration successful. You can now log in.";
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
		<h1>User Registration</h1>
		<div class="w3-agileits-info">
			<form class='form animate-form' id='form1' action="register.php"   method="post">
				<p class="w3agileits">Register Here</p>
				<div class='form-group has-feedback w3ls'>
					<label class='control-label sr-only' for='username'>Username</label> 
					<input class='form-control' id='username' name='username' placeholder='Username' type='text'>
					
				</div>
				
				<div class='form-group has-feedback agile'>
					<label class='control-label sr-only' for='password'>Password</label> 
					<input class='form-control w3l' id='password' name='password' placeholder='Password' type='password'>
				</div>

                <div class='form-group has-feedback wthree'>
					<label class='control-label sr-only' for='email'>Email address</label> 
					<input class='form-control' id='email' name='email' placeholder='Email address' type='text'>
				</div>
				<div class='submit w3-agile'>
					<input class='btn btn-lg' type='submit'  name="register" value='SUBMIT'>
				</div>
			</form>
		</div>	
	</div>	
	<!-- //agileits -->
	<!-- copyright -->
	<div class="w3-agile-copyright">
    <div class='submit w3-agile'>
    <a href="login.php" class="button-link">
    <button type="button">login</button>
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