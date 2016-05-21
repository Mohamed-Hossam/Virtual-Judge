<?php  require_once("menu.php");  ?>
<?php  require_once("conn.php");  ?>

<?php
	$AC=0;$ALL=0;$row;
	function GET_user()
	{
		global $db;global $AC;global $ALL;global $row;
		$query="SELECT * FROM user WHERE Handle='{$_GET['handle']}'";
		$result=mysqli_query($db,$query);
		if(!$result)//query faild print reason
		{
			die("query failed "." ".mysqli_error($db));
		}
		else
		{
			$ar=mysqli_num_rows($result);
			if($ar==0)
			Redirect("index.php");
			$row=mysqli_fetch_assoc($result);
			$query="SELECT count(submission_id) FROM submission WHERE user_Handle='{$_GET['handle']}'";
			$ALL=mysqli_query($db,$query);
			$ALL=mysqli_fetch_array($ALL);
			$ALL=$ALL[0];
			$query="SELECT count(submission_id) FROM submission WHERE verdict='Accepted' AND user_Handle='{$_GET['handle']}'";
			$AC=mysqli_query($db,$query);
			$AC=mysqli_fetch_array($AC);
			$AC=$AC[0];
		}
	}
	if(isset($_GET['handle']))//handle assigned in the url
	{
		GET_user();
	}
	else
	{
		redirect("index.php");
	}
?>


<div class="container" id="page-content">
      <div class="row-fluid">
      <ul class="nav nav-tabs" id="contest_nav">
			  <li class="active"><a href=<?php echo "user_info.php?handle=".$_GET['handle'];?>>Information</a></li>
			  <li><a href=<?php echo "user_blogs.php?handle=".$_GET['handle'];?>>Blogs</a></li>
			  <li><a href=<?php echo "user_team.php?handle=".$_COOKIE["user_handle"];?>>Teams</a></li>
			  <li><a href=<?php echo "user_mail.php?handle=".$_COOKIE["user_handle"];?>>Mails</a></li>
			  <li><a href=<?php echo "user_edit.php?handle=".$_COOKIE["user_handle"];?>>Edit</a></li>
      </ul>
	</div>
</div>


<div class="container"><div class="span8">
          <h2>Information of <?php echo $row["Handle"]?></h2>
          <div id="userinfo">
            <table class="table">
              <tr><th class="span3">Username:</th><td class="span9"><?php echo $row["Handle"]?></td></tr>
              <tr><th>First Name:</th><td><?php echo $row["Fname"]?></td></tr>
			  <tr><th>Last Name:</th><td><?php echo $row["Lname"]?></td></tr>
              <tr><th>School:</th><td><?php echo htmlspecialchars($row["School"]);?></td></tr>
              <tr><th>Email:</th><td><?php echo $row["Email"]?></td></tr>
              <tr><th>Register Time:</th><td><?php echo $row["Register_Date"]?></td></tr>
			  <tr><th>Accepted:</th><td><?php echo $AC?></td></tr>
			  <tr><th>Total:</th><td><?php echo $ALL?></td></tr>
            </table>
          </div>
</div></div>


