<?php  require_once("menu.php");  ?>
<?php  require_once("conn.php");  ?>
<h4 style="color:red;">
<p style="text-align:center">
<?php if(isset($_GET["error"]))echo $_GET["error"];?>
</p></h4>
<?php
	$result;$er;
	function GET_mail()
	{
		global $db;global $result;
		$query="SELECT * FROM mail WHERE sender_handle='{$_COOKIE['user_handle']}' OR reciver_handle ='{$_COOKIE['user_handle']}' ORDER BY mail_id DESC";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db));
		}
	}
	function INSERT_mail()
	{
		global $db;global $er;
		$str1 = str_replace(' ', '', $_POST["mail_title"]);
		$str2 = str_replace(' ', '', $_POST["to"]);
		$str3 = str_replace(' ', '', $_POST["content"]);
		if(strlen($str1)==0||strlen($str2)==0||strlen($str3)==0)
			redirect("user_mail.php?handle={$_GET["handle"]}&error=empty field");
		
		$_POST["mail_title"]=mysqli_real_escape_string($db,$_POST["mail_title"]);
		$_POST["to"]=mysqli_real_escape_string($db,$_POST["to"]);
		$_POST["content"]=mysqli_real_escape_string($db,$_POST["content"]);
		$date = date('M d, y')." at ".date('h:ia');
		$query="SELECT count(*) FROM user WHERE Handle='{$_POST["to"]}'";
		$result=mysqli_query($db,$query);
		$row=mysqli_fetch_array($result);
		if($row[0]==0)
		{
			$er="Reciver Handle Not Found <br>";
			redirect("user_mail.php?handle={$_GET["handle"]}&error={$er}");
		}
		if($_POST["to"]==$_COOKIE['user_handle'])
		{
			$er="Reciver Handle And Sender Are the same <br>";
			redirect("user_mail.php?handle={$_GET["handle"]}&error={$er}");
		}
		$query="INSERT INTO mail(sender_handle,reciver_handle,date,content,title) 
		VALUES('{$_COOKIE['user_handle']}','{$_POST['to']}','{$date}','{$_POST['content']}','{$_POST["mail_title"]}')";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		redirect("user_mail.php?handle={$_GET["handle"]}&error={$er}");
	}
	function Accept_Invite()
	{
		global $db;global $er;
		$query="SELECT count(team_name) FROM member_in WHERE team_name='{$_POST['r']}' AND user_handle='{$_COOKIE['user_handle']}'";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		$r=mysqli_fetch_array($result);
		if($r[0]!=0)
		{
			return;
		}
		
		$query="SELECT count(team_name) FROM member_in WHERE team_name='{$_POST['r']}'";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
		$r=mysqli_fetch_array($result);
		if($r[0]>=3)
		{
			$er="Team has max Members ,sorry some one replace you";
			redirect("user_mail.php?handle={$_GET["handle"]}&error={$er}");
		}
		
		$query="INSERT INTO member_in VALUES('{$_POST['r']}','{$_COOKIE['user_handle']}')";
		$result=mysqli_query($db,$query);
		if(!$result)
		{
			die("query failed "." ".mysqli_error($db)); 
		}
	}
	if(isset($_POST['submit']))
	{
		Accept_Invite();
	}		
	
	if(isset($_POST['content'])&&isset($_POST['mail_title'])&&isset($_POST['to']))
	if($_POST['content']!=""&&$_POST['mail_title']!=""&&$_POST['to']!="")
	{
		INSERT_mail();
	}
	GET_mail();

	
	
	
?>

<div class="container" id="page-content">
      <div class="row-fluid">
      <ul class="nav nav-tabs" id="contest_nav">
			  <li><a href=<?php echo "user_info.php?handle=".$_GET['handle'];?>>Information</a></li>
			  <li><a href=<?php echo "user_blogs.php?handle=".$_GET['handle'];?>>Blogs</a></li>
			  <li><a href=<?php echo "user_team.php?handle=".$_COOKIE["user_handle"];?>>Teams</a></li>
			  <li class="active"><a href=<?php echo "user_mail.php?handle=".$_COOKIE["user_handle"];?>>Mails</a></li>
			  <li><a href=<?php echo "user_edit.php?handle=".$_COOKIE["user_handle"];?>>Edit</a></li>
      </ul>
	</div>
	<br>
