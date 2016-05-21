<?php
	
	require_once('../model/Model.php');

?>
<?php

	class postController 
	{

		public $ret=array();
		private $MODEL;
		private $TAG;
		public function __construct()
		{
			$this->MODEL=MysqlDatabase::getMysqlDatabase();
			$this->ret['statue']='OK';
			$this->ret['txtEditor']=$this->ret['blog_title']=$this->ret['tags']="";
			$this->ret['blog_about']="";
			$this->validate_blog_title();
			$this->validate_blog_about();
			$this->validate_txtEditor();
			$this->validate_tags();
			if($this->ret['statue']=='OK')
			{
				if($_POST['edit']=='no')
				$this->insert_blog();else $this->update_blog();
			}
			echo json_encode($this->ret);
		}
		private function validate_blog_title()
		{
			if(!isset($_POST['blog_title']))
			{$this->ret['statue']='NOT';return;}
			$blog_title=trim($_POST['blog_title']);
			if(strlen($blog_title)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['blog_title']="blog title must be filled";
				return;
			}
			if(strlen($blog_title)<4)
			{
				$this->ret['statue']='NOT';
				$this->ret['blog_title']= "min length 4";
				return;
			}
			if(strlen($blog_title)>100)
			{
				$this->ret['statue']='NOT';
				$this->ret['blog_title']= "max length 100";
				return;
			}
			for($var=0;$var<strlen($blog_title);++$var)
			{
				if(!(($blog_title[$var]<='z'&&$blog_title[$var]>='a')||
					($blog_title[$var]<='Z'&&$blog_title[$var]>='A')||
					($blog_title[$var]<='9'&&$blog_title[$var]>='0')||
					$blog_title[$var]==='_'||$blog_title[$var]==='-'||$blog_title[$var]===' '))
					{
						$this->ret['statue']='NOT';
						$this->ret['blog_title']= "only alpha,numbers ,(_) and (-)";
						return;
					}
			}
		}
		private function validate_blog_about()
		{
			if(!isset($_POST['blog_about']))
			{$this->ret['statue']='NOT';return;}
			$blog_about=trim($_POST['blog_about']);
			if(strlen($blog_about)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['blog_about']="blog about must be filled";
				return;
			}
			if(strlen($blog_about)<4)
			{
				$this->ret['statue']='NOT';
				$this->ret['blog_about']= "min length 4";
				return;
			}
			if(strlen($blog_about)>200)
			{
				$this->ret['statue']='NOT';
				$this->ret['blog_about']= "max length 200";
				return;
			}
			/*for($var=0;$var<strlen($blog_about);++$var)
			{
				if(!(($blog_about[$var]<='z'&&$blog_about[$var]>='a')||
					($blog_about[$var]<='Z'&&$blog_about[$var]>='A')||
					($blog_about[$var]<='9'&&$blog_about[$var]>='0')||
					$blog_about[$var]==='_'||$blog_about[$var]==='-'||$blog_about[$var]===' '))
					{
						$this->ret['statue']='NOT';
						$this->ret['blog_about']= "only alpha,numbers ,(_) and (-)";
						return;
					}
			}*/
		}
		private function validate_txtEditor()
		{
			if(!isset($_POST['txtEditor']))
			{$this->ret['statue']='NOT';return;}
			$txtEditor=trim($_POST['txtEditor']);
			if(strlen($txtEditor)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['txtEditor']="Content must be filled";
				return;
			}
		}
		function multiexplode ($delimiters,$string) 
		{
			$ready = str_replace($delimiters, $delimiters[0], $string);
			$launch = explode($delimiters[0], $ready);
			return  $launch;
		}
		private function validate_tags()
		{
			if(!isset($_POST['tags']))
			{$this->ret['statue']='NOT';return;}
			$tags=trim($_POST['tags']);
			if(strlen($tags)==0)return;
			
			$TAG = $this->multiexplode(array(','), $tags);
			if(count($TAG)==0)
			{
				$this->ret['statue']='NOT';
				$this->ret['tags']="Tags error format";
				return;
			}
			if(count($TAG)>5)
			{
				$this->ret['statue']='NOT';
				$this->ret['tags']="max tags is 5";
				return;
			}
			$ocr=array();
			for($i=0;$i<count($TAG);$i++)
			{
				$TAG[$i]=trim($TAG[$i]);
				if(strlen($TAG[$i])==0)
				{
					$this->ret['statue']='NOT';
					$this->ret['tags']="there is empty tag";
					return;
				}
				if(strlen($TAG[$i])>50)
				{
					$this->ret['statue']='NOT';
					$this->ret['tags']="max tag length is 50";
					return;
				}
				for($var=0;$var<strlen($TAG[$i]);++$var)
				{
					if(!(($TAG[$i][$var]<='z'&&$TAG[$i][$var]>='a')||
						($TAG[$i][$var]<='Z'&&$TAG[$i][$var]>='A')||
						($TAG[$i][$var]<='9'&&$TAG[$i][$var]>='0')||
						$TAG[$i][$var]==='_'||$TAG[$i][$var]==='-'||$TAG[$i][$var]===' '))
						{
							$this->ret['statue']='NOT';
							$this->ret['tags']= "only alpha,numbers ,(_) and (-) for tag {$TAG[$i]}";
							return;
						}
				}
				$TAG[$i]=strtolower($TAG[$i]);
				if(isset($ocr[$TAG[$i]]))$ocr[$TAG[$i]]++;
				else $ocr[$TAG[$i]]=1;
			}
			for($i=0;$i<count($TAG);$i++)
			{
				if($ocr[$TAG[$i]]>1)
				{
					$this->ret['statue']='NOT';
					$this->ret['tags']="there is tag reapted";
					return;
				}
			}
			$this->TAG=$TAG;
		}
		private function insert_blog()
		{
			$this->MODEL->insert_blog($_POST,$this->TAG);
		}
		private function update_blog()
		{
			$this->MODEL->update_blog($_POST,$this->TAG);
		}
	}
	$controller=new postController;

?>