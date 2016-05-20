<?php  require_once("menu.php");  ?>
<?php  require_once("../controller/statusController.php");?>

<?php 
	
    $p=1;$ar=0;$next="status.php?";$result;
	if(isset($_GET['page']))$p=$_GET['page'];
	
	$p=$controller->page;
	$ar=$controller->all_results;
	$next=$controller->next_url;
	$result=$controller->status;
	
?>
<link href=<?php echo $host.'/public/css/table.css';?> rel="stylesheet">
<script>
  $(function() {
    $( "#problem_search" ).autocomplete({
      source: '../auto_complete/problem_search.php'
    });
  });
  
   $(function() {
    $( "#user" ).autocomplete({
      source: '../auto_complete/user.php'
    });
  });
  </script>
<head>

<link rel="stylesheet" href="http://yandex.st/highlightjs/7.3/styles/vs.min.css">
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script>
<script src="http://localhost/our3/public/js/clipboard.min.js"></script>

<div class="container">
  <form class="form-inline" role="form" action="status.php" method="get">
		<div class="form-group">
		  
			<input type="text" class="form-control" name="Fproblrm"  
			<?php if(isset($_GET["Fproblrm"])){
			
				echo'value="'.$_GET['Fproblrm'].'"';
			} ?>
			
			id="problem_search" value="" placeholder="Search for problem">
			
			<input type="text" class="form-control" name="Fuser"  
			<?php if(isset($_GET["Fuser"])){
			
				echo'value="'.$_GET['Fuser'].'"';
			} ?>
			
			id="user" value="" placeholder="Enter Username">
			
		  
			<select class="form-control" name="verdict">
				  <option value='All'selected="true">All</option>
                  <option value='Accepted'>Accepted</option>
                  <option value='Wrong Answer'>Wrong Answer</option>
                  <option value='Runtime Error'>Runtime Error</option>
				  <option value='Submission Error'>Submission Error</option>
                  <option value='Time Limit Exceed'>Time Limit Exceed</option>
				  <option value='Memory Limit Exceed'>Memory Limit Exceed</option>
				  <option value='Output limit exceeded'>Output limit exceeded</option>  
                  <option value='Presentation Error'>Presentation Error</option>
                  <option value='Compile Error'>Compile Error</option>
                  <option value='Waiting'>Waiting</option>
                  <option value='Judge Error'>Judge Error</option>
			</select>
		    
			<select class="form-control" name="lang">
											<option value="All"
													selected="true">All</option>
											<option value="10GNU GCC 5.1.0"
													>GNU GCC 5.1.0</option>
											<option value="GNU GCC C11 5.1.0"
													>GNU GCC C11 5.1.0</option>
											<option value="GNU G++ 5.1.0"
													>GNU G++ 5.1.0</option>
											<option value="GNU G++11 5.1.0"
													>GNU G++11 5.1.0</option>
											<option value="Microsoft Visual C++ 2010"
													>Microsoft Visual C++ 2010</option>
											<option value="C# Mono 3.12.1.0"
													>C# Mono 3.12.1.0</option>
											<option value="MS C# .NET 4.0.30319"
													>MS C# .NET 4.0.30319</option>
											<option value="D DMD32 v2.068.2"
													>D DMD32 v2.068.2</option>
											<option value="Go 1.5.1"
													>Go 1.5.1</option>
											<option value="Haskell GHC 7.8.3"
													>Haskell GHC 7.8.3</option>
											<option value="Java 1.7.0_80"
													>Java 1.7.0_80</option>
											<option value="Java 1.8.0_66"
													>Java 1.8.0_66</option>
											<option value="OCaml 4.02.1"
													>OCaml 4.02.1</option>
											<option value="Delphi 7"
													>Delphi 7</option>
											<option value="Free Pascal 2.6.4"
													>Free Pascal 2.6.4</option>
											<option value="Perl 5.20.1"
													>Perl 5.20.1</option>
											<option value="PHP 5.4.42"
													>PHP 5.4.42</option>
											<option value="Python 2.7.10"
													>Python 2.7.10</option>
											<option value="Python 3.5.0"
													>Python 3.5.0</option>
											<option value="PyPy 2.7.10 (2.6.1)"
													>PyPy 2.7.10 (2.6.1)</option>
											<option value="PyPy 3.2.5 (2.4.0)"
													>PyPy 3.2.5 (2.4.0)</option>
											<option value="Ruby 2.0.0p645"
													>Ruby 2.0.0p645</option>
											<option value="Scala 2.11.7"
													>Scala 2.11.7</option>
											<option value="JavaScript V8 4.8.0"
													>JavaScript V8 4.8.0</option>
            </select>
		  
		</div>
		<button type="submit" class="btn btn-info">Filter</button>
  </form>
</div>














 

