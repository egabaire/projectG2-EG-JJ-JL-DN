<?php

    if(isset($_GET['q']))
    {
        $newsId=$_GET['q'];
        require("inc/connection.php");
        $sql="select rating from News where newsId='$newsId'";
        $stmt=$db->prepare($sql);
        $stmt->execute();

        while($result=$stmt->fetch())
        {
            echo "<div id='like'><h3>{$result['rating']}</h3></div>";
           
        }

    }

?>