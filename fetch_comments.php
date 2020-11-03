<?php 
        require("inc/connection.php");

        $newsId="";
        if(isset($_GET['newsId']))
        {
            $newsId=$_GET['newsId'];
        }

        $sql="SELECT * FROM Comment where newsId='$newsId' ORDER BY commentId DESC";
        $stmt=$db->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch())
        {
            echo "<div class='third'>";
                echo "<h4>" . $row['username'] . "</h4>";
                echo "<p>" . $row['text'] . "</p>";
                echo "<h4>" . $row['date'] . "</h4>";
            echo "</div>";
         }
?>

<!doctype html5>
<html>
    <head>
         <link rel="stylesheet" href="style/news.css">
    </head>

</html>