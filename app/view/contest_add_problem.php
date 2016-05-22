<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/contestController.php");?>
<?php  require_once('contest_menu.php');?>
<?php
	if(!$add_problem)
    redirect('http://localhost/our3/app/view/contest.php');
	
?>


<script>
  $(function() {
    $( "#problem_search" ).autocomplete({
      source: '../auto_complete/problem_search.php'
    });
  });
</script>
<head>
  <script src="http://localhost/our3/public/js/ajax_validation.js"></script>
</head>
<br><br><br><br><br>
<div class="container">
	<form class="form-inline" action=<?php echo 'contest_info.php?id='.$_GET['id'];?> method='POST' id='form'>
		<select class='form-control' name='mode' onchange='change_the_form()'>
			<option value='sp'>Specific Problem</option>
			<option value='ran'>Random Problems</option>
			<option value='r'>Complete Regional</option>
			<option value='w'>Complete World Final</option>
		</select>
		<input type="text" class="form-control" name="problem_name"  value="" id="problem_search" value="" placeholder="Search for problem" >
		<select class='form-control' name='operation' >
			<option value='='>exactly</option>
			<option value='>'>greater than</option>
			<option value='<'>less than</option>
		</select>
		<select class='form-control' name='level' >
			<option value='' disabled >Level</option>
			<?php for($l=1;$l<=10;$l++)echo 
			"<option value='{$l}'>{$l}</option>"
			?>
		</select>
		<select class='form-control' name='regional' >
			<?php 
				  $reg=$controller->get_Regional();
				  while($r=mysqli_fetch_assoc($reg))
				  {
					  echo "<option value='{$r['source']}'>{$r['source']}</option>";
				  }
			?>
		</select>
		<select class='form-control' name='world' >
			<?php 
				  $wor=$controller->get_world();
				  while($r=mysqli_fetch_assoc($wor))
				  {
					  echo "<option value='{$r['source']}'>{$r['source']}</option>";
				  }
			?>
		</select>
		<input type="number" min='1' class="form-control" name="problem_num"  value="" id="problem_num" value="" placeholder="Enter problems number" >
		<textarea name='id' hidden><?php echo $row['contest_id'];?></textarea>
		<button id="SUBT" type="button"  class="btn btn-danger" onclick="add_problem_validation()" >Add</button>
	</form>
	<h6 style="color:RED;" id="error"></h6>
</div>

<script>
	function change_the_form()
	{
		var mode = document.forms['form']['mode'].value;
		var level = document.forms['form']['level'];
		var operation=document.forms['form']['operation'];
		var regional=document.forms['form']['regional'];
		var world=document.forms['form']['world'];
		if(mode!='sp')
		{
			 $('#problem_search').attr('type', 'hidden');
		}
		else
		{
			$('#problem_search').attr('type', 'text');
		}
		
		if(mode!='ran')
		{
			 $('#problem_num').attr('type', 'hidden');
			 level.style.display = 'none';
			 operation.style.display = 'none';
		}
		else
		{
			 $('#problem_num').attr('type', 'number');
			 level.style.display = 'inline';
			 operation.style.display = 'inline';
		}
		if(mode!='r')
		{
			 regional.style.display = 'none';
		}
		else
		{
			 regional.style.display = 'inline';
		}
		if(mode!='w')
		{
			 world.style.display = 'none';
		}
		else
		{
			 world.style.display = 'inline';
		}
	}

	change_the_form();

</script>