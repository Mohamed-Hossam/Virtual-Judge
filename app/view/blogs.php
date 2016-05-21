<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/blogController.php");?>

<link href="http://localhost/our3/public/css/clean-blog.min.css" rel="stylesheet">

<?php


	$controller->get_blogs();
	
	$p=$controller->page;
	$ar=$controller->all_results;
	$next=$controller->next_url;
	$result=$controller->blogs;
	
?>

<style type="text/css">#search{-webkit-appearance:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;width:24px;padding:0 10px;height:24px;font-size:14px;color:#666;line-height:24px;border:0;border-radius:50px;box-shadow:0 0 0 1px rgba(0,150,200,.5),inset 0 2px 5px rgba(0,100,150,.3),0 2px 0 rgba(255,255,255,.6);position:relative;z-index:5;-webkit-transition:.3s ease;-moz-transition:.3s ease;}#search:focus{outline:none;width:180px;}p.s{z-index:4;position:relative;padding:5px;line-height:0;border-radius:100px;background:#b9ecfe;background-image:-webkit-linear-gradient(#dbf6ff,#b9ecfe);background-image:-moz-linear-gradient(#dbf6ff,#b9ecfe);display:inline-block;box-shadow:inset 0 1px 0 rgba(255,255,255,.6),0 2px 5px rgba(0,100,150,.4);}p.s:hover{box-shadow:inset 0 1px 0 rgba(255,255,255,.6),0 2px 3px 2px rgba(100,200,255,.5);}p.s:after{content:'';display:block;position:absolute;width:5px;height:20px;background:#b9ecfe;bottom:-10px;right:-3px;border-radius:0 0 5px 5px;-webkit-transform:rotate(-45deg);-moz-transform:rotate(-45deg);box-shadow:inset 0 -1px 0 rgbA(255,255,255,.6),-2px 2px 2px rgba(0,100,150,.4);}p.s:hover:after{box-shadow:inset 0 -1px 0 rgba(255,255,255,.6),-2px 2px 2px 1px rgba(100,200,255,.5);}</style>

<form method="GET">
<div class="container" style="text-align:right">
<p class="s" style='color:red;'>
<input name="search" id="search" type="search" placeholder="Search Blogs" required>
</p>
</div>
</form>

 <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<?php
					$x=0;
					while($row=mysqli_fetch_assoc($result))
					{
						$x++;
	
				
				?>
						<div class="post-preview">
							<a href="blog.php?id=<?php echo $row["blog_id"]; ?>";>
								<h2 class="post-title">
									<?php echo $row["title"];?>
								</h2>
								<h3 class="post-subtitle">
									<?php echo $row["about"];?>
								</h3>
							</a>
							<p class="post-meta">Posted by <a href=<?php echo "user_info.php?handle={$row["writer_Handle"]}"?>><?php echo $row["writer_Handle"];?></a> on <?php echo $row["date"]; ?></p>
						</div>
						<hr>
               
                <?php
					}
				?>
               
                
				<?php if($ar!=0){?>
                <ul class="pager">
				
					<?php $N=max(1,$p-1);?>
					
					<?php if($p!=1) {?>
                    <li class="previous">
                        <a href=<?php echo $next.$N;?>">&larr; Newer</a>
                    </li>
					<?php }?>
					<?php $N=min(ceil($ar/10.000000),$p+1);?>
					<?php if($p*10<$ar) {?>
                    <li class="next">
                        <a href=<?php echo $next.$N;?>">Older &rarr;</a>
                    </li>
					<?php }?>
                </ul>
				<?php }
				else 
					
				echo "<h4 style='color:red;'><p style='text-align:center'>No Blogs Found</p></h4>"; 

				
				?>
				
            </div>
        </div>
    </div>











			
			
			