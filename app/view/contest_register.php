<?php
	require_once('menu.php');
	require_once('../controller/contestController.php');
	require_once('contest_menu.php');
	if(!$register)
		redirect('http://localhost/our3/app/view/contest.php');
	
	
	if(isset($_POST['Reg']))
	{
		if($_POST['Reg']=='Register Invidual')
		{
			$controller->insert_participate($_GET['id'],'');
			redirect("http://localhost/our3/app/view/contest_info.php?id={$_GET['id']}");
		}
	}
?>


<br><br><br><br>
<div class="container">
<div style="text-align:center">

    <form action=<?php echo "contest_register.php?id={$_GET['id']}";?> method="POST">
	<div class="btn-group">
			<input type='submit' class='btn btn-primary' name="Reg" value="Register Invidual"></input>
			<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#team_name'>Register As a Team</button>
	</div>
    </form>	

</div>
</div>
<style>
.ui-autocomplete { z-index:2147483647; }

</style>

<script>

  $(function() {
    $( "#team" ).autocomplete({
      source: '../auto_complete/team.php'
    });
  });
  
</script>
  <script src="http://localhost/our3/public/js/ajax_validation.js"></script>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id='team_name'>
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<div class="modal-body">
        <form id='form' action=<?php echo "contest_info.php?id={$_GET['id']}";?> method="POST">
		   <div class="well tcenter">  
			  <div class="form-group">
				<label for="message-text" class="control-label">Team Name:</label>
	
				<input  class="form-control" name="team_name" id="team" ></input>
				 <br><h6 style="color:RED;" id="v_team_name"></h6>
				  <textarea name='id' hidden><?php echo $row['contest_id'];?></textarea>
			  </div>
			   </div>
			   <button id="SUBT" type="button"  class="btn btn-success" onclick="register_team_validation()" >Register</button>
				
        </form>
      </div>
    </div>
  </div>
</div>
