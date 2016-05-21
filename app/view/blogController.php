<?php
	
	require_once('../model/Model.php');

?>
<?php

	class blogController 
	{
		private $MODEL;
		public $page=1;
		public $all_results;
		public $next_url="blogs.php?";
		public $blogs;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();		
		}
		public function get_blogs()
		{
			if(isset($_GET['page']))$this->page=$_GET['page'];
			$query="SELECT * FROM blog WHERE 1=1";
			if(isset($_GET['search']))
			{
				$b=urlencode($_GET["search"]);
				$this->next_url.="&search={$b}";
			}	
			$this->next_url.="&page=";
			$offset=($this->page-1)*10;
		
			$this->all_results=mysqli_num_rows($this->MODEL->get_blogs($_GET));
		
			$this->blogs=$this->MODEL->get_blogs($_GET,$offset);
			
		}
		
		public function get_blog($bid)
		{
			return $this->MODEL->get_blog($bid);
		}
		
		public function get_comment($cid)
		{
			return $this->MODEL->get_comment($cid);
		}
		
		public function get_blog_tags($bid)
		{
			return $this->MODEL->get_blog_tags($bid);
		}
		
		public function get_reply($cid)
		{
			return $this->MODEL->get_reply($cid);
		}
		public function delete_blog($bid)
		{
			$this->MODEL->delete_blog($bid);
		}
		
		public function real_escape($str)
		{
			return $this->MODEL->real_escape($str);
		}
	}
	$controller=new blogController;

?>