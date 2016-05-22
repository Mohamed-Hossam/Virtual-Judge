<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/contestsController.php");?>

<?php 
	$p=$controller->page;
	$ar=$controller->all_results;
	$next=$controller->next_url;
	$result=$controller->contests;
?>
<link href=<?php echo $host.'/public/css/table.css';?> rel="stylesheet">
<script>
	  $(function() {
		$( "#contest" ).autocomplete({
		  source: '../auto_complete/contest.php'
		});
	  });
	  
	   $(function() {
		$( "#user" ).autocomplete({
		  source: '../auto_complete/user.php'
		});
	  });
</script>


<div class="container">
  <form class="form-inline" role="form" action="contest.php" method="get">
		<div class="form-group">
		  
			<input type="text" class="form-control" name="Fcontest"  
			<?php if(isset($_GET["Fcontest"])){
			
				echo'value="'.$_GET['Fcontest'].'"';
			}?>
			 value=""placeholder="Enter Contest Name" id='contest'>
			
			<input type="text" class="form-control" name="Fuser"  
			<?php if(isset($_GET["Fuser"])){
			
				echo'value="'.$_GET['Fuser'].'"';
			}?>
			value=""placeholder="Enter Creator Name" id='user'>
			
			
		  
			<select class="form-control" name="status">
				  <option value='All'selected="true">All</option>
                  <option value='Coming'>Coming</option>
                  <option value='Running'>Running</option>
                  <option value='Passed'>Passed</option>
			</select>
		    
			
			<select class="form-control" name="Access">
					<option value="All"selected="true">All</option>
					<option value="public">Public</option>
					<option value="private">Private</option>
            </select>
		  
		</div>
		<button type="submit" class="btn btn-info">Filter</button>
  </form>
</div>














 
<div class="container">
  <ul class="pagination">
  
    
	<?php if($p!=1){?>
    <li><a  href=<?php echo $next."1"; ?>>First</a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">First</a></li>
	<?php }?>

	<?php if($p!=1){?>
    <li ><a href=<?php$p--; echo $next."{$p}"; $p++;?>><?php echo "<-Prev";?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo "<-Prev";?></a></li>
	<?php }?>
	
	<?php if(($p-1)*20<$ar){?>
    <li class="active"><a  href=<?php $p+=0;echo $next."{$p}";$p-=0; ?>><?php echo $p+0;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+0;?></a></li>
	<?php }?>
	
	<?php if(($p)*20<$ar){?>
    <li><a href=<?php $p+=1;echo $next."{$p}";$p-=1; ?>><?php echo $p+1;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+1;?></a></li>
	<?php }?>
	
	<?php if(($p+1)*20<$ar){?>
    <li><a href=<?php $p+=2;echo $next."{$p}";$p-=2; ?>><?php echo $p+2;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+2;?></a></li>
	<?php }?>
	
	<?php if(($p+2)*20<$ar){?>
    <li><a href=<?php $p+=3;echo $next."{$p}";$p-=3; ?>><?php echo $p+3;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+3;?></a></li>
	<?php }?>
	
	<?php if(($p+3)*20<$ar){?>
    <li><a href=<?php $p+=4;echo $next."{$p}";$p-=4; ?>><?php echo $p+4;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+4;?></a></li>
	<?php }?>
	
	<?php if(($p)*20<$ar){?>
    <li><a href=<?php $p+=1;echo $next."{$p}";$p-=1; ?>>Next-></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">Next-></a></li>
	<?php }?>
	
	<?php if(ceil($ar/20.000)!=$p&&$ar!=0){?>
    <li><a href=<?php $x=ceil($ar/20.000);echo $next."{$x}"; ?>>Last</a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">Last</a></li>
	<?php }?>
	
  </ul>
</div>
</body>
</html>






<div class="container">      
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Creator</th>
        <th>CID</th>
		<th>Name</th>
		<th>Start Time</th>
		<th>End Time</th>
		<th>Status</th>
		<th>Access</th>
      </tr>
    </thead>
    <tbody>
      
	  
	<?php
	
		$x=0;
		$color=array("Coming"=>"BLUE","Running"=>"RED","Passed"=>"GREEN","public"=>"BLUE","private"=>"RED");
		while($row=mysqli_fetch_assoc($result))
		{	
			$x++;$y;
			$t=time();
			if($row["start"]>$t)$y="Coming";
			if($row["start"]<=$t&&$row["end"]>=$t)$y="Running";
			if($row["end"]<$t)$y="Passed";
			$url="contest_info.php?id={$row["contest_id"]}";
			
	?>  
		  </tr>
		   <tr>
			<td><a href="#"><?php echo $row["creator_Handle"];?></a></td>
			<td><a href=<?php echo $url;?>><?php echo $row["contest_id"];?></a></td> 
			<td><a href=<?php echo $url;?>><?php echo $row["name"];?></a></td> 			
			<td><?php echo date("d-m-Y h:iA",$row["start"]);?></td>
			<td><?php echo date("d-m-Y h:iA",$row["end"]);?></td>
			<td><p style="color:<?php echo$color[$y]; ?>;"><?php echo $y;?></p></td>
			<td><p style="color:<?php echo$color[$row["type"]]; ?>;"><?php echo $row["type"];?></p></td>
		  </tr>
	<?php }?>
      
    </tbody>
  </table>
</div>
<?php if($x==0)echo "<h4 style='color:red;'><p style='text-align:center'><strong>No Contests Found</strong></p></h4>"; ?>

</body>
</html>


