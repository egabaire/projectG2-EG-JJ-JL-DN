<?php
    
    include("inc/connection.php");
    if(!empty($_GET['q']))
	{
		$q=$_GET['q'];
		$sql="select * from News where title like '%$q%' ";
		$sql1="select * from Users where username like '%$q%' ";
		$stmt1= $db->prepare($sql1);
		$stmt= $db->prepare($sql);
		$stmt->execute();
		$stmt1->execute();
		
		while($output=$stmt->fetch())
		{
			echo "<div style='border-bottom:1px solid black; display:grid; grid-template-columns:auto auto; justify-content:start;'>
					<a href='news.php?q={$output['newsId']}'>".$output['title']."</a>
					<img src='img/icons/post-icon.png'/>
				</div>";
		}

		while($output=$stmt1->fetch())
		{
			if($output['id']>0)
			{
				echo "<div style='border-bottom:1px solid black; display:grid; grid-template-columns:auto auto; justify-content:start;'>
					<a href='profile.php?userId={$output['id']}'>".$output['username']."</a>
					<img src='img/icons/followers-icon.png'/>
				</div>";
			}
			
		}
		
	}

?>