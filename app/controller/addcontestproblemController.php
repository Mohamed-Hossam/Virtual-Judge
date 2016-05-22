<?php
	
	require_once('../model/contestModel.php');

?>
<?php

	class addcontestproblemController 
	{

		public $ret=array();
		private $MODEL;
		public function __construct()
		{
			$this->MODEL=new contestModel('no');
			$this->ret['statue']='OK';
			$this->ret['error']="";
			
			$this->validate_contest();
			$this->validate();
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
		}
		function validate_specific_problem()
		{
			if(!isset($_POST['problem_search']))
			{$this->ret['statue']='NOT';return;}
			$problem_search=trim($_POST['problem_search']);
			if(strlen($problem_search)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['error']="problem name must be filled";
				return;
			}
			$temp=explode('-',$problem_search);
			if(!isset($temp[0])||!isset($temp[1])||!isset($temp[2]))
			{
				$this->ret['statue']='NOT';
				$this->ret['error']="problem not found , please choose problem from the list";
				return;
			}
			$j=trim($temp[0]);
			$i=trim($temp[1]);	
			$result=$this->MODEL->is_problem_in_database($i,$j);
			if($result==false)
			{
				$this->ret['statue']='NOT';
				$this->ret['error']="problem not found , please choose problem from the list";
				return;
			}
			
			$id=mysqli_fetch_assoc($result)['problem_id'];
			
			if($this->MODEL->is_problem_in_contest($_POST['id'],$id)==true)return;
						
			$this->MODEL->insert_problem($id,$_POST['id']);		
		}
		public function validate_random_problem()
		{
			if(!isset($_POST['problem_num'])||!isset($_POST['level'])||!isset($_POST['operation']))
			{$this->ret['statue']='NOT';return;}
			$problem_num=trim($_POST['problem_num']);
			if(strlen($problem_num)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['error']="problem number must be filled";
				return;
			}
			if($problem_num<1)
			{
				$this->ret['statue']='NOT';
				$this->ret['error']="min number of problems in one time is 1";
				return;
			}
			if($problem_num>10)
			{
				$this->ret['statue']='NOT';
				$this->ret['error']="max number of problems in one time is 10";
				return;
			}
			for($i=0;$i<$problem_num;$i++)
			{
				$result=$this->MODEL->get_random_problem($_POST['id'],$_POST['operation'],$_POST['level']);
				while($row=mysqli_fetch_array($result))
				{
					$this->MODEL->insert_problem($row['problem_id'],$_POST['id']);	
				}
			}
		}
		public function validate()
		{
			if(!isset($_POST['mode'])){$ret['statue']='NOT';echo json_encode($this->ret);exit;}
			if($_POST['mode']=='sp')
			{
				$this->validate_specific_problem();
				return;
			}
			if($_POST['mode']=='ran')
			{
				$this->validate_random_problem();
				return;
			}
			if($_POST['mode']=='r')
			{
				$this->MODEL->insert_regional($_POST['id'],$_POST['regional']);
				return;
			}
			if($_POST['mode']=='w')
			{
				$this->MODEL->insert_world($_POST['id'],$_POST['world']);
				return;
			}
			$ret['statue']='NOT';
		}
	}
	$controller=new addcontestproblemController;

?>