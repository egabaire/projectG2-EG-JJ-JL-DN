
	<?php
		session_start();
		include("inc/header.php");

	?>	
		<div id="content">
			<?php
				$query="SELECT * FROM News WHERE category='education'";
				$statement=$db->prepare($query);
				$statement->execute();
				$color="black";

				while($result=$statement->fetch())
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


		
