<?php
	require_once('menu.php');
	require_once('../controller/contestController.php');
	require_once('contest_menu.php');
	if(!$status)
		redirect('http://localhost/our3/app/view/contest.php');
	$pro=$controller->get_problems();
	$stand=$controller->get_standing();
	
?>
<br><br><br>
<head>
<link href="http://localhost/our3/public/css/contest_table.css" rel="stylesheet">
</head>

<div class="container">

	<div >
	  <table border='0' cellpadding='0' cellspacing='0'>
		<tr class='days'>
		  <th ><div  style='color:WHITE; text-align:center'>contestant</div></th>
		  <th ><div  style='color:WHITE; text-align:center'>Ac</div></th>
		  <th ><div  style='color:WHITE; text-align:center'>Penalty</div></th>
		  <?php
			$o=1;
			while($r=mysqli_fetch_assoc($pro))
			{
				$name=$r['from_oj'].' - '.$r['id'].' - '.$r['name'];
				$name=str_replace("'",'"',$name);
				 echo "<th ><a title='{$name}' href='contest_problem.php?id={$_GET['id']}&pid={$r['problem_id']}'><div  style='color:WHITE; text-align:center'>Problem {$o}</div></a></th>";
				$o++;
			}
		  ?>
		</tr>
		<?php 
		
			for($i=0;$i<count($stand)-1;$i++)
			{
				echo '<tr>';
				echo "<td class='time'><div  style='color:WHITE;'>{$stand[$i][0]}</div></td>";
				echo "<td><div  style='color:BLACK; text-align:center'>{$stand[$i][1]}</div></td>";
				echo "<td><div  style='color:BLACK; text-align:center'>{$stand[$i][2]}</div></td>";
				for($j=3;$j<count($stand[$i]);$j++)
				{
					if($stand[$i][$j][0]==0&&$stand[$i][$j][1]==0)echo '<td>-</td>';
					else if($stand[$i][$j][0]==0)echo "<td class='md313 red' data-tooltip='{$stand[$i][$j][2]}' style='text-align:center'>{$stand[$i][$j][1]}</td>";
					else echo "<td class='md352 green' data-tooltip='{$stand[$i][$j][2]}' style='text-align:center'>{$stand[$i][$j][0]} [{$stand[$i][$j][1]}]</td>";
				}
				echo '</tr>';
			}
			echo '<tr>';
			echo "<td>-</td>";
			echo "<td><div style='color:BLACK; text-align:center'>AC/All</div></td>";
			echo "<td>-</td>";
			for($j=3;$j<count($stand[0]);$j++)
			{
				$i=count($stand)-1;
				echo "<td><div  style='color:BLACK; text-align:center'> {$stand[$i][$j][0]}/{$stand[$i][$j][1]}  </div></td>";
			}
			echo '</tr>';
			
		?>
	  </table>
	</div>
</div>


<script>
	function judge_all()
	{
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{			
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
			
				/*for(var k in result) 
				{
					document.getElementById(k).innerHTML=result[k];
				}*/
				
			}
		};
		hr.open("POST", "../controller/judgeController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send();
	}
	setInterval(function() {
	  judge_all();
	}, 5000);
</script>
