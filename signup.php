<?php 
    session_start();
    include("inc/connection.php");
    include("inc/functions.php");
	
    if(isset($_POST['createAcc']))
    {
        //fullname, username, password, email
        $username=$_POST['username'];
        $password=$_POST['password'];
        $email=$_POST['email'];

        //saving profilepic in profile directory
        $file_name=$_FILES['file']['name'];
        $file_type=$_FILES['file']['type'];
        $file_size=$_FILES['file']['size'];
        $file_tem_loc=$_FILES['file']['tmp_name'];
        $file_store="img/profileImages/".$file_name;
        move_uploaded_file($file_tem_loc, $file_store);

        if($_FILES['file']['error'] > 0)
        {
            $file_store="img/profileImages/admin.png";
        }

        //Hash the password
         $password= password_hash($password, PASSWORD_DEFAULT);

        //move adress to database
        $sql="INSERT INTO users(username,password,email, picture)VALUES('$username', '$password', '$email', '$file_store')";
        $stmt=$db->prepare($sql);
        $result=$stmt->execute();

        if($result===true)
        {
            $_SESSION['username']=$username;
            alert("Your registration is successfully done");
           
        }
        
		
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="style/signUpStyle.css">
</head>
<body>
  
     <div class="container">
        <div class="logo">
            <img src="img/log.png" alt="logo">
    
        </div>
        <div class="title">
            <h1>
                Sign Up
             </h1>
        </div>    
       

         <div class="signUpForm">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="Username"><b>Username</b></label>
                <input type="text" id="Username" placeholder="" name="username" required>
                <br>
        
                <label for="Email"><b>Email</b></label>
                <input type="text" id="Email" placeholder="" name="email" required>
                <br>
                <label for="Password"><b>Password</b></label>
                <input type="password" id="Password" placeholder="" name="password" required>
                <br>
                <label for="fileToUpload"><strong>select profile picture</strong></label>
                <br>
                <input type="file" name="file" id="fileToUpload">
				<br>
                <label for="createAcc"><strong>Create Account</strong></label>
				<br>
                <input type="submit" value="submit" name="createAcc">
            </form>
          
            
         </div>


     </div>
</body>
</html>
