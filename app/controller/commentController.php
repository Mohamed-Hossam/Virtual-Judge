<?php
	
	require_once('../model/Model.php');

?>
<?php

	class commentController 
	{

		public $ret=array();
		private $MODEL;
		private $TAG;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			$this->ret['statue']='OK';
			
			$this->ret['comment']=$this->ret['c']="";
			$this->validate_comment();
			if($this->ret['statue']=='OK')
			{
				$this->insert_comment();
			}
			echo json_encode($this->ret);
		}
		public function validate_comment()
		{
			if(!isset($_POST['comment']))
			{$this->ret['statue']='NOT';return;}
			$comment=trim($_POST['comment']);
			if(strlen($comment)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['comment']="Comment must be filled";
				return;
			}
			if(strlen($comment)>2000)
			{
				$this->ret['statue']='NOT';
				$this->ret['comment']= "max length 2000";
				return;
			}
		}
		function INSERT_comment()
		{
			$date = date('M d, y')." at ".date('h:ia');
			$last_id = $this->MODEL->insert_comment($_POST);
			$comment="<div class='media'>
						<a class='pull-left' href='user_info.php?handle={$_COOKIE['user_handle']}'>
								<img class='img-responsive user-photo' src='https://ssl.gstatic.com/accounts/ui/avatar_2x.png' width='64px' height='64px'>
							</a>
							<div class='media-body'>
								<h4 class='media-heading'><a href='user_info.php?handle={$_COOKIE['user_handle']}'>{$_COOKIE['user_handle']}</a>
									<small>{$date}</small>
								</h4>
								{$_POST['comment']}
								<div id={$last_id}></div>

								</div></div>
								
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								

								<button type='button' class='btn btn-link' data-toggle='modal' data-target='.bs-example-modal-sm' 
									
									data-content2={$last_id}
									
									>Reply</button>
								
								
								";
			$this->ret['c']=$comment;
		}
	}
	$controller=new commentController;

?>