<?php
    $db = new SQLite3('db/databas.db');
    include("inc/functions.php");
    header('Content-Type: application/json');
   

    if(isset($_POST['newsId']))
    {
        $newsId=$_POST['newsId'];
        $user_id=$_POST['user_id'];
        
        $count = $db->querySingle("SELECT COUNT(*) as count FROM likes where newsId='$newsId' AND userId='$user_id'");
        
        if($count>0)
        {
            $query="UPDATE News set rating=rating-1 where newsId='$newsId'";
            $stmt=$db->prepare($query);
            $stmt->execute();

            $query1="DELETE FROM likes where userId='$user_id'";
            $stmt1=$db->prepare($query1);
            $stmt1->execute();
        }

        else
        {
            $query="UPDATE News set rating=rating+1 where newsId='$newsId'";
            $stmt=$db->prepare($query);
            $stmt->execute();

            $query1="INSERT INTO likes(newsId, userId) VALUES('$newsId','$user_id')";
            $stmt1=$db->prepare($query1);
            $stmt1->execute();
        }

    }

    

  

 

    

    
?>