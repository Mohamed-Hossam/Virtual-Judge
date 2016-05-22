<?php
	require_once('../model/Model.php');
	
	class statusController 
	{
		private $MODEL;
		public $page=1;
		public $all_results;
		public $next_url="status.php?";
		public $contests;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			if(isset($_GET['page']))$this->page=$_GET['page'];
			$this->get_contests();
		}
		private function get_contests()
		{
			if(isset($_GET["Access"]))
			{
				if($_GET["Access"]!="All"){
					$b=urlencode($_GET["Access"]);
					$this->next_url.="&Access={$b}";
				}
			}
			if(isset($_GET["status"]))
			{
				$b=urlencode($_GET["status"]);
					$this->next_url.="&status={$b}";
			}
			if(isset($_GET["Fcontest"]))
			{
				$b=urlencode($_GET["Fcontest"]);
				$this->next_url.="&Fcontest={$b}";	
			}
			if(isset($_GET["Fuser"]))
			{
				$b=urlencode($_GET["Fuser"]);
				$this->next_url.="&Fuser={$b}";
			}
			
			$this->next_url.="&page=";
			$offset=($this->page-1)*20;

			$this->all_results=mysqli_num_rows($this->MODEL->get_contests($_GET));
		
			$this->contests=$this->MODEL->get_contests($_GET,$offset);
			
		}
	}
	$controller=new statusController;

?>