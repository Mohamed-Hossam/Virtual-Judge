<?php
	
	require_once('../model/contestModel.php');

?>
<?php

	class editcontestController 
	{

		public $ret=array();
		private $MODEL;
		private $row;
		public function __construct()
		{
			$this->MODEL=new contestModel('no');
			$this->ret['statue']='OK';
			
			if(!isset($_POST['type']))
			$this->ret['statue']='NOT';
		
			$this->ret['contest_name']=$this->ret['end']=$this->ret['start']="";
			$this->validate_contest();
			$this->validate_contest_name();
			$this->validate_time();
			if($this->ret['statue']=='OK')
			{
				$this->MODEL->UPDATE_contest($_POST);
			}
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
			
			$start=strtotime($_POST["date"])+$_POST["hour"]*60*60+$_POST["min"]*60;
			$will=$this->row['start'];
			if($start==$this->row['start'])goto NEXT;
			//echo $start." ".$row['start'];exit;
			if($this->row['start']<time())
			{
				$this->ret['statue']='NOT';
				$this->ret['start']="Start Date uneditable because contest is already started";
				goto NEXT;
			}
			if($start-time()<300)
			{
				$this->ret['statue']='NOT';
				$this->ret['start']="Start Date Must be 10 min from now";
				goto NEXT;
			}
			
			$will=$start;
		
			NEXT:;
			if(!isset($_POST['Edate'])||!isset($_POST['Ehour'])||!isset($_POST['Emin']))
			{$this->ret['statue']='NOT';return;}
			if(strlen(trim($_POST['Edate']))==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['end']="End Date must be filled";
				return;
			}
			$end=strtotime($_POST["Edate"])+$_POST["Ehour"]*60*60+$_POST["Emin"]*60;
			if($end==$this->row['end'])goto END;
			//echo $end." ".$row['end'];exit;
			if($end-time()<300)
			{
				$this->ret['statue']='NOT';
				$this->ret['end']="End Date Must be 10 min from now";
				return;
			}
			if($end-$will<300)
			{
				$this->ret['statue']='NOT';
				$this->ret['end']="End Date Must be 10 min from start date";
				return;
			}
			END:;
			if($end-$will<300)
			{
				$this->ret['statue']='NOT';
				$this->ret['start']="End Date Must be 10 min from start date";
				return;
			}
		}
		
	}
	$controller=new editcontestController;

?>