<?php
	
	require_once('../model/Model.php');
	require_once('postsoutionController.php');

?>
<?php

	class submitController 
	{
		private $MODEL;
		public $ret=array();
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			$this->ret['statue']='OK';
			$this->ret['solution']="";
			$this->validate_solution();
			if($this->ret['statue']=='OK')
			{
				set_time_limit(0);
					
				$sub=array(
				'TIME'=>'0',
				'Verdict'=>'Waiting', 		
				'Soultion'=>'',  
				'Language'=>'',
				'submission_date'=>time(),
				'memory'=>'0',
				'user_Handle'=>$_COOKIE['user_handle'], 
				'Problem_id'=>'', 	
				);
				$curl =new postsoutionController($sub,$_POST['oj']);
				$this->MODEL->insert_submission($sub);
			}
			echo json_encode($this->ret);
		}
		private function validate_solution()
		{
			if(!isset($_POST['solution']))
			{$this->ret['statue']='NOT';return;}
			$solution=trim($_POST['solution']);
			if(strlen($solution)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['solution']="solution must be filled";
				return;
			}
			$f = fopen("cookie/file.txt", "w") or die("Unable to open file!");
			fwrite($f,$solution);
			fclose($f);
			$size=filesize('cookie/file.txt');
			if($size>100*1000)
			{
				$this->ret['statue']='NOT';
				$this->ret['solution']="solution length is too big";
				return;
			}
		}
	}
	$controller=new submitController;

?>