
<?php
$db_host="localhost";
$db_user="root";
$db_password="Moha4422med";
$db_name="_OJ";
$db=mysqli_connect($db_host,$db_user,"Moha4422med",$db_name);
if(mysqli_connect_errno())
{
	die("connection failed " . mysqli_connect_error() ." ". mysqli_connect_errno());
}
function redirect($to){
	
    header("Location: ".$to);
    exit;
}
function isset2($x)
{
    if(!isset($x))return 0;
	if($x=="")return 0;
	return 1;
}
?>