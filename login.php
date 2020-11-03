<?php 
    session_start();
	include("inc/connection.php");
	include("inc/functions.php");
	
	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = "select * from users where username='$username'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		while($result = $stmt->fetch())
		{
			if(password_verify($password,$result['password']))
			{
				$_SESSION['username']=$result['username'];
				alert("You are logged in now.");
            }
            
            else
            {
                alert("Wrong password or username!");
            }
		}
	}
	
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="style/loginStyle.css">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="img/log.png" alt="logo">
        </div>
        <div class="title">
            <h1>
                Login
            </h1>
        </div>
        <div class="login">
            <form action="" method="post">

                <label for="Username"><b>Username</b></label>
                <input type="text" name="username" id="Username">
                <br>
                <label for="Password"><b>Password</b></label>
                <input type="password" name="password" id="Password">
                <br>
                <br>
                <br>
                <input type="submit" value="Login"name="login" id="login">

                
            </form>

        </div>
    </div>
</body>

</html>