<?php
 require_once('../../const.php');
 if(!isset($_COOKIE["user_handle"]))
 {
	 header("Location: "."{$host}/index.php");
     exit;
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>


   
  <title>Virtual Judge</title>
  <style>
	
	body {
	height:100%;
    background: url(<?php echo $host.'/public/img/back_ground7.jpg';?>) no-repeat center fixed;
    -webkit-background-size: contain;
    -moz-background-size: contain;
    background-size: cover;
	}


  </style>
  <link rel="stylesheet" href= <?php echo $host.'/public/assets/css/neon-core.css';?>>	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href=<?php echo $host.'/public/css/menu.css';?> rel="stylesheet">
  
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php"><img src=<?php echo $host.'/public/img/logo.png';?>><img/></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
		<li><a href="problems.php">Problems</a></li>
		<li><a href="status.php">Status</a></li>
		<li><a href="contest.php">Contests</a></li>
		<li><a href="add_contest.php">Create Contest</a></li>
		<li><a href="blogs.php">Blogs</a></li>
        <li><a href="add_blog.php">Post</a></li>
      
		<?php
			if($_COOKIE['user_handle']=='BRAD_BIT')
				echo"<li><a href='admin.php'>Admin</a></li>";
		?>
		
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  
	  <li>
						<a href="#" data-toggle="chat" data-animate="1" data-collapse-sidebar="1">
							<i class="entypo-chat"></i>
							Chat
							
							<span class="badge badge-success chat-notifications-badge is-hidden">0</span>
						</a>
					</li>
        <li><a href=<?php echo "user_info.php?handle=".$_COOKIE["user_handle"];?>><span class="glyphicon glyphicon-user"></span><?php echo $_COOKIE["user_handle"];?></a></li>
        <li><a href=<?php echo $host.'/index.php?id=0';?>><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul> 
	  
    </div>
  </div>
</nav>

<br><br><br><br>

<script src='<?php echo $host.'/public/js/clean-blog.min.js';?>'></script>


<!--
<head>
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	
</head>

<div class="page-container" >
	
	
	<div>
	
		<div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">
			
			<div class="chat-inner">
			
				
				<h2 class="chat-header">
					<a href="#" class="chat-close" data-animate="1"><i class="entypo-cancel"></i></a>
					
					<i class="entypo-users"></i>
					Chat
					<span class="badge badge-success is-hidden">0</span>
				</h2>
				
				
				<div class="chat-group" id="group-1">
					<strong>Favorites</strong>
					
					<a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
					<a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
					<a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
					<a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
					<a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
				</div>
				
				
				<div class="chat-group" id="group-2">
					<strong>Work</strong>
					
					<a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
					<a href="#" data-conversation-history="#sample_history_2"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
					<a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
				</div>
				
				
				<div class="chat-group" id="group-3">
					<strong>Social</strong>
					
					<a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
					<a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
					<a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
					<a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
				</div>
			
			</div>
			
			<div class="chat-conversation">
				
				<div class="conversation-header">
					<a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>
					
					<span class="user-status"></span>
					<span class="display-name"></span> 
					<small></small>
				</div>
				
				<ul class="conversation-body">	
				</ul>
				
				<div class="chat-textarea">
					<textarea class="form-control autogrow" placeholder="Type your message"></textarea>
				</div>
				
			</div>
			
		</div>


		<ul class="chat-history" id="sample_history">
			<li>
				<span class="user">Art Ramadani</span>
				<p>Are you here?</p>
				<span class="time">09:00</span>
			</li>
			
			<li class="opponent">
				<span class="user">Catherine J. Watkins</span>
				<p>This message is pre-queued.</p>
				<span class="time">09:25</span>
			</li>
			
			<li class="opponent">
				<span class="user">Catherine J. Watkins</span>
				<p>Whohoo!</p>
				<span class="time">09:26</span>
			</li>
			
			<li class="opponent unread">
				<span class="user">Catherine J. Watkins</span>
				<p>Do you like it?</p>
				<span class="time">09:27</span>
			</li>
		</ul>




		<ul class="chat-history" id="sample_history_2">
			<li class="opponent unread">
				<span class="user">Daniel A. Pena</span>
				<p>I am going out.</p>
				<span class="time">08:21</span>
			</li>
			
			<li class="opponent unread">
				<span class="user">Daniel A. Pena</span>
				<p>Call me when you see this message.</p>
				<span class="time">08:27</span>
			</li>
		</ul>	
	</div>
</div>



	<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
	<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">

	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="assets/js/jquery.sparkline.min.js"></script>
	<script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
	<script src="assets/js/rickshaw/rickshaw.min.js"></script>
	<script src="assets/js/raphael-min.js"></script>
	<script src="assets/js/morris.min.js"></script>
	<script src="assets/js/toastr.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

!-->
