<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/blogController.php");?>
<link href="http://localhost/our3/public/css/clean-blog.min.css" rel="stylesheet">
<script src="http://localhost/our3/public/js/ajax_validation.js"></script>

<?php

	$row;
	$c;
	
	if(isset($_GET["id"]))
	{
		$row=$controller->get_blog($_GET['id']);
		$c=$controller->get_comment($_GET['id']);
	}
	else
	{
		redirect("http://localhost/our3/app/view/blogs.php");
	}
	
?>
<?php
	if($row["writer_Handle"]==$_COOKIE['user_handle'])
	{
?>
<div class="container" style="text-align:right">
	<form action="edit_blog.php" method="POST">
			<button type="submit" name="edit" value=<?php echo $_GET["id"];?> class="btn btn-danger" >Edit</button>
	</form>
</div>
<?php
	}
?>



    <header class="intro-header" style="background-image: url('http://localhost/our3/public/img/back_groun.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1><?php echo $row["title"];?></h1>
                        <h2 class="subheading"><?php echo $row["about"];?></h2>
                        <span class="meta">Posted by <a href=<?php echo "user_info.php?handle={$row["writer_Handle"]}"?>><?php echo $row["writer_Handle"];?></a> on <?php echo $row["date"]; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                  <?php echo $row["content"]; ?>
				  <br><br>
				  <?php
				  
					$t=$controller->get_blog_tags($_GET['id']);
					$T="Tags : ";
					while($v=mysqli_fetch_assoc($t))
					{
						$T.="<span class='meta'><a href='blogs.php?search={$v['tag_name']}'>{$v['tag_name']}</a></span>&nbsp&nbsp";
					}
					if($T!="Tags : ")
					echo $T;
				  ?>
				  
				  
				  <hr>
				  <form id="form" name="form" method="post">
					<div class="well">
						<h4>Leave a Comment:</h4>
						<form name="form" role="form">
							<div class="form-group">
								<textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
								<textarea  name="id"   hidden=""><?php echo $_GET["id"];?></textarea>
								<h6 style="color:RED;"id="v_comment"></h6>
							</div>
							<button id="SUBT" type="button"  class="btn btn-primary" onclick="comment_validation()">Comment</button>
						</form>
					</div>
				</form>
				<hr>
				
				<div class="comments">
				<?php 
					while($row=mysqli_fetch_assoc($c)){
						
						
				?>
					<div class="media">
						<a class="pull-left" href=<?php echo "user_info.php?handle={$row["writer_Handle"]}"?>>
							<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" width="64px" height="64px">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><a href=<?php echo "user_info.php?handle={$row["writer_Handle"]}"?>><?php echo $row["writer_Handle"];?></a>
								<small><?php echo $row["date"];?></small>
							</h4>
							<?php echo $row["content"];?><br>
							
							
							<div id=<?php echo $row['comment_id'];?>>

							<?php
								$re=$controller->get_reply($row['comment_id']);
								while($r=mysqli_fetch_array($re))
								{
									
									
							?>
								<div class="media">
									<a class="pull-left" href="#">
										<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" width="64px" height="64px">
									</a>
									<div class="media-body">
										<h4 class="media-heading"><a href=<?php echo "user_info.php?handle={$r["writer_Handle"]}"?>><?php echo $r["writer_Handle"];?></a>
											<small><?php echo $r["date"];?></small>
										</h4>
										<?php echo $r["content"];?><br>
									</div>
								</div>
							<?php
								 
								}
							?>
							</div>
							
					
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							<button type='button' class='btn btn-link' data-toggle='modal' data-target='.bs-example-modal-sm' 
								
								data-content2=<?php echo $row['comment_id'];?>
								
								>Reply</button>
			
						</div>
					</div>
				<?php 
			
					}
				?>
				</div>
				<hr>
                </div>
            </div>
        </div>
    </article>



	
	
	
	
	
	
	
	
	
<div class="modal fade bs-example-modal-sm" id="reply_model"tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<div class="modal-body">
        <form name="Rform" method="POST">
		   <div class="well tcenter">  
			  <div class="form-group">
				<label for="message-text" class="control-label">Message:</label>
				<textarea class="form-control" rows="10" name="reply" id="message-text" placeholder="Enter Reply" required></textarea>
				<h6 style="color:RED;"id="v_reply"></h6>
				<input rows="10" name="comment_id" value="" id="message-text" hidden=""></input>
				
			  </div>
			   </div>
			   <button type="button" name='submit'class="btn btn-primary" onclick="reply_validation()" value="Reply" >Reply</button>
				
        </form>
      </div>
    </div>
  </div>
</div>
 	

<script>
$('.bs-example-modal-sm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  
  var modal = $(this)
  modal.find('.modal-body input').val(button.data('content2'))
})

</script>



