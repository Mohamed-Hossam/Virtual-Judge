
<?php
 require_once('const.php');
 if(isset($_GET["id"]))
 {
	 if($_GET["id"]==0&&isset($_COOKIE["user_handle"]))
	 {
		setcookie("user_handle",null);
	 }
 }
 else 
 if(isset($_COOKIE["user_handle"]))
 {
	 header("Location: "."app/view/home.php");
     exit;
 }
?>



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
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="public/css/Reg_Sign.css">
<!-- All the files that are   -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="public/js/ajax_validation.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<head>


<!-- Where all the magic happens -->
<!-- LOGIN FORM -->




<div class="text-center" style="text-align:center">
	<div class="logo">login</div>
	<!-- Main Form -->
	
	<div class="login-form-1">
		<form id="L" name="Lform" action="app/view/home.php" method="post" id="login-form" class="text-left">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only">Username<br></label>
						<input type="text" class="form-control"    id="Handle"    value="" placeholder="           Enter Username"><h6 style="color:RED;"id="v_Handle"></h6>
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Password<br></label>
						<input type="password" class="form-control"   id="Password" value="" placeholder="           Enter Password"><h6 style="color:RED;"id="v_Password"></h6>
					</div>
				</div>
				<button type="button" onclick="login_validation()" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
		
		</form>
	</div>
</div>

<!-- REGISTRATION FORM -->
<div class="text-center" style="text-align:center">
	<div class="logo">register</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form id="R" name="Rform"  action="app/view/home.php" method="POST" >
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						Handle<br>
						<input type="text"  class="form-control" id="handle"   placeholder="only alpha,numbers,(_)" ><h6 style="color:RED;"id="v_handle"></h6>
					</div>
					
					<div class="form-group">
						First name<br>
						<input type="text" class="form-control" name="firstname"   placeholder="only alpha"><h6 style="color:RED;"id="v_firstname"></h6>
					</div>
					<div class="form-group">
						Last name<br>
						<input type="text" class="form-control" name="lastname"   placeholder="only alpha"><h6 style="color:RED;"id="v_lastname"></h6>
					</div>
					
					<div class="form-group">
						Enter Password<br>
						<input type="password" class="form-control" name="password"   placeholder="Enter Your Password"><h6 style="color:RED;"id="v_password"></h6>
					</div>
					<div class="form-group">
						Confirm Password<br>
						<input type="password" class="form-control" name="Cpassword"   placeholder="Confirm Your Password"><h6 style="color:RED;"id="v_Cpassword"></h6>
					</div>
					<div class="form-group">
						Email<br>
						<input type="text" class="form-control" name="email"   placeholder="Enter Valid Email"><h6 style="color:RED;"id="v_email"></h6>
					</div>
					<div class="form-group">
						School<br>
						<input type="text" class="form-control"  name="school"  placeholder="Enter your School"><h6 style="color:RED;"id="v_school"></h6>
					</div>

				</div>
				<button type="button" onclick="register_validation()"  class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>
</html>





