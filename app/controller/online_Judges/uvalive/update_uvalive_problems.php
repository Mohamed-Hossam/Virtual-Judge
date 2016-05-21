<?php require("../common.php");?>
<?php
	function uvalive_sources() {
		global $db;
		$url = "https://icpcarchive.ecs.baylor.edu/index.php?option=com_onlinejudge&Itemid=8";
		$html = str_get_html(get_url($url));
		$main_a = $html->find(".maincontent table a");
		$fir = 1;
		$trans = array(" :: "=>", ");
		foreach($main_a as $lone_a) {
			$l2url = $lone_a->href;
			if ($fir > 0) {
				$fir--;
				continue;
			}
			$l2url = "https://icpcarchive.ecs.baylor.edu/".htmlspecialchars_decode($l2url);
			$html2 = str_get_html(get_url($l2url));
			$l2main_a = $html2->find(".maincontent table a");
			foreach($l2main_a as $ltow_a) {
				$l3url = $ltow_a->href;
				$l3url = "https://icpcarchive.ecs.baylor.edu/".htmlspecialchars_decode($l3url);
				$html3 = str_get_html(get_url($l3url));
				$source = $html3->find(".contentheading", 0)->plaintext;
				$source = substr($source, 8);
				$source = trim(strtr($source, $trans));
				$probs = $html3->find(".maincontent table a");
				foreach($probs as $prob) {
					$pid = substr($prob->plaintext, 0, 4);
					if(strlen($pid)!=0)
					{
						$query="update problem set source='{$source}' WHERE id='{$pid}' AND from_oj='UvaLive'";
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
	function Extract_UvaLive_pdf($pid,$url){
		$content="";
		$content = file_get_contents($url);
		if(strlen($content)==0)return;
		
		$temp=$content;
		$temp = explode( '<a href="external', $temp )[1];
		$pdflink="https://icpcarchive.ecs.baylor.edu/external".explode( '">' , $temp )[0];

		$pdf=get_url($pdflink);
		
		$myfile = fopen("pdfs\\P{$pid}.pdf", "w") or die("Unable to open file!");
		fwrite($myfile, $pdf);
		fclose($myfile);
	}
	
	function uvalive()
	{
		$start=time();
		global $db,$pro;
		$url="https://icpcarchive.ecs.baylor.edu/uhunt/api/p";
		$response=file_get_contents($url);
		$result=json_decode($response,true);
		$now=time()-$start;
		$f = fopen("uvalive_status.txt", "w") or die("Unable to open file!");
		if(count($result)!=0)
		fwrite($f, "UvaLive api Success at {$now}".PHP_EOL);
		else fwrite($f, "UvaLive api faild at {$now}".PHP_EOL);
		$auto="<script> 
				$(function(){ 
					var UvaLive = [";
		for($i=0;$i<count($result);$i++)
		{
			/*if(IS_RUN('uvalive')=="false")
			{
				$now=time()-$start;
				fwrite($f, "uvalive Force Stop At {$now}".PHP_EOL);
				return;
			}*/
			$now=time()-$start;
			fwrite($f, "P{$result[$i][1]} start at {$now}".PHP_EOL);
			foreach($pro as $x=>$y)
					$pro[$x]='';
			$pro['url']="https://icpcarchive.ecs.baylor.edu/index.php?option=com_onlinejudge&Itemid=8&page=show_problem&problem={$result[$i][0]}";
			$pro['id']=$result[$i][1];
			$pro['solved_count']=$result[$i][3];
			$pro['ind']=$result[$i][0];
			$pro['name']=$result[$i][2];
			$pro['time_limit']=$result[$i][19];
			$pro['memory_limit']=131072;
			$pro['from_oj']='UvaLive';
			$pro['input_type']='standard input';
			$pro['output_type']='standard output';
			$pro['name']=str_replace('"',"'",$pro['name']);
			Extract_UvaLive_pdf($pro['id'],$pro['url']);
			foreach($pro as $x=>$y)
					$pro[$x]=mysqli_real_escape_string($db,$y);
					
			$auto.='{ value: "'.$pro['id'].' - '.$pro['name'].'" },';
			
			$query="SELECT problem_id FROM problem where id='{$pro['id']}' AND from_oj='UvaLive'";
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
				  
				  // setup autocomplete function pulling from UvaLive[] array
				  $('#autocomplete').autocomplete({
					lookup: UvaLive,
				  });
				  
				});
		  </script>";
			
			
		$myfile = fopen("auto_uvalive.php", "w") or die("Unable to open file!");
		fwrite($myfile, $auto);
		fclose($myfile);
		$now=time()-$start;
		fwrite($f, "Updata source start at {$now}".PHP_EOL);
		uvalive_sources();
		$now=time()-$start;
		fwrite($f, "Updata source end at {$now}".PHP_EOL);
		fwrite($f, "Finish Success at {$now}".PHP_EOL);
		fclose($f);
	}
	
?>


<?php
	uvalive();
?>
