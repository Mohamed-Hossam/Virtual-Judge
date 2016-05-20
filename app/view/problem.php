<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/problemController.php");?>


<?php
	$result=$controller->problem;
	$row=mysqli_fetch_assoc($result);
	$result=$controller->category;
	$cat="";
	while($r=mysqli_fetch_assoc($result))
	{
		$cat.=$r["category_name"];
		$cat.="<br>";
	}
	if(strlen($cat)==0)$cat="No Tags";
?>


<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="http://localhost/our3/public/js/ajax_validation.js"></script>
</head>
<h2 style="text-align:center"><?php echo $row["name"]?></h2> 

<div class="container">
  <div class="well tcenter">  
		<h4 style="text-align:center">
			Time Limit: <?php echo $row["time_limit"]; if($row["from_oj"]!="Spoj")echo" Ms";?><br>
			Memory Limit: <?php echo $row["memory_limit"];if($row["from_oj"]!="Spoj")echo" Kb"?><br>
			This problem will be judged on <span class="badge badge-info"><?php echo $row["from_oj"]?></span>. Original ID: <a href=<?php echo $row["link"]?> target="_blank"><?php echo $row["id"]?></a><br>
			Input: <?php echo $row["input_type"]?><br>
			Output: <?php echo $row["output_type"]?><br>
			<?php
				if($row["from_oj"]=='Spoj')
					echo "Languages : ".$row["notes"];
			?>
		</h4> 
  </div>

  
  <h2 style="text-align:center">
  <?php if($_GET["id"]!=1){?>
  <a href="problem.php?id=<?php echo $_GET["id"]-1;?>" class="btn btn-info" role="button">Prev</a>
    <?php }?>
  <div class="btn-group">
    
	<a href=<?php echo "status.php?Fproblrm=".urlencode($row["name"]);?> class="btn btn-info" role="button">Status</a>
    <a href=<?php echo "blogs.php?search=".urlencode($row["name"]);?> class="btn btn-info" role="button">Discuss</a>
	
	
	<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Submit</button>
   
	
	
  </div>

  
  <?php if($_GET["id"]!=$controller->max_problem_id){?>
  <a href="problem.php?id=<?php echo $_GET["id"]+1;?>" class="btn btn-info" role="button">Next</a>
  <?php }?>
  </h2>
  
  <?php
	if($row["from_oj"]=='Uva')
	{
		echo "<div style='text-align:center'> 
				<object data='online_Judges/uva/pdfs/P{$row["id"]}.pdf' type='application/pdf' width='70%' height='1125'>
			<p>Alternative text - include a link <a href='online_Judges/uva/pdfs/P{$row["id"]}.pdf' type='application/pdf'>to the PDF!</a></p></object></div>";
			goto NEXT;
	}
  ?>
   <?php
	if($row["from_oj"]=='UvaLive')
	{
		echo "<div style='text-align:center'> 
				<object data='online_Judges/uvalive/pdfs/P{$row["id"]}.pdf' type='application/pdf' type='application/pdf' width='70%' height='1125'>
			<p>Alternative text - include a link <a href='online_Judges/uvalive/pdfs/P{$row["id"]}.pdf' type='application/pdf'>to the PDF!</a></p></object></div>";
			goto NEXT;
	}
  ?>
   <?php
	if($row["from_oj"]=='Spoj')
	{
		echo " <div class='well tcenter'>  <h5>{$row['description']}</h5> </div>";
		if($cat!="No Tags")
		echo "<div class='container'>
		<h2>Category:</h2> 
	  <div class='well tcenter'>  
			<h5>{$cat}</h5> 
	  </div> </div>";
			goto NEXT;
	}
  ?>
  
  <div class="well tcenter">  
		<h5><?php echo $row["description"];?></h5> 
  </div>
  
 
  <h2>Input</h2> 
  
  <div class="well tcenter">  
		<h5><?php echo $row["input"];?> </h5> 
  </div>
	
  
   
  <h2>Output</h2> 
  <div class="well tcenter">  
		<h5><?php echo $row["output"];?></h5> 
  </div>
  
   <h2>Samples</h2> 
   <div><div><div><div><div>
  <?php
 
		$sin=$row["sample_input"];
		if (stristr($sin,'<br')==null&&stristr($sin,'<pre')==null&&stristr($sin,'<p')==null)
			echo " <pre class='content-wrapper'>{$sin}</pre>";
		else
			echo '<div class="content-wrapper well">'.$sin."</div>\n";
  ?>

  <?php
	if($row["notes"]!="")
		
		{
	?>
		  <h2>Notes</h2> 
		  <div class="well tcenter">  
				<h5><?php echo $row["notes"];?></h5> 
		  </div>
  <?php
		}
  ?>
  
  
  <h2>Category</h2> 
  <div class="well tcenter">  
		<h5><?php echo $cat;?></h5> 
  </div>
  
  <?php NEXT:;?>
  
  <h2 style="text-align:center">
  <?php if($_GET["id"]!=1){?>
  <a href="problem.php?id=<?php echo $_GET["id"]-1;?>" class="btn btn-info" role="button">Prev</a>
    <?php }?>
  <div class="btn-group">
    
	<a href=<?php echo "status.php?Fproblrm=".urlencode($row["name"]);?> class="btn btn-info" role="button">Status</a>
    <a href=<?php echo "blogs.php?search=".urlencode($row["name"]);?> class="btn btn-info" role="button">Discuss</a>
	<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Submit</button>
  </div>

  <?php if($_GET["id"]!=$controller->max_problem_id){?>
  <a href="problem.php?id=<?php echo $_GET["id"]+1;?>" class="btn btn-info" role="button">Next</a>
  <?php }?>
  </h2>
  
  <?php
		$id=$_GET['id'];
		$ind=$row["ind"];
		$url='status.php';
		$pi=$row["id"];
		$cid=$row["contest_id"];
		if($row["from_oj"]=="CodeForces")
			require_once("online_Judges\codeforces\codeforces_submit_form.php");
		if($row["from_oj"]=="Uva")
			require_once("online_Judges\uva\uva_submit_form.php");
		if($row["from_oj"]=="UvaLive")
			require_once("online_Judges\uvalive\uvalive_submit_form.php");
		if($row["from_oj"]=="Spoj")
			require_once("online_Judges\spoj\spoj_submit_form.php");
  ?>
  
  
  
  
 	