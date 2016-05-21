<?php
	
	require_once('../model/Model.php');

?>
<?php

	class replayController 
	{

		public $ret=array();
		private $MODEL;
		private $TAG;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			$this->ret['statue']='OK';
			
			$this->ret['reply']=$this->ret['c']="";
			$this->validate_reply();
			if($this->ret['statue']=='OK')
			{
				$this->insert_reply();
			}
			echo json_encode($this->ret);
		}
		public function validate_reply()
		{
			if(!isset($_POST['reply']))
			{$this->ret['statue']='NOT';return;}
			$reply=trim($_POST['reply']);
			if(strlen($reply)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['reply']="reply must be filled";
				return;
			}
			if(strlen($reply)>2000)
			{
				$this->ret['statue']='NOT';
				$this->ret['reply']= "max length 2000";
				return;
			}
		}
		public function insert_reply()
		{
			$date = date('M d, y')." at ".date('h:ia');
			$this->MODEL->insert_replay($_POST);
			$this->ret['c']="<div class='media'>
							<a class='pull-left' href='#'>
								<img class='img-responsive user-photo' src='https://ssl.gstatic.com/accounts/ui/avatar_2x.png' width='64px' height='64px'>
							</a>
							<div class='media-body'>
								<h4 class='media-heading'><a href='{$_COOKIE['user_handle']}'>{$_COOKIE['user_handle']}</a>
									<small>{$date}</small>
								</h4>
								{$_POST["reply"]}
							</div>
						</div>
						";
		}
	}
	$controller=new replayController;

?>