</div>


<div class="container"><div class="form-inline" role="form">
  <form  action=<?php echo "user_mail.php?handle=".$_COOKIE["user_handle"];?> method="post">
 
      Mail Title:<br>
	  <input type="text" class="form-control" name="mail_title" value="">
	  <br>
	   Reciver Handle:<br>
	  <input type="text" class="form-control" name="to" value="">
	  </div>
	   Content:<br>
      <textarea class="form-control" rows="5" name="content" value="" ></textarea>
	  <br>
      <input type="submit" class="btn btn-primary" value="Send">
  </form>
 
</div>








<div class="container">      
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Sender</th>
        <th>Reciver</th>
		<th>Tilte</th>
		<th>Date</th>
      </tr>
    </thead>
	 <tbody>
	<?php
	$x=0;
	 	while($row=mysqli_fetch_assoc($result))
		{
			if(isset($row["type"]))
			{
				if($row['sender_handle']==$_COOKIE['user_handle'])
					continue;
				//check if the user accept the invtation
				$query="SELECT count(team_name) FROM member_in WHERE team_name='{$row['type']}' AND user_handle='{$_COOKIE['user_handle']}'";
				$res=mysqli_query($db,$query);
				$r=mysqli_fetch_array($res);
				if($r[0]!=0)
				{
					continue;
				}
				$query="SELECT count(team_name) FROM member_in WHERE team_name='{$row['type']}'";
				$res=mysqli_query($db,$query);
				$r=mysqli_fetch_array($res);
				if($r[0]>=3)
				{
					continue;
				}
			}
			$x++;
	?>
		<tr>
        <th><a href=<?php echo "user_info.php?handle={$row['sender_handle']}";?>><?php echo $row['sender_handle'];?></th>
		<th><a href=<?php echo "user_info.php?handle={$row['reciver_handle']}";?>><?php echo $row['reciver_handle'];?></th>
		<th>
			<?php 
			if(!isset($row["type"]))
			$but="<button type='button' class='btn btn-link' data-toggle='modal' data-target='#regular' 
			data-content='{$row['content']}'
			><div style='color:Green;'><b>{$row['title']}</b></div></button>";
			else
			
			$but="<button type='button' class='btn btn-link' data-toggle='modal' data-target='#ivitation' 
			data-content='{$row['content']}'
			data-content2={$row['type']}
			><div style='color:RED;'><B>{$row['title']}</div><b></button>";
			
			echo $but;
			?>
			
			
		
		
		</th>
		<th><?php echo $row['date'];?></th>
        </tr>
		<?php }?>
	</tbody>
  </table>
</div>

<h4 style="color:red;">
		<p style="text-align:center">
		<?php if($x==0)echo "No Emails Found";?>
		</p></h4>








<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" id='regular'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <form>
		   <div class="well tcenter">  
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" rows="10" id="message-text" readonly></textarea>
          </div>
		   </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
$('#regular').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var cont = button.data('content') 
  var modal = $(this)
  modal.find('.modal-body textarea').val(cont)
})

</script>





<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id='ivitation'>
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<div class="modal-body">
        <form action=<?php echo "user_mail.php?handle=".$_COOKIE["user_handle"];?> method="POST">
		   <div class="well tcenter">  
			  <div class="form-group">
				<label for="message-text" class="control-label">Message:</label>
				<textarea class="form-control" rows="10" name="response" id="message-text" readonly></textarea>
				<input rows="10" name="r" id="message-text" hidden=""></input>
			  </div>
			</div>
			   <button type="submit" name='submit'class="btn btn-success" value="Accept">Accept</button>
				
        </form>
      </div>
    </div>
  </div>
</div>
 	

<script>
$('#ivitation').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var cont = button.data('content') 
  var modal = $(this)
  modal.find('.modal-body textarea').val(cont)
  modal.find('.modal-body input').val(button.data('content2'))
})
</script>



