<?php 
	require_once('menu.php');
	require_once('../controller/contestController.php');
	require_once('contest_menu.php');
	if(!$registrans)redirect('http://localhost/our3/app/view/contest.php');
	


?>
<head>
<link href=<?php echo $host.'/public/css/table.css';?> rel="stylesheet">
</head>
<div class="container">   
  <table class="table table-striped" >
    <thead>
      <tr>
        <th>Registran Name</th>
      </tr>
    </thead>
    <tbody>
    <?php
		$x=0;
		$result=$controller->get_registrans();
		$i=count($result);
		while($i--)
		{
			
	?>  
		  </tr>
		   <tr>
			<td><?php echo $result[$x];?></td>
		  </tr>
	<?php $x++; }?>
	  
      
    </tbody>
  </table>
</div>


<?php if($x==0)echo "<h4 style='color:red;'><p style='text-align:center'><strong>No registrans Found</strong></p></h4>"; ?>
