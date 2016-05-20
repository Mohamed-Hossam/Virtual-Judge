<?php
	
	require_once('../model/Model.php');

?>
<?php

	class problemController 
	{
		private $MODEL;
		public $problem;
		public $category;
		public $max_problem_id;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			if(!isset($_GET['id']))
			{
				header("Location: "."problems.php");
				exit;
			}
			$this->max_problem_id=$this->MODEL->get_max_problem_id();
			if($this->max_problem_id<$_GET['id'])
			{
				header("Location: "."problems.php");
				exit;
			}
			$this->get_problem();
		}
		private function get_problem()
		{
			$this->problem=$this->MODEL->get_problem($_GET['id']);
			$this->category=$this->MODEL->get_problem_category($_GET['id']);
			
		}
	}
	$controller=new problemController;

?>