<div class="container">
  <ul class="pagination">
  
    
	<?php if($p!=1){?>
    <li><a  href=<?php echo $next."1"; ?>>First</a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">First</a></li>
	<?php }?>

	<?php if($p!=1){?>
    <li ><a href=<?php $p-=1; echo $next."{$p}"; $p+=1;?>><?php echo "«";?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo "«";?></a></li>
	<?php }?>
	
	<?php if(($p-1)*20<$ar){?>
    <li class="active"><a  href=<?php $p+=0;echo $next."{$p}";$p-=0; ?>><?php echo $p+0;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+0;?></a></li>
	<?php }?>
	
	<?php if(($p)*20<$ar){?>
    <li><a href=<?php $p+=1;echo $next."{$p}";$p-=1; ?>><?php echo $p+1;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+1;?></a></li>
	<?php }?>
	
	<?php if(($p+1)*20<$ar){?>
    <li><a href=<?php $p+=2;echo $next."{$p}";$p-=2; ?>><?php echo $p+2;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+2;?></a></li>
	<?php }?>
	
	<?php if(($p+2)*20<$ar){?>
    <li><a href=<?php $p+=3;echo $next."{$p}";$p-=3; ?>><?php echo $p+3;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+3;?></a></li>
	<?php }?>
	
	<?php if(($p+3)*20<$ar){?>
    <li><a href=<?php $p+=4;echo $next."{$p}";$p-=4; ?>><?php echo $p+4;?></a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#"><?php echo $p+4;?></a></li>
	<?php }?>
	
	<?php if(($p)*20<$ar){?>
    <li><a href=<?php $p+=1;echo $next."{$p}";$p-=1; ?>>»</a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">»</a></li>
	<?php }?>
	
	<?php if(ceil($ar/20.000)!=$p&&$ar!=0){?>
    <li><a href=<?php $x=ceil($ar/20.000);echo $next."{$x}"; ?>>Last</a></li>
    <?php }else{?>
	<li class="disabled"><a  href="#">Last</a></li>
	<?php }?>
	
	
	
	
  </ul>
</div>



<div class="container">      
  <table class="table table-striped">
    <thead>
      <tr>
	   <th>RunID</th>
        <th>Username</th>
       
		<th>PName</th>
		<th>Result</th>
		<th>Language</th>
		<th>Time</th>
		<th>Memory</th>
		<th>Submit Time</th>
      </tr>
    </thead>
    <tbody>
      
	  
	<?php
		$x=0;
		$color=array("Waiting"=>"teal","Judge Error"=>"BLACK","Compile Error"=>"darkorange","Runtime Error"=>"darkred","Wrong Answer"=>"darkred",
		"Time Limit Exceed"=>"peru","Accepted"=>"darkgreen","Memory Limit Exceed"=>"peru","Presentation Error"=>"darkred","Judging"=>"darkred"
		,'Submission Error'=>'BLUE','Output limit exceeded'=>'peru'
		);
		while($x<20&&$row=mysqli_fetch_assoc($result))
		{	
			$x++;
			$url="problem.php?id={$row["problem_id"]}";
	?>  
		  
		   <tr>
		   <td>
			
			<?php
			$t=$row['Soultion'];
			//$t=htmlspecialchars($row['Soultion']);
			$t=str_replace("'",'"',$t);
			echo "<button type='button' class='btn btn-link' data-toggle='modal' data-target='.bs-example-modal-lg' data-lang='{$row["Language"]}' data-content2='{$t}'>{$row["submission_id"]}</button>";
			?>
			</td>    
			<td><a href=<?php echo "user_info.php?handle={$row["user_Handle"]}"?>><?php echo $row["user_Handle"];?></a></td>
			    
			<td><a href=<?php echo $url;?>><?php echo $row["name"];?></a></td>
			<?php 
			if(isset($color[$row["Verdict"]]))
			{
			?>
				<td><div id=<?php echo $row["submission_id"];?>>   <div style="color:<?php echo $color[$row["Verdict"]]; ?>;"> <?php echo $row["Verdict"];?>  </div>  </div></td>
			<?php
			}
			else
				{
			?>
					<td><div id=<?php echo $row["submission_id"];?> style="color:RED;"><?php echo $row["Verdict"];?></div></td>
			<?php
				}
			?>
			<td><?php echo $row["Language"];?></td>
			<td><?php echo $row["TIME"];?>MS</td>
			<td><?php echo $row["memory"];?>KB</td>
			<td><?php echo date("d-m-Y h:i:s",$row["submission_date"]);?></td>
		  </tr>
	<?php }?>
      
    </tbody>
  </table>
</div>

<?php if($x==0)echo "<h4 style='color:red;'><p style='text-align:center'><strong>No Submissions Found</strong></p></h4>"; ?>
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
			
				for(var k in result) 
				{
					document.getElementById(k).innerHTML=result[k];
				}
				
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




<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
					<div class="modal-body">
						<?php require_once("../../public/ace editor/our/view_code.php");?>
						
						<button type="button" class="btn btn-danger" >Copy</button>
					</div>
			</div>
	</div>
</div>


<script>


function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
$('.bs-example-modal-lg').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) 
	var modal = $(this)
	modal.find('.modal-body div').html(escapeHtml(button.data('content2')))
	
	 var clipboard = new Clipboard('.btn', {
        target: function() {
            return document.getElementById("code");
        }
    });

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
	
	
	
	var highlight = ace.require("ace/ext/static_highlight")
    var dom = ace.require("ace/lib/dom")
   
	var lang = button.data('lang');

	var hr = new XMLHttpRequest();
	hr.onreadystatechange = function() 
	{
		if(hr.readyState == 4 && hr.status == 200) 
		{		
			var result = hr.responseText;
			//alert(result);			
			var mod="ace/mode/"+result;
			var x=document.getElementById("code");
			highlight(x, {
            mode: mod,
            theme: x.getAttribute("ace-theme"),
            startLineNumber: 1,
            showGutter: x.getAttribute("ace-gutter"),
            trim: true
        }, function (highlighted) {

        });

		}
	};
	var v="lang="+encodeURIComponent(lang);
	hr.open("POST", "http://localhost/our3/public/map/ace_map.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.send(v);
})
</script>


