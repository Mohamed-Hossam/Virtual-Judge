<?php  require_once("../controller/blogController.php");?>
<?php  require_once("menu.php");  ?>
<head>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://localhost/our3/public/css/editor.css" type="text/css" rel="stylesheet"/>
	<script src="http://localhost/our3/public/js/ajax_validation.js"></script>
	<script src="http://localhost/our3/public/js/editor.js"></script>
	
</head>


<?php 
	if(isset($_POST['delete']))
	{
		$controller->delete_blog($_POST['delete']);
	}
	if(isset($_POST['edit']))
	{
		$row=$controller->get_blog($_POST['edit']);
		
		if($row['writer_Handle']!=$_COOKIE['user_handle'])
			redirect("http://localhost/our3/index.php");
				
		$result=$controller->get_blog_tags($_POST['edit']);
		$Tag="";
		while($r=mysqli_fetch_assoc($result))
		{
			if(strlen($Tag)!=0)$Tag.=',';
			$Tag.=$r['tag_name'];
		}
		
	}
	else redirect("http://localhost/our3/index.php");

?>


<body>
		<div class="container-fluid">
			<div class="row">
				<div class="container">
					<div class="row">
						<form id="form" action="blogs.php" name="form" method="post">
							<input type="text" class="form-control" name="blog_title"  value='<?php echo $row['title'];?>' placeholder="Enter Blog Title..." >
							<h6 style="color:RED;" id="v_blog_title"></h6>
							<input type="text" class="form-control" name="blog_about"  value='<?php echo $row['about'];?>' placeholder="What is blog about?" >
							<h6 style="color:RED;" id="v_blog_about"></h6>
							
							<div class="col-lg-12 nopadding">
							<textarea id="txtEditor" name="txtEditor"></textarea>
							<textarea  name="edit"   hidden=""><?php echo $_POST["edit"];?></textarea>
							<h6 style="color:RED;"id="v_txtEditor"></h6>
							<textarea id="txtEditorContent" name="txtEditorContent" hidden=""></textarea>
							</div>
							<input type="text" class="form-control" name="tags" value='<?php echo $Tag;?>' placeholder="Enter Tags in the following format tag1,tag2,tag3 ex graph,dp,anything" value="">
							<h6 style="color:RED;"id="v_tags"></h6>
							 <div class="btn-group">
								<button id="SUBT" type="button"  class="btn btn-info" >Edit</button>
								<button type='button' class='btn btn-danger' data-toggle='modal' data-target='.bs-example-modal-sm'>Delete</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<?php $t=$controller->real_escape($row["content"]);?>

		<script language="javascript" type="text/javascript">
		$("#txtEditor").Editor();
		$('#txtEditor').Editor("setText",'<?php echo $t;?>');
		
		$(document).ready( function() {
		//$("#txtEditor").Editor();
		
		
		$("#SUBT").click(function(){
		$('#txtEditorContent').text($('#txtEditor').Editor("getText"));
		//alert('a7a');
		blog_validation();
		
		
		});

		});
		</script> 
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
				<form  method="POST">
				   <div class="well tcenter">  
					  <div class="form-group">
						<label for="message-text" class="control-label">are you sure you want to delete the post?</label>
				
					  </div>
					   </div>
					    <div class="btn-group">
					   <button type="submit" name='delete' value=<?php echo $_POST['edit'];?> class="btn btn-danger" value="Accept">Delete</button>
					   <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
						</div>
						
				</form>
			  </div>
			</div>
		  </div>
		</div>

</body>
</html>
