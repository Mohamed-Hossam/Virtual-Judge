<?php
	
	require_once('../model/Model.php');

?>
<?php

	class problemsController 
	{
		private $MODEL;
		public $page=1;
		public $all_results;
		public $next_url="problems.php?";
		public $problems;
		public $category;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			if(isset($_GET['page']))$this->page=$_GET['page'];
			$this->get_problems();
		}
		private function get_problems()
		{
			
			
			if(isset($_GET["cat"]))
			{
				if($_GET["cat"]!="All")
				{
					$b=urlencode($_GET["cat"]);
					$this->next_url.="&cat={$b}";
				}
			}
		
			if(isset($_GET["Fproblrm"]))
			{
				$b=urlencode($_GET["Fproblrm"]);
				$this->next_url.="&Fproblrm={$b}";	
			}
			if(isset($_GET["Fsource"]))
			{
				$b=urlencode($_GET["Fsource"]);
				$this->next_url.="&Fsource={$b}";
			}
			
			if(isset($_GET["OJ"]))
			{
				if($_GET["OJ"]!="All")
				{
					$this->next_url.="&OJ={$_GET["OJ"]}";
				}
			}
			
			$this->next_url.="&page=";
			$offset=($this->page-1)*50;
			//echo $offset."<br>";
			$this->all_results=mysqli_num_rows($this->MODEL->get_problems($_GET));
		
			$this->problems=$this->MODEL->get_problems($_GET,$offset);
			
			$this->category=$this->MODEL->get_category($_GET,$offset);
		}
		public function count_accepted_submission($problem_id)
		{
			return $this->MODEL->count_accepted_submission($problem_id);
		}
		
		public function count_all_submission($problem_id)
		{
			return $this->MODEL->count_all_submission($problem_id);
		}
	}
	$controller=new problemsController;

?>