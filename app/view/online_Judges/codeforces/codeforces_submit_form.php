<form name="SForm" action=<?php echo $url;?> method=post>
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
										    <option value="10GNU GCC 5.1.0"
													>GNU GCC 5.1.0</option>
											<option value="43GNU GCC C11 5.1.0"
													>GNU GCC C11 5.1.0</option>
											<option value="01GNU G++ 5.1.0"
													>GNU G++ 5.1.0</option>
											<option value="42GNU G++11 5.1.0"
													selected="true">GNU G++11 5.1.0</option>
											<option value="02Microsoft Visual C++ 2010"
													>Microsoft Visual C++ 2010</option>
											<option value="09C# Mono 3.12.1.0"
													>C# Mono 3.12.1.0</option>
											<option value="29MS C# .NET 4.0.30319"
													>MS C# .NET 4.0.30319</option>
											<option value="28D DMD32 v2.068.2"
													>D DMD32 v2.068.2</option>
											<option value="32Go 1.5.1"
													>Go 1.5.1</option>
											<option value="12Haskell GHC 7.8.3"
													>Haskell GHC 7.8.3</option>
											<option value="23Java 1.7.0_80"
													>Java 1.7.0_80</option>
											<option value="36Java 1.8.0_66"
													>Java 1.8.0_66</option>
											<option value="19OCaml 4.02.1"
													>OCaml 4.02.1</option>
											<option value="03Delphi 7"
													>Delphi 7</option>
											<option value="04Free Pascal 2.6.4"
													>Free Pascal 2.6.4</option>
											<option value="13Perl 5.20.1"
													>Perl 5.20.1</option>
											<option value="06PHP 5.4.42"
													>PHP 5.4.42</option>
											<option value="07Python 2.7.10"
													>Python 2.7.10</option>
											<option value="31Python 3.5.0"
													>Python 3.5.0</option>
											<option value="40PyPy 2.7.10 (2.6.1)"
													>PyPy 2.7.10 (2.6.1)</option>
											<option value="41PyPy 3.2.5 (2.4.0)"
													>PyPy 3.2.5 (2.4.0)</option>
											<option value="08Ruby 2.0.0p645"
													>Ruby 2.0.0p645</option>
											<option value="20Scala 2.11.7"
													>Scala 2.11.7</option>
											<option value="34JavaScript V8 4.8.0"
													>JavaScript V8 4.8.0</option>
									</select>
								</div>
								</h4>
								   

								<textarea  name="id"   hidden=""><?php echo $id;?></textarea>
								<textarea  name="CID"  hidden=""><?php echo $cid;?></textarea>
								<textarea  name="IID"  hidden=""><?php echo $ind;?></textarea>
								<textarea  name="oj"  hidden="">codeforces</textarea>
								
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
	
