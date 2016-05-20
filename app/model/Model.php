<?php
	function redirect($to){
	
    header("Location: ".$to);
    exit;
	}
	class MysqlDatabase
	{
		protected $db;
		
		
		private function __construct($db_host="localhost",$db_user="root",$db_password="Moha4422med",$db_name="_OJ")
		{
			$this->open_connection($db_host,$db_user,$db_password,$db_name);
		}
		
		public static function getMysqlDatabase()
		{
			static $MysqlDatabase_ins=NULL;
			if($MysqlDatabase_ins==NULL)
				$MysqlDatabase_ins=new MysqlDatabase;
			return $MysqlDatabase_ins;
		}
		
		
		private function open_connection($db_host="localhost",$db_user="root",$db_password="Moha4422med",$db_name="OJ")
		{
			$this->db=mysqli_connect($db_host,$db_user,$db_password,$db_name);
			if(mysqli_connect_errno())
			{
				die("connection failed " . mysqli_connect_error() ." ". mysqli_connect_errno());
			}
		}
		
		public function insert_contestant($data)
		{
			foreach($data as $key=>$value)$data[$key]=mysqli_real_escape_string($this->db,$value);
			$query="INSERT INTO user";
			$query.="(Handle,Fname,Lname,Hahsed_password,Email,Type,Register_Date,school)";
			$query.="VALUES('{$data['Handle']}','{$data['Fname']}','{$data['Lname']}',
			'{$data['Hahsed_password']}','{$data["Email"]}','{$data["Type"]}','{$data["Register_Date"]}','{$data["school"]}')";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
		}
		public function is_handle_exist($handle)
		{
			$handle=mysqli_real_escape_string($this->db,$handle);
			$query="SELECT Handle FROM user WHERE Handle='{$handle}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			if(mysqli_num_rows($result)!=0)
			{
				return true;
			}
			return false;
		}
		
		public function check_password($handle,$pass)
		{
			$handle=mysqli_real_escape_string($this->db,$handle);
			$query="SELECT Hahsed_password FROM user WHERE Handle='{$handle}'";
			$result=mysqli_query($this->db,$query);
			if(!$result){return false;};
			$row=mysqli_fetch_row($result);
			$format_and_salt=substr($row[0],0,29);
			$hash =crypt($pass,$format_and_salt);
			return $row[0]===$hash;
		}
		
		
		
		public function is_email_exist($email)
		{
			$email=mysqli_real_escape_string($this->db,$email);
			$query="SELECT Email FROM user WHERE Email='{$email}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			if(mysqli_num_rows($result)!=0)
			{
				return true;
			}
			return false;
		}
		
		
		public function close_connection()
		{
			if(isset($this->db))
			{
				mysqli_close($this->db);
				unset($this->db);
			}
		}
		
	}
?>