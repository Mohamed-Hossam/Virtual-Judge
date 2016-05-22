<?php
	
	require_once('../model/contestModel.php');

?>
<?php

	class inviteController 
	{

		public $ret=array();
		private $MODEL;
		private $row;
		public function __construct()
		{
			$this->MODEL=new contestModel('no');
			$this->ret['statue']='OK';
			$this->ret['name']="";
			$this->validate_contest();
			$this->validate_name();
			echo json_encode($this->ret);
		}
		private function validate_contest()
		{
			if(!isset($_POST['id'])){$this->ret['statue']='NOT';echo json_encode($this->ret);exit;}
			$result=$this->MODEL->gt_contest($_POST['id']);
			$ar=mysqli_num_rows($result);
			if($ar==0){$this->ret['statue']='NOT';echo json_encode($this->ret);exit;}
			$row=mysqli_fetch_assoc($result);
			if($row['creator_Handle']!=$_COOKIE['user_handle'])
			{$this->ret['statue']='NOT';echo json_encode($this->ret);exit;}
			$this->row=$row;
		}
		function validate_name()
		{
			if(!isset($_POST['name']))
			{$this->ret['statue']='NOT';return;}
			$name=trim($_POST['name']);
			if(strlen($name)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['name']="user name must be filled";
				return;
			}
			if($name==$this->row['creator_Handle'])
			{
				$this->ret['statue']='NOT';
				$this->ret['name']="you can't invite your self";
				return;
			}
		
			
			if($this->MODEL->is_handle_exist($name)==false)
			{
				$this->ret['statue']='NOT';
				$this->ret['name']="Handle not found";
				return;
			}
			
			if($this->MODEL->is_handle_invited($name,$_POST['id'])==true)
			{
				$this->ret['statue']='NOT';
				$this->ret['name']="{$name} is already invited";
				return;
			}
			
			$this->MODEL->invite_user($name,$_POST['id']);
		}
	}
	$controller=new inviteController;

?>