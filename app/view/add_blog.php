<?php  require_once("menu.php");  ?>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://localhost/our3/public/css/editor.css" type="text/css" rel="stylesheet"/>
	<script src="http://localhost/our3/public/js/ajax_validation.js"></script>
	<script src="http://localhost/our3/public/js/editor.js"></script>
	
</head>

<body>
		<div class="container-fluid">
			<div class="row">
				<div class="container">
					<div class="row">
						<form id="form" action="blogs.php" name="form" method="post">
							<input type="text" class="form-control" name="blog_title"  value="" placeholder="Enter Blog Title..." >
							<h6 style="color:RED;" id="v_blog_title"></h6>
							<input type="text" class="form-control" name="blog_about"  value="" placeholder="What is blog about?" >
							<h6 style="color:RED;" id="v_blog_about"></h6>
							<div class="col-lg-12 nopadding">
							<textarea id="txtEditor" name="txtEditor"></textarea>
							<textarea  name="edit"   hidden="">no</textarea>
							<h6 style="color:RED;"id="v_txtEditor"></h6>
							<textarea id="txtEditorContent" name="txtEditorContent" hidden=""></textarea>
							</div>
							<input type="text" class="form-control" name="tags" placeholder="Enter Tags in the following format tag1,tag2,tag3 ex graph,dp,anything" value="">
							<h6 style="color:RED;"id="v_tags"></h6>
							<button id="SUBT" type="button"  class="btn btn-info" >Post</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<br><br>

		<script language="javascript" type="text/javascript">
		
		$(document).ready( function() {
		$("#txtEditor").Editor();
		
		
		$("#SUBT").click(function(){
		$('#txtEditorContent').text($('#txtEditor').Editor("getText"));
		//alert('a7a');
		blog_validation();
		
		
		});

		});
		</script> 
</body>
</html>
