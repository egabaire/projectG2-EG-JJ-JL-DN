<?php 
    include("inc/connection.php");
?>
<!doctype html5>
<html>
    <head>
        <title>Archive</title>
        <link rel="stylesheet" href="style/archive.css">
    </head>

    <body>
  	
        <div id="container">
            <?php 

                $query="select * from News where category='sport'";
                $stmt=$db->prepare($query);
                $stmt->execute(); 
                echo '<div id="sprt">';
                echo"<h1>Sport</h1>";
                while($result=$stmt->fetch())
                {
                    echo "<a href='news.php?q={$result['newsId']}'>{$result['title']}</a></br></br>";
                }
                echo '</div>';
							
               

                $query="select * from News where category='gaming'";
                $stmt=$db->prepare($query);
                $stmt->execute();
                echo '<div id="gmng">';
                echo"<h1>Gaming</h1>";
                while($result=$stmt->fetch())
                {
                    echo "<a href='news.php?q={$result['newsId']}'>{$result['title']}</a></br></br>";
                }
                echo '</div>';
                

                $query="select * from News where category='politics'";
                $stmt=$db->prepare($query);
                $stmt->execute();
                
                echo '<div id="pltcs">';
                echo"<h1>Politics</h1>";
                while($result=$stmt->fetch())
                {
                    echo "<a href='news.php?q={$result['newsId']}'>{$result['title']}</a></br></br>";
                }
                echo '</div>';
               

                $query="select * from News where category='education'";
                $stmt=$db->prepare($query);
                $stmt->execute();
                echo '<div id="edctn">';
                echo"<h1>Education</h1>";
                while($result=$stmt->fetch())
                {
                    echo "<a href='news.php?q={$result['newsId']}'>{$result['title']}</a></br></br>";
                }
                echo '</div>';
            
               
               
                
            ?>
        </div>
    </body>

</html>