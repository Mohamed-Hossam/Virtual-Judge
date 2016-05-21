<?php require("../common.php");?>

<?php
	
	function Extract_Spoj($pid) 
	{
		global $pro;$cate=array();
		$url="http://www.spoj.com/problems/$pid/";
		$content=get_url($url);
		$ret=array();
		if (stripos($content,"Wrong problem code!")===false) {
			if (preg_match('/<h2 id="problem-name".* - (.*)<\/h2>/sU', $content,$matches)) $pro["name"]=trim($matches[1]);
			
			$temp=$content;
			$temp = explode( '<tr><td>Time limit:</td><td>', $temp )[1];
			$pro["time_limit"]=explode( '</td></tr>' , $temp )[0];
			
			$temp=$content;
			$temp = explode( '<tr><td>Memory limit:</td><td>', $temp )[1];
			$pro["memory_limit"]=explode( '</td></tr>' , $temp )[0];
			
			$temp=$content;
			$temp = explode( '<tr><td>Languages:</td><td>', $temp )[1];
			$pro["notes"]=explode( '</td></tr>' , $temp )[0];
			
			
			if(stripos($content,"<tr><td>Resource:</td><td>")!==false)
			{
				$temp=$content;
				$temp = explode( '<tr><td>Resource:</td><td>', $temp )[1];
				$pro["source"]=explode( '</td></tr>' , $temp )[0];
				if(stripos($pro["source"],'href'))
				{
					$pro["source"]=explode('<',explode('">',$pro["source"])[1])[0];
				}
			}
			
			if(stripos($content,"No tags")===false)
			{
				$temp=$content;
				$temp = explode( '<div id="problem-tags" class="col-lg-12 text-center">', $temp )[1];
				$temp=explode( '</div>' , $temp )[0];
				$cat=explode( '<a href="/problems/tag/' , $temp );
				for($i=1;$i<count($cat);$i++)
				{
					$temp=$cat[$i];
					$temp=explode( '">' , $temp )[0];
					array_push($cate,$temp);
				}
			}
		
			$temp=$content;
			$temp = explode( '<div id="problem-body">', $temp )[1];
			$pro["description"]=explode( '<div class="text-center">' , $temp )[0];
						
			pcrawler_process_info("online_Judges\spoj\images","http://www.spoj.com/",false);
		}
		else echo "No problem called SPOJ $pid.<br>";
		
		return $cate;
	}
	function Spoj() 
	{
		global $db,$pro;
		$start=time();
		foreach ( array("tutorial","classical","challenge","partial","riddle","riddle") as $typec ) {
			$i=0;$pd=true;
			$now=time()-$start;
			$f = fopen("Spoj_status.txt", "w") or die("Unable to open file!");
			$now=time()-$start;
			fwrite($f, "Spoj {$typec} Start At {$now}".PHP_EOL);
			while ($pd) 
			{
				$html=get_url("http://www.spoj.com/problems/$typec/sort=0,start=".($i*50));
				if ($html == null) {break;}
				$table = explode( '<td align="left">' , $html );
				$now=time()-$start;
				fwrite($f, "Spoj {$typec} page {$i} Start At {$now}".PHP_EOL);
				for($j=1;$j<count($table);$j++)
				{
					/*if(IS_RUN('spoj')=="false")
					{
						$now=time()-$start;
						fwrite($f, "Spoj Force Stop At {$now}".PHP_EOL);
						return;
					}*/
					$now=time()-$start;
					fwrite($f, "Spoj {$typec} page {$i} problem $j Start At {$now}".PHP_EOL);
					foreach($pro as $x=>$y)
					$pro[$x]='';
					
					$temp=$table[$j];
					$temp = explode( '<a href="/problems/', $temp )[1];
					$pid=explode( '">' , $temp )[0];
					
					$temp=$table[$j];
					$temp = explode( 'See the best solutions.">', $temp )[1];
					$ACC=explode( '</a></td>' , $temp )[0];
					
					$pro['id']=$pid;
					$pro['solved_count']=$ACC;
					$pro['url']="http://www.spoj.com/problems/{$pid}/";
					$pro['from_oj']="Spoj";
					$pro['input_type']='standard input';
					$pro['output_type']='standard output';
					$cate=Extract_Spoj($pid);
					$pro['name']=str_replace('"',"'",$pro['name']);
					
					foreach($pro as $x=>$y)
					$pro[$x]=mysqli_real_escape_string($db,$y);
				
					
					
					$query="SELECT problem_id FROM problem where id='{$pro['id']}' AND from_oj='Spoj'";
					$res=mysqli_query($db,$query);
					if(!$res)
					{
						die("query failed "." ".mysqli_error($db));
					}
					$row=mysqli_num_rows($res);
					$new;
					if($row!=0)
					{
						$r=mysqli_fetch_row($res);
						$query="DELETE FROM problem_category where problem_id={$r[0]}";
						$rr=mysqli_query($db,$query);
						if(!$rr)
						{
							die("query failed samples"." ".mysqli_error($db));
						}
						$new=update_problem("Spoj");
					}
					else $new=insert_problem("Spoj");
					
					
					for($k=0;$k<count($cate);$k++)
					{
						$cate[$k]=mysqli_real_escape_string($db,$cate[$k]);
						$query="INSERT INTO problem_category(problem_id,category_name) ";
						$query.="VALUES({$new},'{$cate[$k]}')";
						
						$res=mysqli_query($db,$query);	
						if(!$res)
						{
							die("query failed Category"." ".mysqli_error($db));
						}
					}
					
					$now=time()-$start;
					fwrite($f, "Spoj {$typec} page {$i} problem $j End At {$now}".PHP_EOL);
					
				}
				$now=time()-$start;
				fwrite($f, "Spoj {$typec} page {$i} End At {$now}".PHP_EOL);
				if(count($table)<50)break;
				$i++;
			}
			$now=time()-$start;
			fwrite($f, "Spoj {$typec} End At {$now}".PHP_EOL);
		}
		
		  
		  $now=time()-$start;
		  fwrite($f, "All Done Success".PHP_EOL);
		  fclose($f);
	}
?>



<?php
	if(isset($_GET['lev']))
	{
		update_level_spoj();
		exit;
	}
	Spoj();
?>