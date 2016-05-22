<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/contestController.php");?>
<?php
	if(!$edit)
    redirect('http://localhost/our3/app/view/contest.php');

	if(isset($_POST['delete']))
	{
		if($_POST['delete']!=$_GET['id'])
			redirect('http://localhost/our3/app/view/contest.php');

		$controller->delete_contest($_GET['id']);
	}
?>


<?php require_once('contest_menu.php');?>














<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="http://localhost/our3/public/js/ajax_validation.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  $(function() {
    $( "#datepicker2" ).datepicker();
  });
  </script>
  
</head>
<body>
 
</body>
</html>

<br><br>
<div class="container">
	<form id="form" class="form-inline" role="form" action=<?php echo "contest_edit.php?id={$_GET['id']}";?> method="post">
 
      Contest Name:<br>
	  <input type="text" class="form-control" name="contest_name" value='<?php echo $row['name'];?>'>
	  <br><h6 style="color:RED;" id="v_contest_name"></h6>
      Start Date (Must be 10 min from now):<br>
	  <input type="text" class="form-control"  id="datepicker" name="date" value='<?php echo date("m/d/Y",$row['start']);?>'>
	  <select class="form-control" name="hour">
			<?php 
				for($i=0;$i<=23;$i++)
				{
					if($i==date("H",$row['start']))
					echo "<option  value={$i} selected='true' >{$i}</option>";
					else
					echo "<option value={$i}>{$i}</option>";
				}
			?>
	  </select>
	  <select class="form-control" name="min">
			<?php 
				for($i=0;$i<=59;$i++)
				{
					if($i==date("i",$row['start']))
					echo "<option  value={$i} selected='true' >{$i}</option>";
					else
					echo "<option value={$i}>{$i}</option>";
				}
			?>
	  </select>
	  <br><h6 style="color:RED;" id="v_start"></h6>
	   End Date (Must be 10 min from Start Date):<br>
	  <input type="text" class="form-control"  id="datepicker2" name="Edate" value='<?php echo date("m/d/Y",$row['end']);?>'>
	  <select class="form-control" name="Ehour">
			<?php 
				for($i=0;$i<=23;$i++)
				{
					if($i==date("H",$row['end']))
					echo "<option  value={$i} selected='true' >{$i}</option>";
					else
					echo "<option value={$i}>{$i}</option>";
				}
			?>
	  </select>
	  <select class="form-control" name="Emin">
			<?php 
				for($i=0;$i<=59;$i++)
				{
					if($i==date("i",$row['end']))
					echo "<option  value={$i} selected='true' >{$i}</option>";
					else
					echo "<option value={$i}>{$i}</option>";
				}
			?>
	  </select>
	  <br><h6 style="color:RED;" id="v_end"></h6>
	  Contest Type:<br>
	  <select class="form-control" name="type">
			<?php
				if($row['type']=='public')
				echo "
				<option value='public' selected='true'>Public</option>
				<option value='private'>Private</option>
				";
				else
				echo "
				<option value='public'>Public</option>
				<option value='private' selected='true'>Private</option>
				";
			?>
	  </select>
	  <textarea name='id' hidden><?php echo $row['contest_id'];?></textarea>
	  <br><br>
	  <div class="btn-group">
		<button id="SUBT" type="button"  class="btn btn-info" onclick="edit_contest_validation()" >Edit</button>
		<button type='button' class='btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-sm'>Delete</button>
	  </div>
  </form>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
		<div class="modal-body">
		<form  method="POST">
		   <div class="well tcenter">  
			  <div class="form-group">
				<label for="message-text" class="control-label">are you sure you want to delete the contest?</label>
		
			  </div>
			   </div>
				<div class="btn-group">
			   <button type="submit" name='delete' value=<?php echo $_GET['id'];?> class="btn btn-danger" value="Accept">Delete</button>
			   <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
				</div>
				
		</form>
	  </div>
	</div>
  </div>
</div>
