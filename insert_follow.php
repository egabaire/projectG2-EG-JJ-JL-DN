<?php
    $db = new SQLite3('db/databas.db');
    include("inc/functions.php");
    header('Content-Type: application/json');


    if(isset($_POST['userId']))
    {
        $userId=$_POST['userId'];
        $follows=$_POST['follows'];

        $count = $db->querySingle("SELECT COUNT(*) as count FROM Follow where userId='$userId' AND follows='$follows'");

        if($count>0)
        {
            $query="delete from Follow where userId='$userId' and follows='$follows'";
            $stmt=$db->prepare($query);
            $stmt->execute();
        }

        if($count==0)
        {
            $query="INSERT INTO Follow(userId, follows) VALUES('$userId','$follows')";

            $stmt=$db->prepare($query);
            $stmt->execute();
        }

    }


?>