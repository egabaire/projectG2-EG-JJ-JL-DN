
	<?php
		session_start();
		include("inc/header.php");

		$id="";

        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
		}
		
		if(isset($_POST['Update'])=='Update')
		{
			$title=$_POST['title'];
			$content=$_POST['comment'];
			$item=$_POST['item'];

			 //Update news
			 $updateQuery="UPDATE News set title='$title', content='$content', category='$item', postDate=datetime('now', 'localtime') where newsId='$id'";
			 $statement=$db->prepare($updateQuery);
			 $result=$statement->execute();

			 if($result===true)
			 {
				alert("The post updated successfully!");
			 }


		}

		else if(isset($_POST['Delete'])=='Delete')
		{
			//Delete news
			$updateQuery="Delete from News where newsId='$id'";
			$statement=$db->prepare($updateQuery);
			$result=$statement->execute();

			if($result===true)
			{
				alert("The post deleted successfully!");
				
			}
			
		}

	?>	
		<div id="content">
		<?php 
			$query="select * from News where newsId='$id'";
			$stmt=$db->prepare($query);
			$stmt->execute();

			while($row=$stmt->fetch())
			{?>

				<div class="editInformation">
					<h4>Below you can edit/delete your post</h4>
					<p>Please concider that you can not change the photo.</p>
					<p>Type everything correctly then click on update/delete.</p>
				</div>
				<div class="writePost">
						<form id="form" method="POST" enctype="multipart/form-data">
						<input type="text" name="title" placeholder="write a title..." id="title" value="<?= $row['title'] ?>">
						   <textarea name="comment" rows="10" cols="20" id="comment"><?= $row['content'] ?></textarea>
						   
						<div class="category_label">
						<?php
								$sql="select * from Categorys";
								$stmt=$db->prepare($sql);
								$stmt->execute();

								echo "<label id='category'>Categories</label><select id='select' name='item'>";
								while($result=$stmt->fetch())
								{?>
									<option value="<?= $result['category']?>" <?php
										if($result['category']==$row['category'])
										{
											echo 'selected';
											} 
										?>
									><?= $result['category']?></option>
									
								<?php } ?>

								</select>
						</div>

						<input type="submit" style="background:#adff6a" name="Update" value="Update" id="submit">
						<input type="submit" style="background:#ff5c53; color:white;" name="Delete" value="Delete" id="submit">	
					</form>
				</div>

			<?php } ?>
            
    </div>

	<?php
		include("inc/footer.php");
	?>


		
