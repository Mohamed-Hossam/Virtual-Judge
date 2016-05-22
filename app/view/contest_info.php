<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/contestController.php");?>
<?php

	if(!$info)
    redirect('http://localhost/our3/app/view/contest.php');
	if(isset($_GET['del'])&&$add_problem)
	{
		if(is_numeric($_GET['del']))
		{
			$controller->DELETE_PROBLEM();
		}
		redirect("http://localhost/our3/app/view/contest_info.php?id={$_GET['id']}");
	}

?>


<?php require_once('contest_menu.php');?>


<br><b>
<div class="container" id="page-content">
      
	<div class="span9" >
          <div class='inline'>
		  <div style="width: 10%; height: 10%; color: grey; float:left;">Contest Name:</div>
		  <div style="width: 90%; height: 10%; color: blue; float:right;"><?php echo $row['name'];?></div>
			</div><br><br>
          <div class="tcenter well">
		  <h4 style="text-align:center">
            Contest Start Time: <?php echo date("d/m/Y h:iA",$row['start']);?> &nbsp;&nbsp;&nbsp;&nbsp;
			Contest End Time: <?php echo date("d/m/Y h:iA",$row['end']);?>
			<br><br>
			<?php
				$t=time();
				if($row["start"]>$t)echo "<div style='color:Blue;'>Coming</div>";
				if($row["start"]<=$t&&$row["end"]>=$t)echo "<div style='color:red;'>Running</div>";
				if($row["end"]<$t)echo "<div style='color:Green;'>Passed</div>";
			?>
         </h4>
            <br />
		  </div>
	</div>
</div>

<h4 style="color:red;"><p style="text-align:center"><?php ; 
if(!$view_problem){echo "Problems is Hidden";exit;};
?></p></h4>

<head>
<link href=<?php echo $host.'/public/css/table.css';?> rel="stylesheet">
</head>
<div class="container">      
  <table class="table table-striped" >
    <thead>
      <tr>
		<th>#</th>
        <th>Problem</th>
		<?php if($add_problem)echo '<th></th>';?>
      </tr>
    </thead>
    <tbody>
    <?php
		$x=0;
		$result=$controller->get_problems();
		while($row=mysqli_fetch_assoc($result))
		{	
			$x++;
			$url="contest_problem.php?pid={$row["problem_id"]}&id={$_GET['id']}";
	?>  
		  </tr>
		   <tr>
			<td><a href=<?php echo $url;?>><?php echo $x;?></a></td>
			<td><a href=<?php echo $url;?>><?php echo $row["from_oj"].' - '.$row["id"].' - '.$row["name"];?></a></td>
			<?php if($add_problem)
			{?>
			<td>
				<a href=<?php echo "contest_info.php?id={$_GET['id']}&del={$row['order_id']}";?>>Remove</a>
			</td>
			<?php 
			}?>
		  </tr>
	<?php }?>
	  
      
    </tbody>
  </table>
</div>
<?php if($x==0)echo "<h4 style='color:red;'><p style='text-align:center'><strong>No Problems Found</strong></p></h4>"; ?>