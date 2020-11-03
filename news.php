<?php
        session_start();
        include("inc/header.php");
        $db1 = new SQLite3('db/databas.db');

       $id="";
        if(isset($_GET['q']))
        {
            $id=$_GET['q'];
        }

        $user_id="";

        $query="select Users.username, News.postDate, News.rating, News.newsId, News.image, News.title, News.content from News
                join Users on Users.id=News.userId where News.newsId='$id'";
        $query1="select id from Users where username='$username'";
        $stmt=$db->prepare($query);
        $stmt1=$db->prepare($query1);
        $stmt->execute();
        $stmt1->execute();

        while($result=$stmt1->fetch())
        {
            $user_id=$result['id'];
        }

	?>	
		<div id="content"> 
        <?php
                $color="";
                $count = $db1->querySingle("SELECT COUNT(*) as count FROM likes where newsId='$id' AND userId='$user_id'");

                if($count>0)
                {
                    $color="green";
                }

                else
                {
                    $color="black";
                }

                while($result=$stmt->fetch())
                { ?>

                    <div class="first">
                        <div class="left">
                           <div class="image"><img src="<?=$result['image']?>" alt="image"/></div>
                            <div class="like">
            
                                <form method="POST" name="form">
                                    <input type='hidden' name='newsId' value='<?=$id?>' id='newsId'>
                                   <input type='hidden' name='user_id' value='<?=$user_id?>' id='user_id'>
                                    <div class='styleLikeButton'>

                                    
                                    <?php if(isset($_SESSION['username'])) { ?>
                                        <button type="button" onclick="changeColor()" name="submit1" id="submit1"><i class="fa fa-thumbs-up"  value="<?=$color?>"  id="thumb" style="font-size:200%; color:<?=$color?>; "></i></button>
                                    <?php } 
                                        
                                    else { ?> 
                                        <button type='button' onclick='message()'> <i class='fa fa-thumbs-up' id='thumb' style='font-size:200%'></i></button>

                                    <?php } ?>
                                   

                                        <div id='like'></div>
                                    </div>
                                </form>
                            </div>
                         </div>
                
                
                        <div class='right'>
                            <h4><?=$result['title']?></h4>
                            <p><?=$result['content']?></p>
                            <div class="date"><h4><?=$result['username']?></h4>
                            <p><?=$result['postDate']?></p></div>
                        </div>
                    </div>
                
               <?php }  ?>


           
           <div class="second">
             <form method="post" name="form">
                <input type="hidden" name="userId" value="<?php echo $user_id ?>" id="userId">
                <input type="hidden" name="newsId" value="<?php echo $id ?>" id="newsId">
                <input type="hidden" name="username" value="<?php echo $username ?>" id="username">
                <?php if(isset($_SESSION['username'])) { ?>
                    <textarea name="comments" rows="10" cols="20" id="comments" placeholder="Write a comment..."></textarea>
                    <input type="button" name="submit" value="Submit" id="submit">
                <?php }

                else { ?>
                    <textarea rows="10" id="comments" cols="20" placeholder="Write a comment..."></textarea>
                    <input type="button" onclick="message()" value="Submit">
                <?php } ?>

            </form>
           </div>

           <div id="display_comments"></div>
		   
		   
		</div>
        <script src="js/like.js"></script>
        <script src="js/comments.js"></script>
        <script type='text/javascript' src="js/changeColor.js"></script>
			
	<?php
		include("inc/footer.php");
	?>


