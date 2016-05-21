<?php  require_once("menu.php");  ?>
<?php  require_once("conn.php");  ?>
<style>hr { background-color: black; height: 1px; border: 0; }
.black-background {background-color:#000000;}
.white {color:#ffffff;}
</style>



<?php
	
	$p=1;$ar=0;$result;
	if(isset($_GET['page']))$p=$_GET['page'];
	function GET_blogs()
	{
		global $db;global $next;global $p;global $ar;global $result;
		$query="SELECT * FROM blog WHERE writer_Handle='{$_GET["handle"]}' ORDER BY blog_id DESC";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		else 
		{
			$x=0;
			$ar=mysqli_num_rows($result);
			if($ar==0)
			{
				echo "<h4 style='color:red;'><p style='text-align:center'>There is No blogs Found</p></h4>";
				return;
			}
			while($x<($p-1)*5&&$row=mysqli_fetch_array($result))$x++;
			if($x==$ar)
			{
				redirect("user_blogs.php?handle={$_GET['handle']}");
			}
		}
	}
	if(isset($_GET["handle"]))
	{
		GET_blogs();
	}
	else
	{
		Redirect("index.php");
	}
?>


<div class="container" id="page-content">
      <div class="row-fluid">
      <ul class="nav nav-tabs" id="contest_nav">
			  <li><a href=<?php echo "user_info.php?handle=".$_GET['handle'];?>>Information</a></li>
			  <li class="active"><a href=<?php echo "user_blogs.php?handle=".$_GET['handle'];?>>Blogs</a></li>
			  <li><a href=<?php echo "user_team.php?handle=".$_COOKIE["user_handle"];?>>Teams</a></li>
			  <li><a href=<?php echo "user_mail.php?handle=".$_COOKIE["user_handle"];?>>Mails</a></li>
			  <li><a href=<?php echo "user_edit.php?handle=".$_COOKIE["user_handle"];?>>Edit</a></li>
      </ul>
	</div>
	<br>
</div>



<body>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
			
				<?php
					$x=0;
					while($x<5&&$row=mysqli_fetch_assoc($result))
					{
						$x++;
						$query="SELECT * FROM blog_tag where blog_id={$row['blog_id']}";
						$res=mysqli_query($db,$query);
						if(!$res)
						{
							die("query failed "." ".mysqli_error($db)); 
						}
				
				?>
				

				<h3><span class="label label-default"><?php echo $row["title"];?></span></h3>
				<?php if(mysqli_num_rows($res)!=0)
				{
				?>
					<h3><span class="label label-danger">Tags</span> : 
					<?php
						while($r=mysqli_fetch_assoc($res))
						{
							echo "<a href='blogs.php?search={$r['tag_name']}' class='btn btn-primary black-background white' role='button'>{$r['tag_name']}</a>";
						}
					?>
				

					
					<br><br>
					
				<?php
				}?>
				
                <p class="lead">
                    by <a href="#"><?php echo $row["writer_Handle"]; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row["date"]; ?></p>
				<p><?php 
			
				echo $row["content"]; ?><p>
				<br><br>
                <a class="btn btn-primary" href="blog.php?id=<?php echo $row["blog_id"]; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                <?php
					}
				?>

                <!-- Pager -->
				<?php if($ar!=0){?>
                <ul class="pager">
				
					<?php $N=max(1,$p-1);?>
					
                    <li class="previous">
                        <a href="user_blogs.php?page=<?php echo $N."&handle={$_GET["handle"]}";?>">&larr; Newer</a>
                    </li>
					
					<?php $N=min(ceil($ar/5.000000),$p+1);?>
					
                    <li class="next">
                        <a href="user_blogs.php?page=<?php echo $N."&handle={$_GET["handle"]}";?>">Older &rarr;</a>
                    </li>
                </ul>
				<?php }?>

            </div>
        </div>
        

    </div>
  
</body>


