
	<?php
		session_start();
		include("inc/header.php");

		if(isset($_POST['submit']))
		{
			$title=$_POST['title'];
			$content=$_POST['comment'];
			$item=$_POST['item'];

			 //saving news image in news directory
			 $file_name=$_FILES['file']['name'];
			 $file_type=$_FILES['file']['type'];
			 $file_size=$_FILES['file']['size'];
			 $file_tem_loc=$_FILES['file']['tmp_name'];
			 $file_store="img/news/".$file_name;
			 move_uploaded_file($file_tem_loc, $file_store);
					 
			 //move adress to database
			 $sql="INSERT INTO News(title, image, content, category, userId, postDate, rating) 
			 		VALUES('$title', '$file_store', '$content', '$item','$loggedInId',datetime('now', 'localtime'), '0')";
			 $stmt=$db->prepare($sql);
			 $result=$stmt->execute();
			
			if($result===true)
			{
				echo"<script>alert('The post submitted successfully!');</script>";
			}

		}



	?>	
		<div id="content">
			<?php if(isset($_SESSION['username'])) { ?>
				
				<div class="writePost">
						<form id="form" method="POST" enctype="multipart/form-data">
						<div class="userPost"><label style="font-size:1.2vw;" class="lblPost">Create Post</label>
						<?php $userPicture=$db1->querySingle("select picture from Users where username='$username'");
								echo "<img class='picture' src='$userPicture'/>";
						?>
						</div>
							<div><input type="text" name="title" placeholder="Title for the new post" id="title">
						   	<textarea name="comment" rows="10" cols="20" id="comment" placeholder="Content of the new post..."></textarea></div>
						   
						<div class="category_label">
							<?php
								$sql="select * from Categorys";
								$stmt=$db->prepare($sql);
								$stmt->execute();

								echo "<label id='category'>Categories</label><select id='select' name='item'>";
								while($result=$stmt->fetch())
								{
									echo "<option value='{$result['category']}'>{$result['category']}</option>";
									
								}

								echo "</select>";
							?>
								<input type="file" name="file" id="fileToUpload">
						</div>
						<div><input type="submit" name="submit" value="Post" id="submit"></div>
						
					</form>
				</div>

			<?php } ?>

			<?php
				$count = $db1->querySingle("SELECT COUNT(*) as count FROM News WHERE   postDate >= datetime('now','-1 day') order by rating DESC limit 10");
				$query="SELECT * FROM News WHERE   postDate >= datetime('now','-1 day') order by rating DESC limit 10";
				$statement=$db->prepare($query);
				$statement->execute();
				$color="black";?>

				<div><h3>Top last 24 hours</h3>
				
				<?php if($count==0)
				{
					echo "<p>Nobody has posted the last 24 hours</p>";
				}?>

				</div>

				<?php while($result=$statement->fetch())
				{ ?>
					<?php $post_username = $db1->querySingle("select username from Users where id='{$result['userId']}'");?>
					<div class="totalNews">
						<?php $isAdmin = $db1->querySingle("select admin from Users where username='{$username}'"); ?>
						<div class="newsImages">
							<div class='images1'><img src="<?=$result['image']?>"/></div>
						</div>

						<div class="newsContents">
							<div><h3><?=$result['title']?></h3></div>
							<div><p><?= substr_replace($result['content'], "...", 100) ?></p></div>
							<div><a style="color:black" href="news.php?q=<?php echo $result['newsId'];?>"><h2>Read more</h2></a></div>
							
							<div class="author">
								<div><p>Author: <?php echo $post_username; ?></p></div>
								<div><p>Total likes (<?= $result['rating'] ?>)</p></div>	
								<div><p>Category: <?php echo $result['category']; ?></p></div>
								<?php if($isAdmin=='1') {?>
									<div><a href="edit_post.php?id=<?php echo $result['newsId'] ?>" style="color:black;"><h4>Edit</h4></a></div>
								<?php } ?>
							</div>
						</div>
					</div>
					
			<?php } ?>
		</div>
		
	<?php
		include("inc/footer.php");
	?>


		
