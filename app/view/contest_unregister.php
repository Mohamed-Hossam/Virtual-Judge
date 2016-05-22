<?php
	require_once('menu.php');
	require_once('../controller/contestController.php');
	require_once('contest_menu.php');
	if(!$unregister)
		redirect('http://localhost/our3/app/view/contest.php');
	
	
	$controller->delete_participate($_GET['id']);
	
	redirect("contest_register.php?id={$_GET['id']}");
	
?>


