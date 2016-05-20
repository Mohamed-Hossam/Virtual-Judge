<?php
	require_once('../model/Model.php');
	
	class statusController 
	{
		private $MODEL;
		public $page=1;
		public $all_results;
		public $next_url="status.php?";
		public $status;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			if(isset($_GET['page']))$this->page=$_GET['page'];
			$this->get_status();
		}
		private function get_status()
		{
			if(isset($_GET["lang"]))
			{
				if($_GET["lang"]!="All"){
					$b=urlencode($_GET["lang"]);
					$this->next_url.="&lang={$b}";
				}
			}
			if(isset($_GET["verdict"]))
			{
				$b=urlencode($_GET["verdict"]);
				$this->next_url.="&verdict={$b}";
			}
			if(isset($_GET["Fproblrm"]))
			{
				$b=urlencode($_GET["Fproblrm"]);
				$this->next_url.="&Fproblrm={$b}";
			}
			if(isset($_GET["Fuser"]))
			{
					$b=urlencode($_GET["Fuser"]);
					$this->next_url.="&Fuser={$b}";
			}
			
			$this->next_url.="&page=";
			$offset=($this->page-1)*20;

			$this->all_results=mysqli_num_rows($this->MODEL->get_status($_GET));
		
			$this->status=$this->MODEL->get_status($_GET,$offset);
			
		}
	}
	$controller=new statusController;

?>