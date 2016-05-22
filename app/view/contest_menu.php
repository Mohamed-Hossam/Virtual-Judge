



<h4 style="color:red;">
<p style="text-align:center">
<?php 
if($row['start']>time())echo "Before Start <br>";
if($row['start']<time()&&$row['end']>time())echo "Befor End <br>";
if($row['end']<time())echo "Contest Ended <br>";
?>
</p></h4>

<?php
if($row['end']<time())goto skip_counter;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color:#EDEDED">
<script src=<?php echo $host.'/public/js/countdown.js';?>></script>
	<div class="showcaseWindow">
		<div class="container">
			<div class="sixteen columns">
				<table width="100%" border="0" cellspacing="0" cellpadding="20">
					<tr>
						<td align="center" valign="middle">
								
								<script>
									function doneHandler(result) {
										var year = result.getFullYear();
										var month = result.getMonth() + 1; 
										var day = result.getDate();
										var h = result.getHours();
										var m = result.getMinutes();
										var s = result.getSeconds();
										var UTC = result.toString();
										
										var output = UTC + "\n";
										output += "year: " + year + "\n";
										output += "month: " + month + "\n";
										output += "day: " + day + "\n";
										output += "h: " + h + "\n";
										output += "m: " + m + "\n";
										output += "s: " + s + "\n";
										
										var mess='<?php if($row['start']>time())echo "Contest Has Started , Refresh the page";
										else echo "Contest Has Ended , Refresh the page";
										?>';
										alert(mess);
										
									}
									var myCountdownTest = new Countdown({time: <?php 
									
									$t=time();
									if($row["start"]>$t)echo $row["start"]-$t;
									if($row["start"]<=$t&&$row["end"]>=$t)echo $row["end"]-$t;
									if($row["end"]<$t)echo 0;
									
									
									?>,width	: 300, height	: 50,onComplete : doneHandler});
								</script>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>


<br><br>


<?php skip_counter:;?>


<div class="container" id="page-content">
      <div class="row-fluid">
      <ul class="nav nav-tabs" id="contest_nav">
	  
				<?php if(!$info) goto info_skip;?>
				<?php if((strpos($_SERVER['PHP_SELF'],'contest_info')==false))
				{
					?>
			  <li><a href=<?php echo "contest_info.php?id={$_GET['id']}";?>>Information</a></li>
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_info.php?id={$_GET['id']}";?>>Information</a></li>
				<?php
				}?>
				<?php info_skip:;?>
			  
			  <?php if(!$status) goto status_skip;?>
			  <?php if((strpos($_SERVER['PHP_SELF'],'contest_status')==false))
				{
					?>
			  <li><a href=<?php echo "contest_status.php?id={$_GET['id']}";?>>Status</a></li>
				<?php  
				}
				else
				{ ?>
			  <li class='active'><a href=<?php echo "contest_status.php?id={$_GET['id']}";?>>Status</a></li>
				<?php
				}?>
				<?php status_skip:;?>
				
				 <?php if(!$standing) goto standing_skip;?>
				<?php if((strpos($_SERVER['PHP_SELF'],'contest_standing')==false))
				{
					?>
			  <li><a href=<?php echo "contest_standing.php?id={$_GET['id']}";?>>Standing</a></li>
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_standing.php?id={$_GET['id']}";?>>Standing</a></li>
				<?php
				}?>
				<?php standing_skip:;?>
				
				<?php if((strpos($_SERVER['PHP_SELF'],'contest_registrans')==false))
				{
					?>
			  <li><a href=<?php echo "contest_registrans.php?id={$_GET['id']}";?>>Registrans</a></li>
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_registrans.php?id={$_GET['id']}";?>>Registrans</a></li>
				<?php
				}?>
				
				<?php if(!$register)goto register_skip;?>
				
				<?php if((strpos($_SERVER['PHP_SELF'],'contest_register')==false))
				{
					?>
			  <li><a href=<?php echo "contest_register.php?id={$_GET['id']}";?>>Register</a></li> 
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_register.php?id={$_GET['id']}";?>>Register</a></li> 
				<?php
				}?>
				<?php register_skip:;?>
				
				<?php if(!$unregister)goto unregister_skip;?>
				
				<?php if((strpos($_SERVER['PHP_SELF'],'contest_unregister')==false))
				{
					?>
			  <li><a href=<?php echo "contest_unregister.php?id={$_GET['id']}";?>>Unregister</a></li> 
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_unregister.php?id={$_GET['id']}";?>>Unregister</a></li> 
				<?php
				}?>
				<?php unregister_skip:;?>
				
				<?php if(!$edit)goto edit_skip;?>
				<?php if((strpos($_SERVER['PHP_SELF'],'contest_edit')==false))
				{
					?>
			  <li><a href=<?php echo "contest_edit.php?id={$_GET['id']}";?>>Edit</a></li>
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_edit.php?id={$_GET['id']}";?>>Edit</a></li>
				<?php
				}?>
				<?php edit_skip:;?>
				<?php if(!$invite)goto invite_skip;?>
			  	<?php if((strpos($_SERVER['PHP_SELF'],'contest_invite')===false))
				{
					?>
			  <li><a href=<?php echo "contest_invite.php?id={$_GET['id']}";?>>Invite</a></li>
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_invite.php?id={$_GET['id']}";?>>Invite</a></li>
				<?php
				}?>
				<?php invite_skip:; ?>
				<?php if(!$add_problem)goto add_skip;?>
				<?php if((strpos($_SERVER['PHP_SELF'],'contest_add_problem')==false))
				{
					?>
			  <li><a href=<?php echo "contest_add_problem.php?id={$_GET['id']}";?>>Add Problems</a></li>
				<?php  
				}
				else
				{ ?>
			  <li class="active"><a href=<?php echo "contest_add_problem.php?id={$_GET['id']}";?>>Add Problems</a></li>
				<?php
				}?>
				<?php add_skip:;?>
			 
			  
			  
			  
			  
			  
			  
			 
      </ul>
	</div>
</div>

