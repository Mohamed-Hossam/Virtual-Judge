<?php require("../common.php");?>
<?php
	function uva_sources() {
		global $db;
		$url = "http://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8";
		$html = str_get_html(get_url($url));
		$main_a = $html->find("#col3_content_wrapper table a");
		$fir = 0;
		$trans = array(" :: "=>", ");
		foreach($main_a as $lone_a) {
			$l2url = $lone_a->href;
			$fir++;
			if ($fir < 4 || $fir > 6) continue;
			$l2url = "http://uva.onlinejudge.org/".htmlspecialchars_decode($l2url);
			$html2 = str_get_html(get_url($l2url));
			$l2main_a = $html2->find("#col3_content_wrapper table a");
			foreach($l2main_a as $ltow_a) {
				$l3url = $ltow_a->href;
				$l3url = "http://uva.onlinejudge.org/".htmlspecialchars_decode($l3url)."&limit=2000&limitstart=0";
				$html3 = str_get_html(get_url($l3url));
				$source = $html3->find(".contentheading", 0)->plaintext;
				$source = substr($source, 8);
				$source = trim(strtr($source, $trans));
				$probs = $html3->find("#col3_content_wrapper table a");
				foreach($probs as $prob) {
					$pid = html_entity_decode(trim($prob->plaintext));
					$pid = iconv("utf-8", "utf-8//ignore", trim(strstr($pid, '-', true)));
				   /* $sql = "update problem set source='$source' where vid='$pid' and vname='UVA'";
					$db->query($sql);*/
					
					$pid=substr($pid,0,strlen($pid)-2);
					//echo $source."=>".$pid."<br>";
					//continue;
					if(strlen($pid)!=0)
					{
						$query="update problem set source='{$source}' WHERE id='{$pid}' AND from_oj='Uva'";
						$res=mysqli_query($db,$query);
						if(!$res)
						{
							die("query failed "." ".mysqli_error($db));
						}
						
					}
					
				}
			}
		}
	}
	function Extract_Uva_pdf($pid,$url){
		
		
		if(file_exists("pdfs\\P{$pid}.pdf"))return;
		
		$content="";
		$content = file_get_contents($url);
		if(strlen($content)==0)return;

		if (stripos($content, "<h3>") !== false){
			preg_match('/<iframe src="(external\/([\d]*)\/.*)"/sU', $content, $matches);
			$cate = $matches[2];
			$purl = $matches[1];
			
			
			preg_match('/<a href="(external.*)"/sU', $content, $matches);
			$pdflink = $matches[1];

			if ($purl != "")  {
				$content = get_url("http://uva.onlinejudge.org/".$purl);
			} else {
				$content = "";
			}
			$content = iconv("UTF-8", "UTF-8//IGNORE", $content);
			$content = preg_replace('/<head[\s\S]*\/head>/', "", $content);
			$content = preg_replace('/<style[\s\S]*\/style>/', "", $content);

			$pdf= get_url("http://uva.onlinejudge.org/".$pdflink);
			
			
			$myfile = fopen("pdfs\\P{$pid}.pdf", "w") or die("Unable to open file!");
			fwrite($myfile, $pdf);
			fclose($myfile);		
		}
		else{
			echo "No problem called UVA $pid.<br>";
		}
	}
	function uva()
	{
		$start=time();
		global $db,$pro;
		$ch=curl_init();
		$url="http://uhunt.felix-halim.net/api/p";
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$response=curl_exec($ch);
		curl_close($ch);
		$result=json_decode($response,true);
		$auto="<script> 
				$(function(){ 
					var Uva = [";
		$now=time()-$start;
		$f = fopen("uva_status.txt", "w") or die("Unable to open file!");
		if(count($result)!=0)
		fwrite($f, "Uva api Success at {$now}".PHP_EOL);
		else fwrite($f, "Uva api faild at {$now}".PHP_EOL);
		
		for($i=0;$i<count($result);$i++)
		{
			/*if(IS_RUN('uva')=="false")
			{
				$now=time()-$start;
				fwrite($f, "uva Force Stop At {$now}".PHP_EOL);
				return;
			}*/
			$now=time()-$start;
			fwrite($f, "P{$result[$i][1]} start at {$now}".PHP_EOL);
			foreach($pro as $x=>$y)
					$pro[$x]='';
			$pro['url']="https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=3&page=show_problem&problem={$result[$i][0]}";
			$pro['id']=$result[$i][1];
			$pro['ind']=$result[$i][0];
			$pro['solved_count']=$result[$i][3];
			$pro['name']=$result[$i][2];
			$pro['time_limit']=$result[$i][19];
			$pro['memory_limit']=131072;
			$pro['from_oj']='Uva';
			$pro['input_type']='standard input';
			$pro['output_type']='standard output';
			$pro['name']=str_replace('"',"'",$pro['name']);
			Extract_Uva_pdf($pro['id'],$pro['url']);
			foreach($pro as $x=>$y)
					$pro[$x]=mysqli_real_escape_string($db,$y);
					
			$auto.='{ value: "'.$pro['id'].' - '.$pro['name'].'" },';
			
			$query="SELECT problem_id FROM problem where id='{$pro['id']}' AND from_oj='Uva'";
			$res=mysqli_query($db,$query);
			if(!$res)
			{
				die("query failed "." ".mysqli_error($db));
			}
			$row=mysqli_num_rows($res);
			$new;
			if($row!=0)
			{
				$new=update_problem();
			}
			else $new=insert_problem();
			$now=time()-$start;
			fwrite($f, "P{$result[$i][1]} end at {$now}".PHP_EOL);	
		}
		$now=time()-$start;
		fwrite($f, "Updata All Problems end at {$now}".PHP_EOL);
		$auto.= "  
					];
				  
				  // setup autocomplete function pulling from Uva[] array
				  $('#autocomplete').autocomplete({
					lookup: Uva,
				  });
				  
				});
		  </script>";
		$myfile = fopen("auto_uva.php", "w") or die("Unable to open file!");
		fwrite($myfile, $auto);
		fclose($myfile);
		$now=time()-$start;
		fwrite($f, "Updata source start at {$now}".PHP_EOL);
		uva_sources();
		$now=time()-$start;
		fwrite($f, "Updata source end at {$now}".PHP_EOL);
		fwrite($f, "Finish Success at {$now}".PHP_EOL);
		fclose($f);
	}
	
?>


<?php
	if(isset($_GET['src']))
	{uva_sources();exit;}
	if(isset($_GET['lev']))
	{
		update_level_uva();
		exit;
	}
	uva();
	
?>
