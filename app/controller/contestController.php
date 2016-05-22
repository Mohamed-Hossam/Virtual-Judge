<?php
	require_once('../model/contestModel.php');
	function cmp($a,$b)
		{
			if($a[1]!=$b[1])return ($a[1]>$b[1])?-1:1;
			return ($a[2]<$b[2])?-1:1;
		}
	
	
	class contestController 
	{
		private $MODEL;
		public $row;
		public function __construct()
		{
			$this->MODEL=new contestModel();	
			$this->row=$this->GET_contest();
		}
		
		public function delete_contest($cid)
		{
			$this->MODEL->delete_contest($cid);
		}
		
		public function insert_participate($cid,$type)
		{
			$this->MODEL->insert_participate($cid,$type);
		}
		
		public function delete_participate($cid)
		{
			$this->MODEL->delete_participate($cid);
		}
		
		public function GET_contest()
		{
			return $this->MODEL->GET_contest();
		}
		
		public function IS_INVITED()
		{
			return $this->MODEL->IS_INVITED();
		}
		
		public function is_registered()
		{
			return $this->MODEL->is_registered();
		}
		
		public function can_register()
		{
			$row=$this->row;
			if($this->is_registered()===true||($row['type']=='private'&&$this->IS_INVITED()==false&&$row['creator_Handle']!=$_COOKIE['user_handle'])||time()>$row['end'])
				return false;
			return true;
		}
		
		public function get_registrans(& $reg_map='non')
		{
			return $this->MODEL->get_registrans($reg_map);
		}
		
		public function get_problems()
		{
			return $this->MODEL->get_contest_problems();
		}
		
		public function get_Regional()
		{
			return $this->MODEL->get_Regional();
		}
		
		public function get_world()
		{
			return $this->MODEL->get_world();
		}
		
		public function get_statues(& $p,& $ar,& $next,& $result,$all='non')
		{
			return $this->MODEL->get_contest_statues($p,$ar,$next,$result,$all);
		}
		
		
		
		
		function get_standing()
		{
			$row=$this->row;
			$num=0;
			$pro_res=$this->get_problems();
			
			$pro_map=array();
			$reg_map=array();
			$num=3;
			while($p=mysqli_fetch_assoc($pro_res))
			{
				$pro_map[$p['problem_id']]=$num++;
			}
			$num-=3;
			
			$standing=array();
			$reg=$this->get_registrans($reg_map);
			
			
			
			
			
			for($i=0;$i<count($reg);$i++)
			{
				$one=array();
				array_push($one,$reg[$i]);
				array_push($one,0);
				array_push($one,0);
				for($j=0;$j<$num;$j++)array_push($one,array(0,0,''));
				
				array_push($standing,$one);
			}
			
			
			$one=array();
			array_push($one,0);
			array_push($one,0);
			array_push($one,0);
			for($j=0;$j<$num;$j++)array_push($one,array(0,0,''));
			array_push($standing,$one);
			
			
			$status=$this->get_statues($m,$m,$m,$m,'all');
			while($st=mysqli_fetch_assoc($status))
			{
		
				$temp=$standing[$reg_map[$st['user_Handle']]][$pro_map[$st['problem_id']]];
				
				if($st['Verdict']=='Submission Error'||$st['Verdict']=='Waiting'||$st['Verdict']=='Judge Error')continue;

				if($standing[$reg_map[$st['user_Handle']]][$pro_map[$st['problem_id']]][2]=='Accepted')continue;
				
				$standing[$reg_map[$st['user_Handle']]][$pro_map[$st['problem_id']]][2]="{$st['Verdict']}";

				
				if($st['Verdict']!='Accepted')
				{
					$standing[$reg_map[$st['user_Handle']]][$pro_map[$st['problem_id']]][1]++;
					
					$standing[count($reg)][$pro_map[$st['problem_id']]][1]++;
				}
				else
				{
					$standing[count($reg)][$pro_map[$st['problem_id']]][1]++;
					$standing[count($reg)][$pro_map[$st['problem_id']]][0]++;
					
					$standing[$reg_map[$st['user_Handle']]][$pro_map[$st['problem_id']]][0]=floor(($st['submission_date']-$row['start'])/60.0000) +$standing[$reg_map[$st['user_Handle']]][$pro_map[$st['problem_id']]][1]*20;
					$standing[$reg_map[$st['user_Handle']]][1]++;
					$standing[$reg_map[$st['user_Handle']]][2]+=$standing[$reg_map[$st['user_Handle']]][$pro_map[$st['problem_id']]][0];
				}
				
			}
			
			usort($standing,"cmp");
			return $standing;
		}
		public function DELETE_PROBLEM()
		{
			$this->MODEL->DELETE_PROBLEM();
		}
		
		public function get_problem(& $pro,& $cat)
		{
			$this->MODEL->get_problem($pro,$cat);
		}
			
	}
	
	$controller=new contestController;
	$row=$controller->row;
	$edit=$row['creator_Handle']==$_COOKIE['user_handle'];
	$add_problem=$edit&&($row['end']>time());
	$info=($row['creator_Handle']==$_COOKIE['user_handle']||$row['type']=='public'||($row['type']=='private'&&$controller->IS_INVITED()));
	$view_problem=($info&&(($row['start']<time()&&$row['end']>time()&&$controller->is_registered())||(time()>$row['end']&&$row['type']=='public')))||$row['creator_Handle']==$_COOKIE['user_handle'];
	$invite=($row['creator_Handle']==$_COOKIE['user_handle']&&$row['type']=='private');
	$register=$controller->can_register();
	$unregister=($controller->is_registered()&&$row['start']>time());
	$registrans=($row['creator_Handle']==$_COOKIE['user_handle']||$row['type']=='public'||($row['type']=='private'&&$controller->IS_INVITED()));
	$status=$edit||($row['start']<time()&&$row['end']>time()&&$controller->is_registered())||(time()>$row['end']&&$row['type']=='public');
	$standing=$status;
	$problem=$status;

?>