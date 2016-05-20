<?php
	
	require_once('../model/Model.php');

?>


<?php

	class registerController 
	{

		public $ret=array();
		private $MODEL;

		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			$this->ret['statue']='OK';
			$this->ret['handle']="";
			$this->ret['firstname']="";
			$this->ret['lastname']="";
			$this->ret['password']="";
			$this->ret['Cpassword']="";
			$this->ret['email']="";
			$this->ret['school']="";
			$this->validate_handle();
			$this->validate_firstname();
			$this->validate_lastname();
			$this->validate_password();
			$this->validate_Cpassword();
			$this->validate_email();
			$this->validate_school();
			if($this->ret['statue']=='OK')
			{
				$date = date('M d, y');
				$hash = $this->password_encrpt($_POST["password"]);
				$contestant=array();
				$contestant['Handle']=$_POST["handle"];
				$contestant['Fname']=$_POST["firstname"];
				$contestant['Lname']=$_POST["lastname"];
				$contestant['Hahsed_password']=$hash;
				$contestant['Email']=$_POST["email"];
				$contestant['Type']='not-admin';
				$contestant['Register_Date']=$date;
				$contestant['school']=$_POST["school"];
				$this->MODEL->insert_contestant($contestant);
				setcookie("user_handle",$_POST["handle"],time()+60*60*24*7,"/our3");
			}
			echo json_encode($this->ret);
		}
		private function validate_handle()
		{
			if(!isset($_POST['handle']))
			{$this->ret['statue']='NOT';return;}
			$handle=trim($_POST['handle']);
			if(strlen($handle)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['handle']="handle must be filled";
				return;
			}
			if(strlen($handle)<4)
			{
				$this->ret['statue']='NOT';
				$this->ret['handle']= "min length 4";
				return;
			}
			if(strlen($handle)>20)
			{
				$this->ret['statue']='NOT';
				$this->ret['handle']= "max length 20";
				return;
			}
			for($var=0;$var<strlen($handle);++$var)
			{
				if(!(($handle[$var]<='z'&&$handle[$var]>='a')||
					($handle[$var]<='Z'&&$handle[$var]>='A')||
					($handle[$var]<='9'&&$handle[$var]>='0')||
					$handle[$var]==='_'))
				{
					$this->ret['statue']='NOT';
					$this->ret['handle']= "only alpha,numbers and (_)";
					return;
				}
			}
			
			if($this->MODEL->is_handle_exist($handle))
			{
				$this->ret['statue']='NOT';
				$this->ret['handle']= "handle is taken";
				return;
			}
		}
		private function validate_firstname()
		{
			if(!isset($_POST['firstname']))
			{$this->ret['statue']='NOT';return;}
			$firstname=trim($_POST["firstname"]);
			if(strlen($firstname)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['firstname']="firstname must be filled";
				return;
			}
			if(strlen($firstname)<4)
			{
				$this->ret['statue']='NOT';
				$this->ret['firstname']= "min length 4";
				return;
			}
			if(strlen($firstname)>20)
			{
				$this->ret['statue']='NOT';
				$this->ret['firstname']= "max length 20";
				return;
			}
			for($var=0;$var<strlen($firstname);++$var)
			{
				if(!(($firstname[$var]<='z'&&$firstname[$var]>='a')||($firstname[$var]<='Z'&&$firstname[$var]>='A')||$firstname[$var]=='-'))
				{
					$this->ret['statue']='NOT';
					$this->ret['firstname']="only alpha and (-)";
					return;
				}
			}
		}
		private function validate_lastname()
		{
			if(!isset($_POST['lastname']))
			{$this->ret['statue']='NOT';return;}
			$lastname=trim($_POST["lastname"]);
			if(strlen($lastname)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['lastname']="lastname must be filled";
				return;
			}
			if(strlen($lastname)<4)
			{
				$this->ret['statue']='NOT';
				$this->ret['lastname']= "min length 4";
				return;
			}
			if(strlen($lastname)>20)
			{
				$this->ret['statue']='NOT';
				$this->ret['lastname']= "max length 20";
				return;
			}
			for($var=0;$var<strlen($lastname);++$var)
			{
				if(!(($lastname[$var]<='z'&&$lastname[$var]>='a')||($lastname[$var]<='Z'&&$lastname[$var]>='A')||$lastname[$var]=='-'))
				{
					$this->ret['statue']='NOT';
					$this->ret['lastname']="only alpha and (-)";
					return;
				}
			}
		}
		private function validate_password()
		{
			if(!isset($_POST['password']))
			{$this->ret['statue']='NOT';return;}
			$password=trim($_POST["password"]);
			if(strlen($password)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['password']="password must be filled";
				return;
			}
			if(strlen($password)<4)
			{
				$this->ret['statue']='NOT';
				$this->ret['password']= "min length 4";
				return;
			}
			if(strlen($password)>20)
			{
				$this->ret['statue']='NOT';
				$this->ret['password']= "max length 20";
				return;
			}
		}
		private function validate_Cpassword()
		{
			if(!isset($_POST['Cpassword']))
			{$this->ret['statue']='NOT';return;}
			$Cpassword=trim($_POST["Cpassword"]);
			if(strlen($Cpassword)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['Cpassword']="confirm password must be filled";
				return;
			}
			if(isset($_POST["password"]))
			{
				if($Cpassword!=$_POST["password"])
				{
					$this->ret['statue']='NOT';
					$this->ret['Cpassword']="confirm password not match";
					return;
				}
			}
		}
		private function validate_email()
		{
			if(!isset($_POST['email']))
			{$this->ret['statue']='NOT';return;}
			$email=trim($_POST['email']);
			if(strlen($email)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['email']="email must be filled";
				return;
			}
			$valid=preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$email);
			if(!$valid)
			{
				$this->ret['statue']='NOT';
				$this->ret['email']="email error format";
				return;
			}
			
			if($this->MODEL->is_email_exist($email))
			{
				$this->ret['statue']='NOT';
				$this->ret['email']="email is used before";
				return;
			}
		
		}
		private function validate_school()
		{
			if(!isset($_POST['school']))
			{$this->ret['statue']='NOT';return;}
			$school=trim($_POST["school"]);
			if(strlen($school)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['school']="school must be filled";
				return;
			}
			if(strlen($school)<3)
			{
				$this->ret['statue']='NOT';
				$this->ret['school']= "min length 4";
				return;
			}
			if(strlen($school)>20)
			{
				$this->ret['statue']='NOT';
				$this->ret['school']= "max length 20";
				return;
			}
			for($var=0;$var<strlen($school);++$var)
			{
				if(!(($school[$var]<='z'&&$school[$var]>='a')||($school[$var]<='Z'&&$school[$var]>='A')||$school[$var]=='-'))
				{
					$this->ret['statue']='NOT';
					$this->ret['school']="only alpha and (-)";
					return;
				}
			}
		}
		private function generate_salt($length){
			$unique_Random_string=md5(uniqid(mt_rand(),true));
			$base64_string =base64_encode($unique_Random_string);
			$modified_base64_string =str_replace('+','.',$base64_string);
			$salt=substr($modified_base64_string,0,$length);
			return $salt;
		}
		private function password_encrpt($password){

			$hash_format="$2y$10$";
			$salt_length=22;
			$salt =$this->generate_salt($salt_length);
			$format_and_salt=$hash_format.$salt;
			$hash =crypt($password,$format_and_salt);
			return $hash;
		}
		
	}
	$controller=new registerController;

?>