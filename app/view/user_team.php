<?php  require_once("menu.php");  ?>
<?php  require_once("conn.php");  ?>
<h4 style="color:red;">
<p style="text-align:center">
<?php if(isset($_GET["error"]))echo $_GET["error"];?>
</p></h4>
<?php
	$result;$er;
	function GET_teams()
	{
		global $db;global $result;
		$query="SELECT DISTINCT team_name FROM member_in WHERE user_Handle='{$_GET['handle']}'";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db));
		}
	}
	function INSERT_team()
	{
		global $db;global $er;
		$str=$_POST["Tname"];
		$_POST["Tname"] = str_replace(' ', '', $_POST["Tname"]);
		if(strlen($_POST["Tname"])==0)   //check if name is empty string 
			redirect("user_team.php?handle={$_GET["handle"]}&error=empty_name");
		for($var=0;$var<strlen($_POST["Tname"]);++$var)// check invalid characters
		{
			if(!(($_POST["Tname"][$var]<='z'&&$_POST["Tname"][$var]>='a')||
				($_POST["Tname"][$var]<='Z'&&$_POST["Tname"][$var]>='A')||
				($_POST["Tname"][$var]<='9'&&$_POST["Tname"][$var]>='0')||
				$_POST["Tname"][$var]=='_'))
				{
					$er="Team Name :error format (only alpha,numbers,(_) AND Whilespace)<br>";
					redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
				}
		}
		$query="SELECT count(*) FROM team WHERE team_name='{$str}'"; //check if team name already taken
		$result=mysqli_query($db,$query);
		$row=mysqli_fetch_array($result);
		if($row[0]!=0)
		{
			$er="Team Name is Taken <br>";
			redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
		}
		
		$query="SELECT count(Handle) FROM user WHERE Handle='{$str}'";// check if a user have that name 
		$result=mysqli_query($db,$query);
		$row=mysqli_fetch_array($result);
		if($row[0]!=0)
		{
			$er="Name is Taken <br>";
			redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
		}
		
		
		$query="INSERT INTO team VALUES('{$_POST['Tname']}')"; //everything valid , insert team and relation member_in
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		$query="INSERT INTO member_in VALUES('{$_POST['Tname']}','{$_GET["handle"]}')";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
	}
	
	
	
	function invite()
	{
		global $db;global $er;
		$_POST["mail_title"]="Invitation";
		
		
		$str3 = str_replace(' ', '', $_POST["invite_name"]);
		if(strlen($str3)==0)
			redirect("user_team.php?handle={$_GET["handle"]}&error=empty_name");
		
		
		$_POST["to"]=mysqli_real_escape_string($db,$_POST["invite_name"]);
		
		$_POST["content"]="{$_COOKIE['user_handle']} Invite you to {$_GET['inv']} Team";
		$date = date('M d, y')." at ".date('h:ia');
		$query="SELECT count(*) FROM user WHERE Handle='{$_POST["to"]}'";
		$result=mysqli_query($db,$query);
		$row=mysqli_fetch_array($result);
		if($row[0]==0)
		{
			$er="Invited Handle Not Found <br>";
			redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
			
		}
		if($_POST["to"]==$_COOKIE['user_handle'])
		{
			$er="Invited Handle And Inviter Are the same <br>";
			redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
		}
		
		$query="SELECT count(team_name) FROM member_in WHERE team_name='{$_GET['inv']}' AND user_handle='{$_POST['to']}'";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		$r=mysqli_fetch_array($result);
		if($r[0]!=0)
		{
			$er="Invited Handle Already in the team <br>";
			redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
		}
		
		$query="SELECT count(team_name) FROM member_in WHERE team_name='{$_GET['inv']}'";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		$r=mysqli_fetch_array($result);
		if($r[0]>=3)
		{
			$er="Team has max Members";
			redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
		}
		
		$query="INSERT INTO mail(sender_handle,reciver_handle,date,content,title,type) 
		VALUES('{$_COOKIE['user_handle']}','{$_POST['to']}','{$date}','{$_POST['content']}','{$_POST["mail_title"]}','{$_GET['inv']}')";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		redirect("user_team.php?handle={$_GET["handle"]}&error={$er}");
	}
	
	
	
	if(isset($_POST['invite_name']))
	{
		invite();
	}
	
	if(isset($_GET['handle']))
	{
		if(isset($_POST['Tname']))
		{
			if($_POST['Tname']!="")
			INSERT_team();
		}
		GET_teams();
		
	}
	else
	{
		redirect("index.php");
	}
	
	
	
	
	
?>


<div class="container" id="page-content">
      <div class="row-fluid">
      <ul class="nav nav-tabs" id="contest_nav">
			  <li><a href=<?php echo "user_info.php?handle=".$_GET['handle'];?>>Information</a></li>
			  <li><a href=<?php echo "user_blogs.php?handle=".$_GET['handle'];?>>Blogs</a></li>
			  <li class="active"><a href=<?php echo "user_team.php?handle=".$_COOKIE["user_handle"];?>>Teams</a></li>
			  <li><a href=<?php echo "user_mail.php?handle=".$_COOKIE["user_handle"];?>>Mails</a></li>
			  <li><a href=<?php echo "user_edit.php?handle=".$_COOKIE["user_handle"];?>>Edit</a></li>
      </ul>
	</div>
</div>


<br>
<div class="container">
  <form class="form-inline" role="form" action=<?php echo "user_team.php?handle=".$_GET['handle'];?> method="POST">
		<div class="form-group">
			<input type="text" class="form-control" name="Tname" value="" placeholder="Enter Team Name">
		</div>
		<button type="submit" class="btn btn-info">Create</button>
  </form>
</div>












<div class="container">      
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Team Name</th>
        <th>Members</th>
		<th>Invite</th>
      </tr>
    </thead>
	 <tbody>
	<?php 
		$x=0;
		while($row=mysqli_fetch_assoc($result))
		{
			$query="SELECT user_Handle FROM member_in WHERE team_name='{$row['team_name']}'";
			$res=mysqli_query($db,$query);
			$x++;
	?>
   
      	<tr>
        <th><?php echo $row['team_name'];?></th>
        <th>
		
		<?php 
		while($mem=mysqli_fetch_array($res))
		{echo "<a href=user_info.php?handle={$mem[0]}>{$mem[0]}</a><br>";}
		?>
		
		</th>
		
	
		<th>
		<div class="btn-group">
		<form class="form-inline" action=<?php echo "user_team.php?handle=".$_GET['handle']."&inv={$row['team_name']}"?> method="POST">
		<input class="form-control" type="text" name="invite_name"></input>
		<button type="submite" class="btn btn-danger" >Invite</button>
		</form>
		</div>
		</th>
	
		</tr>
    
	<?php }?>
	</tbody>
  </table>
</div>

<h4 style="color:red;">
		<p style="text-align:center">
		<?php if($x==0)echo "No Teams Found";?>
		</p></h4>




