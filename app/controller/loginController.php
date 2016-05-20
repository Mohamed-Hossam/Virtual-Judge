<?php
	
	require_once('../model/Model.php');

?>
<?php

	class loginController 
	{

		public $ret=array();
		private $MODEL;

		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			$this->ret['statue']='OK';
			$this->ret['Handle']="";
			$this->ret['Password']="";
			$this->validate_Handle();
			$this->validate_Password();
			if($this->ret['statue']=='OK')
			{
				setcookie("user_handle",$_POST["Handle"],time()+60*60*24*7,"/our3");
			}
			echo json_encode($this->ret);
		}
		private function validate_Handle()
		{
			if(!isset($_POST['Handle']))
			{$this->ret['statue']='NOT';return;}
			$_POST['Handle']=trim($_POST['Handle']);
			$handle=$_POST['Handle'];
			if(strlen($handle)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['Handle']="handle must be filled";
				return;
			}
			if(!$this->MODEL->is_handle_exist($handle))
			{
				$this->ret['statue']='NOT';
				$this->ret['Password']= "handle or password is wrong";
				return;
			}
		}
		private function generate_salt($length)
		{
			$unique_Random_string=md5(uniqid(mt_rand(),true));
			$base64_string =base64_encode($unique_Random_string);
			$modified_base64_string =str_replace('+','.',$base64_string);
			$salt=substr($modified_base64_string,0,$length);
			return $salt;
		}
		private function password_encrpt($password)
		{
			
			$hash_format="$2y$10$";
			$salt_length=22;
			$salt =$this->generate_salt($salt_length);
			$format_and_salt=$hash_format.$salt;
			$hash =crypt($password,$format_and_salt);
			return $hash;
		}
		
		private function validate_Password()
		{
			if(!isset($_POST['Password']))
			{$this->ret['statue']='NOT';return;}
			$password=trim($_POST["Password"]);
			if(strlen($password)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['Password']="password must be filled";
				return;
			}
			if(strlen($this->ret['Password'])!=0)return;
			if(!$this->MODEL->check_password($_POST['Handle'],$password))
			{
				$this->ret['statue']='NOT';
				$this->ret['Password']= "handle or password is wrong";
				return;
			}
		}
	}
	$controller=new loginController;

?>