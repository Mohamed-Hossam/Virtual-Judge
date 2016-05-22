<?php
	
	require_once('../model/contestModel.php');

?>
<?php

	class registerteamController 
	{
		public $ret=array();
		private $MODEL;
		public function __construct()
		{
			$this->MODEL=new contestModel('no');
			$this->ret['statue']='OK';
			$this->ret['team_name']="";
			$this->validate_team_name();
			echo json_encode($this->ret);
		}
		public function validate_team_name()
		{
			if(!isset($_POST['team_name']))
			{$this->ret['statue']='NOT';return;}
			$team_name=trim($_POST['team_name']);
			if(strlen($team_name)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['team_name']="team name must be filled";
				return;
			}
			
			if($this->MODEL->is_team_exist($team_name)==false)
			{
				$this->ret['statue']='NOT';
				$this->ret['team_name']="Team name not found";
				return;
			}
		

			if($this->MODEL->is_user_member_in_team($team_name)==false)
			{
				$this->ret['statue']='NOT';
				$this->ret['team_name']="You aren't member in this team";
				return;
			}
			
			if(!isset($_POST['id'])){$this->ret['statue']='NOT';return;}
			
			$this->MODEL->insert_participate($_POST['id'],$team_name);
		}
	}
	$controller=new registerteamController;

?>