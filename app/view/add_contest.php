<?php  require_once("menu.php");  ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script type="text/javascript" src=<?php echo $host.'/public/js/ajax_validation.js';?>></script>
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


<div class="container">
  <form id="form" class="form-inline" role="form" action="contest.php" method="post">
 
      Contest Name:<br>
	  <input type="text" class="form-control" name="contest_name" value="">
	  <br><h6 style="color:RED;" id="v_contest_name"></h6>
      Start Date (Must be 10 min from now):<br>
	  <input type="text" class="form-control"  id="datepicker" name="date" value="">
	  <select class="form-control" name="hour">
			<?php for($i=0;$i<=23;$i++){?>
			<option value=<?php echo $i;?>><?php echo $i;?></option>
			<?php }?>
	  </select>
	  <select class="form-control" name="min">
			<?php for($i=0;$i<=59;$i++){?>
			<option value=<?php echo $i;?>><?php echo $i;?></option>
			<?php }?>
	  </select>
	  <br><h6 style="color:RED;" id="v_start"></h6>
	   End Date (Must be 10 min from Start Date):<br>
	  <input type="text" class="form-control"  id="datepicker2" name="Edate" value="">
	  <select class="form-control" name="Ehour">
			<?php for($i=0;$i<=23;$i++){?>
			<option value=<?php echo $i;?>><?php echo $i;?></option>
			<?php }?>
	  </select>
	  <select class="form-control" name="Emin">
			<?php for($i=0;$i<=59;$i++){?>
			<option value=<?php echo $i;?>><?php echo $i;?></option>
			<?php }?>
	  </select>
	  <br><h6 style="color:RED;" id="v_end"></h6>
	  Contest Type:<br>
	  <select class="form-control" name="type">
			<option value="public">Public</option>
			<option value="private">Private</option>
	  </select>
	  <br><br>
	  <button id="SUBT" type="button" onclick="add_contest_validation()" class="btn btn-info" >Create</button>
  </form>
</div>

