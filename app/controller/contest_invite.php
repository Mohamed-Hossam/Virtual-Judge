<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/contestController.php");?>
<?php

	if(!$invite)
    redirect('http://localhost/our3/app/view/contest.php');

?>


<?php require_once('contest_menu.php');?>

<br><br>
<head>
  <script src="http://localhost/our3/public/js/ajax_validation.js"></script>
</head>
<script>
  $(function() {
    $( "#user" ).autocomplete({
      source: '../auto_complete/user.php'
    });
  });
  </script>
<div class="container">
  <form id='form' class="form-inline" role="form" action=<?php echo "contest_invite.php?id={$_GET['id']}";?> method="post">
	<div class="form-group">
	  
	  <input type="text" class="form-control" id='user' name="name" placeholder="Enter User Name" value=""><br><h6 style="color:RED;" id="v_name"></h6>
	  <textarea name='id' hidden><?php echo $row['contest_id'];?></textarea>
	  <button id="SUBT" type="button"  class="btn btn-danger" onclick="invite_contest_validation()" >Invite</button>
	  </div>
  </form>
</div>
