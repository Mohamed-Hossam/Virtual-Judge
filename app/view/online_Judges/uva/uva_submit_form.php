<form  name="SForm" action=<?php echo $url;?> method=post>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
					<div class="modal-content">
							<div class="modal-header">
							<h1 style="color:#333;"><span class="label label-danger">Submit for problem:<?php echo $id;?></span></h1>
							</div>
							<div class="modal-body">
								<h4>&nbsp;&nbsp;&nbsp;&nbsp;User &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $_COOKIE['user_handle'];?></h4>
								<h4>
								<div  class="form-inline">
								&nbsp;&nbsp;&nbsp;&nbsp;Language :
									<select class="form-control"  name="lang" onchange="highlight()">
										    <option value="1ANSI C 5.3.0"
													>ANSI C 5.3.0</option>
													
											<option value="2JAVA 1.8.0"
													>JAVA 1.8.0</option>
													
											<option value="3C++ 5.3.0"
													>C++ 5.3.0</option>
													
											<option value="4PASCAL 3.0.0"
													>PASCAL 3.0.0</option>
													
											<option value="5C++11 5.3.0"
													selected="true">C++11 5.3.0</option>
													
										    <option value="6PYTH3 3.5.1"
													>PYTH3 3.5.1</option>
									</select>
								</div>
								</h4>
								   

								<textarea  name="id"   hidden=""><?php echo $id;?></textarea>
								<textarea  name="IID"  hidden=""><?php echo $ind;?></textarea>
								<textarea  name="oj"  hidden="">uva</textarea>
								<textarea  name="CID"  hidden=""></textarea>
								<?php require_once("../../public/ace editor/our/submit_editor.php");?>
								<!--textarea class="form-control" rows="15" name="solution" value="" placeholder="Enter Your Solution" ></textarea!-->
							</div>
							<div class="modal-footer" >
									<p id="mes"><p>
									<input id="SBUT" type="button" onclick="submit_validation()" class="btn btn-info" value="Submit">
							</div>
					</div>
			</div>
		</div>
	</form>
<script>
function highlight()
{
	var lang = document.forms['SForm']['lang'].value;

		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				var result = hr.responseText;
				//alert(result);			
				var mode="ace/mode/"+result;
				editor.session.setMode(mode);

			}
		};
		var v="lang="+encodeURIComponent(lang);
		hr.open("POST", "http://localhost/our3/public/map/ace_map.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}	
</script>
	