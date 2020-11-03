<?php 
	include("connection.php");
	include("inc/functions.php");
	
	if(isset($_POST['login1'])=='Login')
	{

		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = "select * from users where username='$username'";
		$stmt = $db->prepare($query);
		$stmt->execute();

		if(empty($username))
		{
			header("location.php");
		}


		while($result = $stmt->fetch())
		{
			if(password_verify($password,$result['password']))
			{
				$_SESSION['username']=$result['username'];
				alert("You are logged in now");
			}

			else
			{
				alert("The username or password is wrong!");
			}

		}
	}

	else if(isset($_POST['login2'])=='Login')
	{
		header("location:login.php");
	}

	else if(isset($_POST['signup1'])=='Signup')
	{
		header("Location:signup.php");
	}
	
?>
<!doctype html5>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="js/searchSuggestion.js"></script>
		<link rel="stylesheet" href="style/header.css">
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="style/news.css">
		<link rel="stylesheet" href="style/home.css">
		<link rel="stylesheet" href="style/profile.css">
		<script src="js/script.js" defer></script>
		<title>Project Group2</title>
	</head>
	
	<body onload="onLoadPage()">
		<div id="header">
			<div id="logo">
				<h4><a href="home.php">G2 Project</a></h4>
			</div>
			<div id="search">
				<input class="searchbox" type="text" onClick="searchSuggestion()" placeholder="Search for users or news" name="search2" id="search2">
				<div id="here"></div>
			</div>
			<div id="userInfo">
				<div class="userDesktop">
					<?php
						if(isset($_SESSION['username']))
						{
							$activeUser=$_SESSION['username'];
							$query = "select * from users where username='$activeUser'";
							$stmt = $db->prepare($query);
							$stmt->execute();

							while($result=$stmt->fetch())
							{
								echo"
								<div class='userLoggedin'>
										
									<div>
										<h4>{$result['username']}</h4>
									</div>

									<div class='profilepic'>
										<img src='{$result['picture']}' alt='profilepic'/>
									</div>

									<div>
										<a href='profile.php?userId=$loggedInId'>Profile</a>
									</div>

									<div>
										<a href='.\logout.php'>Logout</a>
									</div>

								</div>
										
								";
							}
						}

						else
						{
							echo"
								<form action='' method='post'>
									<input id='loginUsername' type='text'  name='username' required>
									<input id='loginPassword' type='password' name='password' required>
									<input id='login1' type='submit' name='login1' value='Login'>
									<input id='loginMobile' type='submit' name='login2' value='Login'>
									<input type='submit' name='signup1' value='Signup'>
								</form>";
						}
					
					?>
				</div>
				
			</div>
		</div>
		
		<nav class="navLinksVerticalMobile">	
			<ul class="nav-links">
				<li><a href="home.php">Home</a></li>
				<li><a href="following.php">Following</a></li>
				<li><a href="sport.php">Sport</a></li>
				<li><a href="gaming.php">Gaming</a></li>
				<li><a href="politic.php">Politics</a></li>
				<li><a href="education.php">Education</a></li>
				<li><a href="aboutus.php">About us</a></li>
				<li><a href="archive.php">Archive</a></li>
			</ul>
			<div class="burger">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>
			
		</nav>
