<?php 
   
    require("inc/connection.php");
    header('Content-Type: application/json');

        if(isset($_POST['comments']))
        {
            $userId=$_POST['userId'];
            $newsId=$_POST['newsId'];
            $comments=$_POST['comments'];
            $username=$_POST['username'];

            $query="insert into Comment(userId,newsId,date,text,username)values('$userId','$newsId',datetime('now', 'localtime'),'$comments','$username')";
            $stmt=$db->prepare($query);
            $stmt->execute();
        }

  
?>