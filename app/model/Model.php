<?php
	function redirect($to){
	
    header("Location: ".$to);
    exit;
	}
	class MysqlDatabase
	{
		protected $db;
		
		
		private function __construct($db_host="localhost",$db_user="root",$db_password="Moha4422med",$db_name="_OJ")
		{
			$this->open_connection($db_host,$db_user,$db_password,$db_name);
		}
		
		public static function getMysqlDatabase()
		{
			static $MysqlDatabase_ins=NULL;
			if($MysqlDatabase_ins==NULL)
				$MysqlDatabase_ins=new MysqlDatabase;
			return $MysqlDatabase_ins;
		}
		
		
		private function open_connection($db_host="localhost",$db_user="root",$db_password="Moha4422med",$db_name="OJ")
		{
			$this->db=mysqli_connect($db_host,$db_user,$db_password,$db_name);
			if(mysqli_connect_errno())
			{
				die("connection failed " . mysqli_connect_error() ." ". mysqli_connect_errno());
			}
		}
		
		public function insert_contestant($data)
		{
			foreach($data as $key=>$value)$data[$key]=mysqli_real_escape_string($this->db,$value);
			$query="INSERT INTO user";
			$query.="(Handle,Fname,Lname,Hahsed_password,Email,Type,Register_Date,school)";
			$query.="VALUES('{$data['Handle']}','{$data['Fname']}','{$data['Lname']}',
			'{$data['Hahsed_password']}','{$data["Email"]}','{$data["Type"]}','{$data["Register_Date"]}','{$data["school"]}')";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
		}
		public function is_handle_exist($handle)
		{
			$handle=mysqli_real_escape_string($this->db,$handle);
			$query="SELECT Handle FROM user WHERE Handle='{$handle}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			if(mysqli_num_rows($result)!=0)
			{
				return true;
			}
			return false;
		}
		
		public function check_password($handle,$pass)
		{
			$handle=mysqli_real_escape_string($this->db,$handle);
			$query="SELECT Hahsed_password FROM user WHERE Handle='{$handle}'";
			$result=mysqli_query($this->db,$query);
			if(!$result){return false;};
			$row=mysqli_fetch_row($result);
			$format_and_salt=substr($row[0],0,29);
			$hash =crypt($pass,$format_and_salt);
			return $row[0]===$hash;
		}
		
		public function get_problems($fillter,$offset=-1)
		{
			$query="SELECT * FROM problem ";
			if(isset($fillter["cat"]))
			{
				if($fillter["cat"]!="All")
				{
					$query.=" join problem_category on problem.problem_id=problem_category.problem_id where 1 ";
					$b=urlencode($fillter["cat"]);
					$str=$fillter['cat'];
					$change = array(' '=>'%',);
					$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
					$query .= "AND category_name LIKE '%".$s."%'";
				}
				else 
					$query.=" WHERE 1 ";
			}
			else 
					$query.=" WHERE 1 ";
		
			if(isset($fillter["Fproblrm"]))
			{
					$temp=$fillter["Fproblrm"];
					if(strpos($fillter["Fproblrm"], '-') !== false)
					{
						$temp=substr($fillter["Fproblrm"],strpos($fillter["Fproblrm"], '-')+1,1000);
						if(strpos($temp, '-') !== false)
						{
							$temp=substr($temp,strpos($temp, '-')+1,1000);
						}
					}
					$b=urlencode($fillter["Fproblrm"]);
					$str=$temp;
					$change = array(' '=>'%',);
					$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
					$query .= " AND name LIKE '%".$s."%'";
					
			}
			if(isset($fillter["Fsource"]))
			{
					$b=urlencode($fillter["Fsource"]);
					$str=$fillter['Fsource'];
					$change = array(' '=>'%',);
					$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
					$query .= " AND source LIKE '%".$s."%'";
					
			}
			
			if(isset($fillter["OJ"]))
			{
				if($fillter["OJ"]!="All")
				{
					$query.=" AND from_oj='{$fillter["OJ"]}' ";
				}
			}
			if($offset!=-1)$query .=" ORDER BY problem.problem_id DESC LIMIT 50 OFFSET {$offset} ";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			return $result;
		}
		public function get_status($fillter,$offset=-1)
		{
			$query="SELECT * FROM submission join problem 
			ON problem.problem_id=submission.problem_id WHERE 1 ";
			if(isset($fillter["lang"]))
			{
				if($fillter["lang"]!="All"){
					$query.=" AND Language='{$fillter["lang"]}'";
				}
			}
			if(isset($fillter["verdict"]))
			{
				if($fillter["verdict"]!="All")
				$query.=" AND Verdict='{$fillter["verdict"]}'";
			}
			if(isset($_GET["Fproblrm"]))
			{
				$temp=$fillter["Fproblrm"];
				if(strpos($fillter["Fproblrm"], '-') !== false)
				{
					$temp=substr($fillter["Fproblrm"],strpos($fillter["Fproblrm"], '-')+1,1000);
					if(strpos($temp, '-') !== false)
					{
						$temp=substr($temp,strpos($temp, '-')+1,1000);
					}
				}
				$str=$temp;
				$change = array(' '=>'%',);
				$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
				$query .= " AND name LIKE '%".$s."%'";
			}
			if(isset($fillter["Fuser"]))
			{
					$str=$_GET['Fuser'];
					$change = array(' '=>'%',);
					$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
					$query .= " AND user_Handle LIKE '%".$s."%'";
			}
			
			if($offset!=-1)$query .=" ORDER BY submission_id DESC LIMIT 20 OFFSET {$offset} ";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			return $result;
		}
		public function get_contests($fillter,$offset=-1)
		{
			$query="SELECT * FROM contest WHERE 1 ";
			if(isset($_GET["Access"]))
			{
				if($_GET["Access"]!="All"){
					$query.=" AND type='{$_GET["Access"]}'";
				}
			}
			if(isset($_GET["status"]))
			{
				if($_GET["status"]!="All")
				{
					$t=time();
					if($_GET["status"]=="Coming"){$query.=" AND start>{$t}";}
					if($_GET["status"]=="Running"){$query.=" AND start<={$t} AND end>={$t}";}
					if($_GET["status"]=="Passed"){$query.=" AND end<{$t}";}
				}
			}
			if(isset($_GET["Fcontest"]))
			{
				$str=$_GET['Fcontest'];
				$change = array(' '=>'%',);
				$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
				$query .= " AND name LIKE '%".$s."%'";
			}
			if(isset($_GET["Fuser"]))
			{					
				$str=$_GET['Fuser'];
				$change = array(' '=>'%',);
				$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
				$query .= " AND creator_Handle LIKE '%".$s."%'";
			}
			
			if($offset!=-1)$query .=" ORDER BY contest_id DESC LIMIT 20 OFFSET {$offset} ";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			return $result;
		}
		
		public function get_category()
		{
			$Q="CREATE OR REPLACE VIEW  CAT AS SELECT category_name,count(category_name) AS NUM FROM problem_category 
					GROUP BY category_name";
			$res=mysqli_query($this->db,$Q);	
			if(!$res)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			$query="SELECT * FROM CAT ORDER BY NUM DESC";
			$res=mysqli_query($this->db,$query);
			if(!$res)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			return $res;
		}
		
		public function is_email_exist($email)
		{
			$email=mysqli_real_escape_string($this->db,$email);
			$query="SELECT Email FROM user WHERE Email='{$email}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			if(mysqli_num_rows($result)!=0)
			{
				return true;
			}
			return false;
		}
		
		public function count_accepted_submission($problem_id)
		{
			$query="SELECT COUNT(submission_id) FROM submission WHERE Verdict='Accepted' AND Problem_id={$problem_id}";
			$res=mysqli_query($this->db,$query);
			$r=mysqli_fetch_array($res);
			return $r[0];
		}
		
		public function count_all_submission($problem_id)
		{
			$query="SELECT COUNT(submission_id) FROM submission WHERE Problem_id={$problem_id}";
			$res=mysqli_query($this->db,$query);
			$r=mysqli_fetch_array($res);
			return $r[0];
		}
		
		public function get_problem($problem_id)
		{
			$query="SELECT * FROM problem WHERE problem_id={$problem_id}";
			$result=mysqli_query($this->db,$query);
			return $result;
		}
		
		public function get_problem_category($problem_id)
		{
			$query="SELECT * FROM problem_category WHERE problem_id={$problem_id}";
			$result=mysqli_query($this->db,$query);
			return $result;
		}
		
		public function get_max_problem_id()
		{
			$query="SELECT MAX(problem_id) FROM problem";
			$res=mysqli_query($this->db,$query);
			$r=mysqli_fetch_array($res);
			return $r[0];
		}
		
		public function close_connection()
		{
			if(isset($this->db))
			{
				mysqli_close($this->db);
				unset($this->db);
			}
		}
		public function insert_submission($sub)
		{
			if(strlen($sub['Verdict'])==0)$sub['Verdict']="Judge Error";
			$sub['Soultion']=mysqli_real_escape_string($this->db,$sub['Soultion']);
			$sub['Verdict']=mysqli_real_escape_string($this->db,$sub['Verdict']);
			$sub['Language']=mysqli_real_escape_string($this->db,$sub['Language']);
			$query="INSERT INTO submission";
					$query.="(
							TIME,
							Verdict,
							Soultion, 		
							Language,  
							submission_date,
							memory,
							user_Handle, 
							Problem_id
						) ";
					
					$query.="VALUES(
						 {$sub['TIME']},
						'{$sub['Verdict']}', 		
						'{$sub['Soultion']}',  
						'{$sub['Language']}',
						'{$sub['submission_date']}',
						 {$sub['memory']},
						'{$sub['user_Handle']}',
						 {$sub['Problem_id']}
					)";
					if(!mysqli_query($this->db,$query))
					{
						die("query failed "." ".mysqli_error($this->db));
					}
		}
		public function count_soulution($s)
		{
			$s=mysqli_real_escape_string($this->db,$s);
			return mysqli_fetch_row(mysqli_query($this->db,"SELECT count(submission_id) FROM submission WHERE Soultion='{$s}'"))[0];
		}
		public function get_wating_submission()
		{
			$query="SELECT submission_id,from_oj FROM submission Join problem ON problem.problem_id=submission.Problem_id WHERE Verdict='Waiting'";
			return mysqli_query($this->db,$query);
		}
		public function count_wating_submission($oj)
		{
			$query="SELECT count(submission_id) FROM submission Join problem ON problem.problem_id=submission.Problem_id WHERE Verdict='Waiting' AND from_oj='{$oj}'";
			return mysqli_fetch_row(mysqli_query($this->db,$query))[0];
		}
		public function update_submission($sub_id,$sub)
		{
			$query="UPDATE submission ";
			$query.="SET 
					TIME={$sub['TIME']},
					Verdict='{$sub['Verdict']}',
					memory={$sub['memory']} 		
					WHERE submission_id={$sub_id}";
			if(!mysqli_query($this->db,$query))
			{
				die("query failed "." ".mysqli_error($this->db));
			}
		}
		public function INSERT_contest()
		{
			$start=(strtotime($_POST["date"])+$_POST["hour"]*60*60+$_POST["min"]*60);
			$end=(strtotime($_POST["Edate"])+$_POST["Ehour"]*60*60+$_POST["Emin"]*60);
			$name=mysqli_real_escape_string($this->db,$_POST["contest_name"]);
			$query="INSERT INTO contest";
			$query.="(start,end,name,creator_Handle,type) ";
			$query.="VALUES({$start},{$end},'{$name}','{$_COOKIE["user_handle"]}','{$_POST["type"]}')";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
		}
		
		public function insert_blog($data,$TAG)
		{
			$date = date('M d, y')." at ".date('h:ia');
			$data["txtEditor"]=mysqli_real_escape_string($this->db,$data["txtEditor"]);
			$data["blog_title"]=mysqli_real_escape_string($this->db,$data["blog_title"]);
			$data["blog_about"]=mysqli_real_escape_string($this->db,$data["blog_about"]);
			$query="INSERT INTO blog";
			$query.="(title,about,date,content,writer_Handle) ";
			$query.="VALUES('{$data["blog_title"]}','{$data["blog_about"]}','{$date}','{$data["txtEditor"]}','{$_COOKIE["user_handle"]}')";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			$last_id = mysqli_insert_id($this->db);
			for($i=0;$i<count($TAG);$i++)
			{
				$query="INSERT INTO blog_tag";
				$query.="(blog_id,tag_name) ";
				$query.="VALUES('{$last_id}','{$TAG[$i]}')";
				$result=mysqli_query($this->db,$query);
				if(!$result)
				{
					die("query failed "." ".mysqli_error($this->db)); 
				}
			}
		}
		public function update_blog($data,$TAG)
		{
			$query="SELECT writer_Handle FROM blog WHERE blog_id='{$data['edit']}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			if($_COOKIE['user_handle']!=mysqli_fetch_row($result)[0])
			{$ret['statue']='NOT';echo json_encode($ret);exit;}
			$data["txtEditor"]=mysqli_real_escape_string($this->db,$data["txtEditor"]);
			$data["blog_title"]=mysqli_real_escape_string($this->db,$data["blog_title"]);
			$query="UPDATE  blog ";
			$query.="SET title='{$data["blog_title"]}',about='{$data["blog_about"]}',content='{$data["txtEditor"]}' WHERE blog_id={$data['edit']}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			$query="DELETE FROM blog_tag WHERE blog_id={$data['edit']}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			for($i=0;$i<count($TAG);$i++)
			{
				$query="INSERT INTO blog_tag";
				$query.="(blog_id,tag_name) ";
				$query.="VALUES('{$data['edit']}','{$TAG[$i]}')";
				$result=mysqli_query($this->db,$query);
				if(!$result)
				{
					die("query failed "." ".mysqli_error($this->db)); 
				}
			}
		}
		
		public function get_blogs($fillter,$offset=-1)
		{
			$query="SELECT * FROM blog WHERE 1";
			if(isset($fillter['search']))
			{
				$str=$fillter['search'];
				$change = array(' '=>'%',);
				$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
				$query .= " AND (title LIKE '%".$s."%' OR blog.blog_id IN (SELECT blog_tag.blog_id from blog_tag where tag_name LIKE '%".$s."%') )"  ;
			}
			
			if($offset!=-1)$query .=" ORDER BY blog_id DESC LIMIT 10 OFFSET {$offset} ";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			return $result;
		}
		
		public function get_blog($bid)
		{
			$query="SELECT * FROM blog WHERE blog_id={$bid}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
				
			}
			else
			{
				$row=mysqli_fetch_assoc($result);
				$ar=mysqli_num_rows($result);
				if($ar==0){
					redirect("http://localhost/our3/app/view/blogs.php");
				}
				return $row;
			}
		}
		
		public function get_comment($bid)
		{
			$query="SELECT * FROM comment WHERE blog_id={$bid}";
			$c=mysqli_query($this->db,$query);
			if(!$c)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			return $c;
		}
		
		public function get_reply($cid)
		{
			$q="SELECT * FROM comment_reply WHERE comment_id={$cid} ORDER BY reply_id ASC";
			$re=mysqli_query($this->db,$q);
			if(!$re)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			return $re;
		}
		
		public function get_blog_tags($bid)
		{
			$query="SELECT * from blog_tag WHERE blog_id={$bid}";
			$t=mysqli_query($this->db,$query);
			if(!$t)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			return $t;
		}
		
		public function insert_comment($data)
		{
			$date = date('M d, y')." at ".date('h:ia');
			$data["comment"]=nl2br($data["comment"]);
			$data["comment"]=mysqli_real_escape_string($this->db,$data["comment"]);
			$query="INSERT INTO comment";
			$query.="(date,content,writer_Handle,blog_id) ";
			$query.="VALUES('{$date}','{$data["comment"]}','{$_COOKIE["user_handle"]}',{$data["id"]})";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
			return mysqli_insert_id($this->db);
		}
		
		public function insert_replay($data)
		{
			$date = date('M d, y')." at ".date('h:ia');
			$data["reply"]=nl2br($data["reply"]);
			$data["reply"]=mysqli_real_escape_string($this->db,$data["reply"]);
			$query="INSERT INTO comment_reply";
			$query.="(date,content,writer_Handle,comment_id) ";
			$query.="VALUES('{$date}','{$data["reply"]}','{$_COOKIE["user_handle"]}',{$data['comment_id']})";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));	
			}
		}
		
		public function delete_blog($bid)
		{
			$query="SELECT * FROM blog WHERE blog_id={$bid}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
				
			}
			else
			{
				if(mysqli_num_rows($result)==0)
					redirect("http://localhost/our3/index.php");
				$row=mysqli_fetch_assoc($result);
				if($row['writer_Handle']!=$_COOKIE['user_handle'])
					redirect("http://localhost/our3/index.php");
				$query="Delete FROM blog WHERE blog_id={$bid}";
				$result=mysqli_query($this->db,$query);
				if(!$result)
				{
					die("query failed "." ".mysqli_error($this->db)); 
					
				}
				redirect("http://localhost/our3/app/view/blogs.php");
			}
		}
		
		public function real_escape($str)
		{
			return mysqli_real_escape_string($this->db,$str);
		}
	}
?>