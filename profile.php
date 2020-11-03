<?php
	session_start();
	include("inc/header.php");
	$userId="";
	

	if(isset($_GET['userId']))
	{
		$userId=$_GET['userId'];
	}

	if(isset($_POST['yes'])=="yes")
	{
		$update=$db1->querySingle("update News set userId='-1' where userId='$userId'");
		$query="delete from Users where id='$userId'";
		$stmt=$db->prepare($query);
		$result=$stmt->execute();

		if($result===true)
		{
			alert("The user deleted successfully!");
		}
	}

		if(isset($_POST['no'])=="no")
		{
			header("Location:profile.php?userId=$userId");
		}

?>

	<div id="grid-container">
		<div id="profile-container">
			<div id="profile">
				<span id="circle">
				<?php 
					$query="select * from Users where id='$userId'";
					$stmt=$db->prepare($query);
					$stmt->execute();

					$text="";
					$color="";
					$count = $db1->querySingle("SELECT COUNT(*) as count FROM Follow where userId='$loggedInId' AND follows='$userId'");
	
					if($count>0)
					{
						$text="Unfollow";
						$color="red";
					}
	
					else
					{
						$text="Follow";
						$color="green";
					}

					while($users=$stmt->fetch()) {?>
						<img src="<?= $users['picture']?>">
						</span>
				
						<h1><?= $users['username']?></h1>
					<?php } ?>
			
				
				<form method="post">
					<input type='hidden' name='userId' value='<?=$loggedInId?>' id='userId'>
					<input type='hidden' name='follows' value='<?=$userId?>' id='follows'>
					<?php 
						if(isset($_SESSION['username']))
						{
							if($userId!=$loggedInId) {?>
								<button class="followBtn" name="followBtn" id="followBtn" style="background-color:<?php echo $color ?>"><?php echo $text ?></button>
								<?php } ?>
						<?php } ?>
						
				</form>
				
			</div>
		
			<div id="profile-panel">
				<button class="panelBtn" id="clickButton" onclick="showDiv('viewActivities')"><img src="img/icons/activities-icon.png" class="icon"><span class="btnText">View activities</span></button>
				<button class="panelBtn" onclick="showDiv('viewPosts')"><img src="img/icons/post-icon.png" class="icon"><span class="btnText">View posts</span></button>
				<button class="panelBtn" onclick="showDiv('viewFollowers')"><img src="img/icons/followers-icon.png" class="icon"><span class="btnText">Follows</span></button>
				<?php 
					$isAdmin = $db1->querySingle("select admin from Users where username='{$username}'");
					if($isAdmin=='1' && $loggedInId != $userId){?>
						<button class="panelBtn" onclick="showDiv('deleteUser')"><img src="img/icons/delete-icon.png" class="icon"><span class="btnText">Delete user</span></button>
					<?php } ?>
				
			</div>
		</div>
	
		<div id="activitiesContainer">

			<div id="viewActivities" class="activities">
				
				<!--Visa likes-->
				<?php 
					$count = $db1->querySingle("SELECT COUNT(*) as count, likes.userId, likes.newsId, News.title from likes
					join News on News.newsId=likes.newsId where likes.userId='$userId'");
					$query="select likes.userId, likes.newsId, News.title from likes
					join News on News.newsId=likes.newsId where likes.userId='$userId'";
					$statement=$db->prepare($query);
					$statement->execute(); ?>

					<?php if($count==0) {
						
						if($loggedInId == $userId)
						{
							echo "<p class='profileInformation' id='yourLatestLikes'>You have not liked anything yet.</p>";
						}

						else
							echo "<p class='profileInformation' id='yourLatestLikes'>The user has not liked a post yet.</p>";
					} ?>

					<?php while($result=$statement->fetch())
					{ ?>

						<div class="profileInformation" id="yourLatestLikes">
							<p>Liked <a href="news.php?q=<?php echo $result["newsId"] ?>" style="color:blue"><?php echo $result['title']?></a></p>
						</div>

					<?php } ?>

				<!--Visa Comments-->
				<?php 
				$count = $db1->querySingle("SELECT COUNT(*) as count from comment where userId='$userId'");
				$query="select News.title, Comment.userId, Comment.newsId, Comment.text 
				from Comment join News on Comment.newsId=News.newsId where Comment.userId='$userId'";
				$statement=$db->prepare($query);
				$statement->execute(); 
				
				if($count==0)
				{
					if($loggedInId == $userId)
					{
						echo "<p class='profileInformation' id='yourLatestComments'>You have not commented on any news yet.</p>";
					}
	
					else 
					{
						echo "<p class='profileInformation' id='yourLatestComments'>The user has not commented on any news yet.</p>";
					
					}
				}?>

				<?php while($result=$statement->fetch())
				{ ?>

					<div class="profileInformation" id="yourLatestComments">
						<p>Commented <?php echo $result['text'] ?> on <a href="news.php?q=<?php echo $result['newsId'] ?>" style="color:blue"><?php echo $result['title']?></a></p>
					</div>

				<?php } ?>

				
			</div>

			<div id="viewPosts" class="activities">
				<!--Visa Posts-->
				<?php 
				$count = $db1->querySingle("SELECT COUNT(*) as count FROM News where userId='$userId'");
				$query="select * from News where userId='$userId'";
				$statement=$db->prepare($query);
				$statement->execute(); ?>

					<?php if($count==0)
					{
						if($loggedInId == $userId)
						{
							echo "<p class'profileInformation' id='yourLatestPosts'>You have not posted yet.</p>";
						}
	
						else 
						{
							echo "<p class='profileInformation' id='yourLatestPosts'>The user has not posted yet.</p>";
					
						}

					} ?>

				<?php while($result=$statement->fetch())
				{ ?>					

					<div class="profileInformation" id="yourLatestPosts">
						<p>Created post as <a href="news.php?q=<?php echo $result['newsId'] ?>" style="color:blue"><?php echo $result['title']?></a></p>
					</div>

				<?php } ?>
			</div>


			<div id="viewFollowers" class="activities">
				<?php
					$count = $db1->querySingle("SELECT COUNT(*) as count, Users.username from Follow join 
					Users on Users.id=Follow.follows where userId='$userId'");
					$query="select Users.username, Users.id, Users.picture from Follow join 
					Users on Users.id=Follow.follows where userId='$userId'";
					$stmt=$db->prepare($query);
					$stmt->execute();

					if($count==0)
					{
						if($loggedInId == $userId)
						{
							echo "<p>You have not followed anybody yet.</p>";
						}
	
						else 
						{
							echo "<p>The user has not followed anybody yet.</p>";
					
						}

					} 

					while($row=$stmt->fetch())
					{
						echo "<div style='display:inline-block; margin-left:10px;'>
							<img style='height:40px;' src='{$row['picture']}'/>
						<a style='color:blue;' href='profile.php?userId={$row['id']}'><p>{$row['username']}</p></a></div>";
					}
				?>
			</div>
			
			
			<div id="deleteUser" class="activities">
				<div class="delete_confirmation">
					<h1>Delete user</h1>
					<h4>Are you sure you want to delete this user?</h4>
					<form class="form" method="post">
						<button id="deleteConfirm" type="submit" name="yes" value="yes">YES</button>
						<button type="submit" name="no" value="no">NO</button>
					</form>
				</div>
			</div>

		</div>

	</div>
	
	<script src="js/follow.js"></script>
	<script type='text/javascript' src="js/profile.js"></script>


<script>
	$('#followBtn').click(function() {
		location.reload();
	});
	
	var header = document.getElementById("profile-panel");
	var btns = header.getElementsByClassName("panelBtn");
	for (var i = 0; i < btns.length; i++) {
		btns[i].addEventListener("click", function() {
			var current = document.getElementsByClassName("active");
			if (current.length > 0) { 
				current[0].className = current[0].className.replace(" active", "");
			}
		this.className += " active";
		});
	}
	 var button = document.getElementById('clickButton');
	 button.click();
</script>



<?php 
	include("inc/footer.php");
?>