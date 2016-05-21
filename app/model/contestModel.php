<?php

	require_once('Model.php');

	class contestModel 
	{
		private $row;
		protected $db;
		public function __construct($use='use',$db_host="localhost",$db_user="root",$db_password="Moha4422med",$db_name="_OJ")
		{
			$this->open_connection($db_host,$db_user,$db_password,$db_name);
			if($use=='use')
			$this->row=$this->GET_contest();
		}
		
		public function open_connection($db_host="localhost",$db_user="root",$db_password="Moha4422med",$db_name="OJ")
		{
			$this->db=mysqli_connect($db_host,$db_user,$db_password,$db_name);
			if(mysqli_connect_errno())
			{
				die("connection failed " . mysqli_connect_error() ." ". mysqli_connect_errno());
			}
		}
		
		public function delete_contest($cid)
		{
			$query="Delete FROM contest WHERE contest_id={$cid}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
				
			}
			redirect('http://localhost/our3/app/view/contest.php');
		}
		
		public function delete_participate($cid)
		{
			$query="DELETE FROM participate WHERE participate_name='{$_COOKIE['user_handle']}' AND contest_id={$cid}";
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
		
		public function is_team_exist($team)
		{
			$team=mysqli_real_escape_string($this->db,$team);
			$query="SELECT team_name FROM team WHERE team_name='{$team}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar==0)
				{
					return false;
				}
				return true;
			}
		}
		
		public function is_user_member_in_team($team)
		{
			$team=mysqli_real_escape_string($this->db,$team);
			$query="SELECT team_name from member_in Where team_name='{$team}' AND user_Handle='{$_COOKIE['user_handle']}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar==0)
				{
					return false;
				}
				return true;
			}
		}
		
		function insert_participate($cid,$type)
		{
			$t=time();
			$query="INSERT INTO participate VALUES({$cid},'{$_COOKIE['user_handle']}','{$type}',{$t})";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
		}
		
		public function UPDATE_contest($data)
		{
			$start=(strtotime($data["date"])+$data["hour"]*60*60+$data["min"]*60);
			$end=(strtotime($data["Edate"])+$data["Ehour"]*60*60+$data["Emin"]*60);
			$name=mysqli_real_escape_string($this->db,$data["contest_name"]);
			$query="UPDATE contest";
			$query.=" SET start={$start},end={$end},name='{$name}',type='{$data["type"]}' WHERE contest_id={$data['id']}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
		}
		
		public function is_handle_invited($handle,$cid)
		{
			$handle=mysqli_real_escape_string($this->db,$handle);
			$query="SELECT name from contest_invite Where name='{$handle}' AND contest_id={$cid}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar!=0)
				{
					return true;
				}
				return false;
			}
		}
		
		public function invite_user($handle,$cid)
		{
			$handle=mysqli_real_escape_string($this->db,$handle);
			$query="INSERT INTO contest_invite VALUES({$cid},'{$handle}',0)";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($thid->db));
			}
		}
		
		public function gt_contest($cid)
		{
			$query="SELECT * FROM contest WHERE contest_id='{$cid}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			return $result;
		}
		
		public function is_problem_in_database($i,$j)
		{
			$query="SELECT * FROM problem WHERE id='{$i}' AND from_oj='{$j}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar!=1)
				{
					return false;
				}
				return $result;
			}
		}
		
		public function insert_problem($pid,$cid)
		{
			$query="INSERT INTO used_in (problem_id,contest_id) values({$pid},{$cid})";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
		}
		
		public function insert_regional($cid,$reg)  
		{
			$query="SELECT problem_id from problem WHERE problem_id NOT IN (SELECT problem_id FROM used_in where contest_id={$cid}) AND source='{$reg}'";
				$result=mysqli_query($this->db,$query);
				if(!$result)
				{
					die("query failed "." ".mysqli_error($this->db));
				}
				while($row=mysqli_fetch_array($result))
				{
					$this->insert_problem($row['problem_id'],$cid);
				}
		}
			
		public function insert_world($cid,$w)  
		{
			$query="SELECT problem_id from problem WHERE problem_id NOT IN (SELECT problem_id FROM used_in where contest_id={$cid}) AND source='{$w}'";
				$result=mysqli_query($this->db,$query);
				if(!$result)
				{
					die("query failed "." ".mysqli_error($this->db));
				}
				while($row=mysqli_fetch_array($result))
				{
					$this->insert_problem($row['problem_id'],$cid);
				}
		}
		
		public function get_random_problem($cid,$op,$lev)
		{
			$query="SELECT problem_id from problem WHERE problem_id NOT IN (SELECT problem_id FROM used_in where contest_id={$_POST['id']}) AND difficulty {$_POST['operation']} {$_POST['level']} ORDER by RAND() LIMIT 1";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			return $result;
		}
		
		
		public function is_problem_in_contest($i,$j)
		{
			$query="SELECT * FROM used_in WHERE contest_id={$i} AND problem_id='{$j}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			$ar=mysqli_num_rows($result);
			if($ar==0)return false;
			return true;
		}
		
		public function GET_contest()
		{
			if(!isset($_GET['id']))redirect('http://localhost/our3/app/view/contest.php');
			$query="SELECT * FROM contest WHERE contest_id='{$_GET['id']}'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar==0)
					redirect('http://localhost/our3/app/view/contest.php');
				$row=mysqli_fetch_assoc($result);
				return $row;
			}
		}
		
		public function IS_INVITED()
		{
			$query="SELECT name from contest_invite Where name='{$_COOKIE['user_handle']}' AND contest_id={$_GET['id']}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar==0)return false;
				return true;
			}
		}
		
		public function is_registered()
		{
			$query="SELECT participate_name from participate Where participate_name='{$_COOKIE['user_handle']}' AND contest_id={$_GET['id']}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar==0)return false;
				return true;
			}
		}
		public function get_registrans(& $reg_map='non')
		{
			$reg_map=array();
			$query="SELECT participate_name,type from participate Where contest_id={$_GET['id']} ORDER BY type";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			else
			{
				$ret=array();
				$pu="";$pre="";
				while($row=mysqli_fetch_assoc($result))
				{
					if(strlen($row['type'])==0)
					{	
						$reg_map[$row['participate_name']]=count($ret);
						array_push($ret,"<a href='user_info.php?handle={$row['participate_name']}'>{$row['participate_name']}</a>");
					}
					else
					{
						$reg_map[$row['participate_name']]=count($ret);
						if($row['type']==$pre)$pu.=' , '."<a href='user_info.php?handle={$row['participate_name']}'>{$row['participate_name']}</a>";
						else{
							if(strlen($pu)!=0)
							{
								$pu.=' )';
								array_push($ret,$pu);
							}
							$pu=$row['type'].' ( '."<a href='user_info.php?handle={$row['participate_name']}'>{$row['participate_name']}</a>";
						}
						$pre=$row['type'];
					}
				}
				if(strlen($pu)!=0)
				{
					$pu.=' )';
					array_push($ret,$pu);
				}
				return $ret;
			}
		}
		public function get_contest_problems()
		{
			$query="SELECT * from used_in join problem on used_in.problem_id=problem.problem_id AND used_in.contest_id={$_GET['id']} ORDER BY used_in.order_id";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			return $result;
		}
		public function get_Regional()
		{
			$query="SELECT DISTINCT source FROM problem WHERE source LIKE '%".'Regionals'."%' AND from_oj='UvaLive' ORDER BY source";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			return $result;
		}
		public function get_world()
		{
			global $db;
			$query="SELECT DISTINCT source FROM problem WHERE source LIKE '%".'World Finals'."%' AND from_oj='UvaLive'";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db));
			}
			return $result;
		}
		
		public function get_contest_statues(& $p,& $ar,& $next,& $result,$all='non')
		{
			$row=$this->row;
			
			
			$query="SELECT * FROM submission join problem join participate
			ON problem.problem_id=submission.problem_id AND participate.contest_id={$_GET['id']} AND 
			participate.time < submission.submission_date AND submission.submission_date > {$row['start']} AND submission.submission_date < {$row['end']}
			AND problem.problem_id IN (SELECT problem_id FROM used_in WHERE contest_id={$_GET['id']})
			AND participate_name=submission.user_Handle

			WHERE 1 ";
			
			
			if(isset($_GET["lang"]))
			{
				if($_GET["lang"]!="All"){
					$b=urlencode($_GET["lang"]);
					$next.="&lang={$b}";
					$query.=" AND Language='{$_GET["lang"]}'";
				}
			}
			if(isset($_GET["verdict"]))
			{
				$b=urlencode($_GET["verdict"]);
					$next.="&verdict={$b}";
				if($_GET["verdict"]!="All")
				$query.=" AND Verdict='{$_GET["verdict"]}'";
			}
			if(isset($_GET["Fproblrm"]))
			{
				$temp=$_GET["Fproblrm"];
				if(strpos($_GET["Fproblrm"], '-') !== false)
				{
					$temp=substr($_GET["Fproblrm"],strpos($_GET["Fproblrm"], '-')+1,1000);
					if(strpos($temp, '-') !== false)
					{
						$temp=substr($temp,strpos($temp, '-')+1,1000);
					}
				}
				$b=urlencode($_GET["Fproblrm"]);
				$next.="&Fproblrm={$b}";
				$str=$temp;
				$change = array(' '=>'%',);
				$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
				$query .= " AND name LIKE '%".$s."%'";
			}
			if(isset($_GET["Fuser"]))
			{
					$b=urlencode($_GET["Fuser"]);
					$next.="&Fuser={$b}";
					$str=$_GET['Fuser'];
					$change = array(' '=>'%',);
					$s=strtr(mysqli_real_escape_string($this->db,$str),$change);
					$query .= " AND user_Handle LIKE '%".$s."%'";
			}
			$next.="&id={$_GET['id']}";
			$next.="&page=";
			$offset=($p-1)*20;
			if($all=='all')
			$query .=" ORDER BY submission_id ASC";
			else 
			$query .=" ORDER BY submission_id DESC";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			else
			{
				$x=0;
				if($all=='all')return $result;
				$ar=mysqli_num_rows($result);
				
				$query .=" LIMIT 20 OFFSET {$offset} ";
				$result=mysqli_query($this->db,$query);
				if(!$result)
				{
					die("query failed "." ".mysqli_error($this->db)); 
				}
			}
		}
		
		public function DELETE_PROBLEM()
		{
			$query="DELETE FROM used_in WHERE order_id={$_GET['del']}";
			$result=mysqli_query($this->db,$query);
		}
		
		public function get_problem(& $pro,& $cat)
		{
			$query="SELECT * FROM used_in WHERE problem_id={$_GET["pid"]} AND contest_id={$_GET['id']}";
			$result=mysqli_query($this->db,$query);
			if(!$result)
			{
				die("query failed "." ".mysqli_error($this->db)); 
			}
			else
			{
				$ar=mysqli_num_rows($result);
				if($ar==0)
					redirect('http://localhost/our3/app/view/contest.php');
			}
			
			$query="SELECT * FROM problem WHERE problem_id={$_GET["pid"]}";
			$result=mysqli_query($this->db,$query);
			$pro=mysqli_fetch_assoc($result);
			
			
			$query="SELECT * FROM problem_category WHERE problem_id={$_GET["pid"]}";
			$cat=mysqli_query($this->db,$query);
		}
		
	}
?>