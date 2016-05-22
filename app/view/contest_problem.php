<?php  
	require_once("menu.php");  
	require_once("../controller/contestController.php");
?>


<?php
if(!$problem)
    redirect('http://localhost/our3/app/view/contest.php');
if(isset($_GET["pid"]))
{
	$P;$result;	
	$controller->get_problem($P,$result);
	$cat="";
	while($r=mysqli_fetch_assoc($result))
	{
		$cat.=$r["category_name"];
		$cat.="<br>";
	}
	if(strlen($cat)==0)$cat="No Tags";
}
else
{
	 redirect('http://localhost/our3/app/view/contest.php');
}
?>


<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="http://localhost/our3/public/js/ajax_validation.js"></script>
</head>
<h2 style="text-align:center"><?php echo $P["name"]?></h2> 

<div class="container">
  <div class="well tcenter">  
		<h4 style="text-align:center">
			Time Limit: <?php echo $P["time_limit"]; if($P["from_oj"]!="Spoj")echo" Ms";?><br>
			Memory Limit: <?php echo $P["memory_limit"];if($P["from_oj"]!="Spoj")echo" Kb"?><br>
			This problem will be judged on <span class="badge badge-info"><?php echo $P["from_oj"]?></span>. Original ID: <a href=<?php echo $P["link"]?> target="_blank"><?php echo $P["id"]?></a><br>
			Input: <?php echo $P["input_type"]?><br>
			Output: <?php echo $P["output_type"]?><br>
			<?php
				if($P["from_oj"]=='Spoj')
					echo "Languages : ".$P["notes"];
			?>
		</h4> 
  </div>

  
  <h2 style="text-align:center">

  <div class="btn-group">
    
	<a href=<?php echo "contest_status.php?id={$_GET['id']}&Fproblrm=".urlencode($P["name"]);?> class="btn btn-info" role="button">Status</a>
	
	
	<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Submit</button>
  </div>
  </h2>
  
  <?php
	if($P["from_oj"]=='Uva')
	{
		echo "<div style='text-align:center'> 
				<object data='online_Judges/uva/pdfs/P{$P["id"]}.pdf' type='application/pdf' width='70%' height='1125'>
			<p>Alternative text - include a link <a href='online_Judges/uva/pdfs/P{$P["id"]}.pdf' type='application/pdf'>to the PDF!</a></p></object></div>";
			goto NEXT;
	}
  ?>
   <?php
	if($P["from_oj"]=='UvaLive')
	{
		echo "<div style='text-align:center'> 
				<object data='online_Judges/uvalive/pdfs/P{$P["id"]}.pdf' type='application/pdf' type='application/pdf' width='70%' height='1125'>
			<p>Alternative text - include a link <a href='online_Judges/uvalive/pdfs/P{$P["id"]}.pdf' type='application/pdf'>to the PDF!</a></p></object></div>";
			goto NEXT;
	}
  ?>
   <?php
	if($P["from_oj"]=='Spoj')
	{
		echo " <div class='well tcenter'>  <h5>{$P['description']}</h5> </div>";
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
		<h5><?php echo $P["description"];?></h5> 
  </div>
  
 
  <h2>Input</h2> 
  
  <div class="well tcenter">  
		<h5><?php echo $P["input"];?> </h5> 
  </div>
	
  
   
  <h2>Output</h2> 
  <div class="well tcenter">  
		<h5><?php echo $P["output"];?></h5> 
  </div>
  
   <h2>Samples</h2> 
   <div><div><div><div><div>
  <?php
 
		$sin=$P["sample_input"];
		if (stristr($sin,'<br')==null&&stristr($sin,'<pre')==null&&stristr($sin,'<p')==null)
			echo " <pre class='content-wrapper'>{$sin}</pre>";
		else
			echo '<div class="content-wrapper well">'.$sin."</div>\n";
  ?>

  <?php
	if($P["notes"]!="")
		
		{
	?>
		  <h2>Notes</h2> 
		  <div class="well tcenter">  
				<h5><?php echo $P["notes"];?></h5> 
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

  <div class="btn-group">
    
	<a href=<?php echo "contest_status.php?id={$_GET['id']}&Fproblrm=".urlencode($P["name"]);?> class="btn btn-info" role="button">Status</a>
	
	
	<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Submit</button>
  </div>
  </h2>
  
  
  <?php
		$id=$_GET['pid'];
		$ind=$P["ind"];
		$url="contest_status.php?id={$_GET['id']}";
		$pi=$P["id"];
		$cid=$P["contest_id"];
		
		$url='contest_status.php?id='.$_GET['id'];
		if($P["from_oj"]=="CodeForces")
			require_once("online_Judges\codeforces\codeforces_submit_form.php");
		if($P["from_oj"]=="Uva")
			require_once("online_Judges\uva\uva_submit_form.php");
		if($P["from_oj"]=="UvaLive")
			require_once("online_Judges\uvalive\uvalive_submit_form.php");
		if($P["from_oj"]=="Spoj")
			require_once("online_Judges\spoj\spoj_submit_form.php");
  ?>
  
  
  
  
 	