<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/problemsController.php");?>

<?php 

	$p=$controller->page;
	$ar=$controller->all_results;
	$next=$controller->next_url;
	$result=$controller->problems;
	$res=$controller->category;
	
?>
<head>
	
    <link href=<?php echo $host.'/public/css/table.css';?> rel="stylesheet">
    <script>
		  $(function() {
			$( "#problem_search" ).autocomplete({
			  source: '../auto_complete/problem_search.php'
			});
		  });
		  
		   $(function() {
			$( "#source" ).autocomplete({
			  source: '../auto_complete/source.php'
			});
		  });
	</script>
</head>
<div class="container">
  <form class="form-inline" role="form" action="problems.php" method="get">
		<div class="form-group">
		  
			<input type="text" class="form-control" name="Fproblrm"  
			<?php if(isset($_GET["Fproblrm"])){
			
				echo'value="'.$_GET['Fproblrm'].'"';
			}?>
			 value=""placeholder="Search for problem" id='problem_search'>
			
			<input type="text" class="form-control" name="Fsource"  
			<?php if(isset($_GET["Fsource"])){
			
				echo'value="'.$_GET['Fsource'].'"';
			}?>
			value=""placeholder="Search for Source" id='source'>
			
			
			<select class='form-control' name='OJ'>
			<?php 
			
				if(!isset($_GET['OJ']))
				{
					echo "<option value='All'selected='true'>All</option>
					<option value='CodeForces'>CodeForces</option>
					<option value='Uva'>Uva</option>
					<option value='UvaLive'>UvaLive</option>
					<option value='Spoj'>Spoj</option>";
				}
				else
				{
					if($_GET['OJ']==='All')echo "<option value='All' selected='true'>All</option>";
					else echo "<option value='All'>All</option>";
					
					if($_GET['OJ']==='CodeForces')echo "<option value='CodeForces' selected='true'>CodeForces</option>";
					else echo "<option value='CodeForces'>CodeForces</option>";
					
					if($_GET['OJ']==='Uva')echo "<option value='Uva' selected='true'>Uva</option>";
					else echo "<option value='Uva'>Uva</option>";
					
					if($_GET['OJ']==='UvaLive')echo "<option value='UvaLive' selected='true'>UvaLive</option>";
					else echo "<option value='UvaLive'>UvaLive</option>";
					
					if($_GET['OJ']==='Spoj')echo "<option value='Spoj' selected='true'>Spoj</option>";
					else echo "<option value='Spoj'>Spoj</option>";
				}
					
				
			
			?>
			
			</select>
			
			
			
			
			<select class="form-control" name="cat">
				  <option value='All'selected="true">All</option>
				  <?php 
					
					While($r=mysqli_fetch_array($res))
					{
						if(isset($_GET["cat"]))
						{
							if($r[0]==$_GET["cat"])
							{
								if($r[1]<10)
								echo "<option value='{$r[0]}' selected='true'>(00{$r[1]}) {$r[0]} </option>";
								else
								if($r[1]<100)
								echo "<option value='{$r[0]}' selected='true'>(0{$r[1]}) {$r[0]} </option>";
								else
								echo "<option value='{$r[0]}' selected='true'>({$r[1]}) {$r[0]} </option>";
								continue;
							}
						}
						
							if($r[1]<10)
							echo "<option value='{$r[0]}'>(00{$r[1]}) {$r[0]} </option>";
							else
							if($r[1]<100)
							echo "<option value='{$r[0]}'>(0{$r[1]}) {$r[0]} </option>";
							else
							echo "<option value='{$r[0]}'>({$r[1]}) {$r[0]} </option>";
						
					}
					?>
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
    <li ><a href=<?php $p--; echo $next."{$p}"; $p++;?>><?php echo "«";?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo "«";?></a></li>
	<?php }?>
	
	<?php if(($p-1)*50<$ar){?>
    <li class="active"><a  href=<?php $p+=0;echo $next."{$p}";$p-=0; ?>><?php echo $p+0;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+0;?></a></li>
	<?php }?>
	
	<?php if(($p)*50<$ar){?>
    <li><a href=<?php $p+=1;echo $next."{$p}";$p-=1; ?>><?php echo $p+1;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+1;?></a></li>
	<?php }?>
	
	<?php if(($p+1)*50<$ar){?>
    <li><a href=<?php $p+=2;echo $next."{$p}";$p-=2; ?>><?php echo $p+2;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+2;?></a></li>
	<?php }?>
	
	<?php if(($p+2)*50<$ar){?>
    <li><a href=<?php $p+=3;echo $next."{$p}";$p-=3; ?>><?php echo $p+3;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+3;?></a></li>
	<?php }?>
	
	<?php if(($p+3)*50<$ar){?>
    <li><a href=<?php $p+=4;echo $next."{$p}";$p-=4; ?>><?php echo $p+4;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+4;?></a></li>
	<?php }?>
	
	<?php if(($p)*50<$ar){?>
    <li><a href=<?php $p+=1;echo $next."{$p}";$p-=1; ?>>»</a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">»</a></li>
	<?php }?>
	
	<?php if(ceil($ar/50.000)!=$p&&$ar!=0){?>
    <li><a href=<?php $x=ceil($ar/50.000);echo $next."{$x}"; ?>>Last</a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">Last</a></li>
	<?php }?>
</ul> 
   
</div>

		




<div class="container">      
  <table class="table table-striped" >
    <thead>
      <tr>
        <th>PID</th>
        <th>Name</th>
		<th>Ac</th>
		<th>All</th>
		<th>Judge Name</th>
		<th>VID</th>
		<th>Difficulty</th>
		<th>Origin Solved no.</th>
		<th>Original Source</th>
      </tr>
    </thead>
    <tbody>
    <?php
		$x=0;
		while($row=mysqli_fetch_assoc($result))
		{	
			$x++;
			$url="problem.php?id={$row["problem_id"]}";
			$AC=$controller->count_accepted_submission($row["problem_id"]);
			$ALL=$controller->count_all_submission($row["problem_id"]);
	?>  
		  </tr>
		   <tr>
			<td><a href=<?php echo $url;?>><?php echo $row["problem_id"];?></a></td>
			<td><a href=<?php echo $url;?>><?php echo $row["name"];?></a></td>
			
			<td><?php echo $AC;?></td>
			<td><?php echo $ALL;?></td>
			
			<td><?php echo $row["from_oj"];?></td>
			<td><a href=<?php echo $row["link"];?> target="_blank"><?php echo $row["id"];?></a></td> 
			
			<td><?php echo $row["difficulty"];?></td>
			<td><?php echo $row["solved_count"];?></td>
			<?php if(Strlen($row["source"])!=0)
				{?>
					<td><a href="#"><?php echo $row["source"];?></a></td>
				<?php
				}
				else
				{
				?>
					<td><a href="#">Unknown</a></td>
				<?php
				}
				?>
		  </tr>
	<?php }?>
	  
      
    </tbody>
  </table>
</div>
<?php if($x==0)echo "<h4 style='color:red;'><p style='text-align:center'><strong>No Problems Found</strong></p></h4>"; ?>

</body>
</html>
