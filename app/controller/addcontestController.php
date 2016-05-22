<?php
	
	require_once('../model/Model.php');
	require_once('addcontestController.php');

?>
<?php

	class addcontestController 
	{
		private $MODEL;
		public $ret=array();
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			$this->ret['contest_name']=$this->ret['end']=$this->ret['start']="";
			$this->ret['statue']='OK';
			
			if(!isset($_POST['type']))
			$this->ret['statue']='NOT';
			
			
			$this->validate_contest_name();
			$this->validate_time();
			if($this->ret['statue']=='OK')
			{
				$this->MODEL->INSERT_contest();
			}
			echo json_encode($this->ret);
		}
		function validate_contest_name()
		{
			if(!isset($_POST['contest_name']))
			{$this->ret['statue']='NOT';return;}
			$contest_name=trim($_POST['contest_name']);
			if(strlen($contest_name)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['contest_name']="contest name must be filled";
				return;
			}
			if(strlen($contest_name)<4)
			{
				$this->ret['statue']='NOT';
				$this->ret['contest_name']= "min length 4";
				return;
			}
			if(strlen($contest_name)>100)
			{
				$this->ret['statue']='NOT';
				$this->ret['contest_name']= "max length 100";
				return;
			}
		}
		function validate_time()
		{
			$x=0;
			if(!isset($_POST['date'])||!isset($_POST['hour'])||!isset($_POST['min']))
			{$this->ret['statue']='NOT';return;}
			if(strlen(trim($_POST['date']))==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['start']="Start Date must be filled";
				goto NEXT;
			}
			$start=strtotime($_POST["date"])+$_POST["hour"]*60*60+$_POST["min"]*60-time();
			if($start<300)
			{
				$this->ret['statue']='NOT';
				$this->ret['start']="Start Date Must be 10 min from now";
				goto NEXT;
			}
			$x=1;
			NEXT:;
			if(!isset($_POST['Edate'])||!isset($_POST['Ehour'])||!isset($_POST['Emin']))
			{$this->ret['statue']='NOT';return;}
			if(strlen(trim($_POST['Edate']))==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['end']="End Date must be filled";
				return;
			}
			if($x==0)return;
			$end=strtotime($_POST["Edate"])+$_POST["Ehour"]*60*60+$_POST["Emin"]*60-time();
			if($end-$start<300)
			{
				$this->ret['statue']='NOT';
				$this->ret['end']="End Date Must be 10 min from start date";
				return;
			}
		}
	}
	$controller=new addcontestController;

?>