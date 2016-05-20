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
									<select class="form-control"  name="lang"  onchange="highlight()">
								     		<option value="7ADA 95 (gnat 5.1)">ADA 95 (gnat 5.1)</option>
											<option value="13Assembler (nasm 2.11.05)">Assembler (nasm 2.11.05)</option>
											<option value="45Assembler GC (g++ 5.1)">Assembler GC (g++ 5.1)</option>
											<option value="104Awk (gawk-4.1.1)">Awk (gawk-4.1.1)</option>
											<option value="28Bash (bash-4.3.33)">Bash (bash-4.3.33)</option>
											<option value="12Brainf**k (bff 1.0.5)">Brainf**k (bff 1.0.5)</option>
											<option value="81C (clang 3.7)">C (clang 3.7)</option>
											<option value="11C (gcc 5.1)">C (gcc 5.1)</option>
											<option value="27C# (gmcs 4.0.2)">C# (gmcs 4.0.2)</option>
											<option value="82C++ (clang 3.7)">C++ (clang 3.7)</option>
											<option value="41C++ (g++ 4.3.2)">C++ (g++ 4.3.2)</option>
											<option value="1C++ (g++ 5.1)">C++ (g++ 5.1)</option>
											<option value="44C++14 (g++ 5.1)" selected="true">C++14 (g++ 5.1)</option>
											<option value="34C99 strict (gcc 5.1)">C99 strict (gcc 5.1)</option>
											<option value="14Clips (clips 6.24)">Clips (clips 6.24)</option>
											<option value="111Clojure (clojure 1.7)">Clojure (clojure 1.7)</option>
											<option value="118Cobol (opencobol 1.1)">Cobol (opencobol 1.1)</option>
											<option value="32Common Lisp (clisp 2.49)">Common Lisp (clisp 2.49)</option>
											<option value="31Common Lisp (sbcl 1.2.12)">Common Lisp (sbcl 1.2.12)</option>
											<option value="102D (dmd 2.067.1)">D (dmd 2.067.1)</option>
											<option value="84D (ldc 3.7)">D (ldc 3.7)</option>
											<option value="20D (gdc 5.1)">D (gdc 5.1)</option>
											<option value="96Elixir (1.1.0)">Elixir (1.1.0)</option>
											<option value="124F# (fsharp 3.1)">F# (fsharp 3.1)</option>
											<option value="92Fantom (1.0.67)">Fantom (1.0.67)</option>
											<option value="5Fortran 95 (gfortran 5.1)">Fortran 95 (gfortran 5.1)</option>
											<option value="114Go (gc 1.4.2)">Go (gc 1.4.2)</option>
											<option value="121Groovy (2.4.4)">Groovy (2.4.4)</option>
											<option value="21Haskell (ghc 7.8)">Haskell (ghc 7.8)</option>
											<option value="16Icon (iconc 9.4.3)">Icon (iconc 9.4.3)</option>
											<option value="9Intercal (ick 0.28-4)">Intercal (ick 0.28-4)</option>
											<option value="24JAR (JavaSE 6)">JAR (JavaSE 6)</option>
											<option value="10Java (JavaSE 8u51)">Java (JavaSE 8u51)</option>
											<option value="112JavaScript (spidermonkey 24.)">JavaScript (spidermonkey 24.)</option>
											<option value="26Lua (luac 5.2)">Lua (luac 5.2)</option>
											<option value="30Nemerle (ncc 0.9.3)">Nemerle (ncc 0.9.3)</option>
											<option value="25Nice (nicec 0.9.13)">Nice (nicec 0.9.13)</option>
											<option value="122Nim (nim 0.11.2)">Nim (nim 0.11.2)</option>
											<option value="83ObjC (clang 3.7)">ObjC (clang 3.7)</option>
											<option value="43ObjC (gcc 5.1)">ObjC (gcc 5.1)</option>
											<option value="8Ocaml (ocamlopt 4.01.0)">Ocaml (ocamlopt 4.01.0)</option>
											<option value="2Pascal (gpc 20070904)">Pascal (gpc 20070904)</option>
											<option value="22Pascal (fpc 2.6.4)">Pascal (fpc 2.6.4)</option>
											<option value="3Perl (perl 5.20.1)">Perl (perl 5.20.1)</option>
											<option value="29PHP (php 5.6.9)">PHP (php 5.6.9)</option>
											<option value="94PicoLisp (3.1.1)">PicoLisp (3.1.1)</option>
											<option value="19Pike (pike 7.8)">Pike (pike 7.8)</option>
											<option value="15Prolog (swipl 7.2)">Prolog (swipl 7.2)</option>
											<option value="4Python (python 2.7.10)">Python (python 2.7.10)</option>
											<option value="99Python (PyPy 2.6)">Python (PyPy 2.6)</option>
											<option value="116Python 3 (python 3.4)">Python 3 (python 3.4)</option>
											<option value="126Python 3 nbc (python 3.2.3 nbc)">Python 3 nbc (python 3.2.3 nbc)</option>
											<option value="98Python3.4 (Python 3.4)">Python3.4 (Python 3.4)</option>
											<option value="17Ruby (ruby 2.1)">Ruby (ruby 2.1)</option>
											<option value="93Rust (1.0.0)">Rust (1.0.0)</option>
											<option value="39Scala (scala 2.11.7)">Scala (scala 2.11.7)</option>
											<option value="97Scheme (chicken 4.9)">Scheme (chicken 4.9)</option>
											<option value="18Scheme (stalin 0.11)">Scheme (stalin 0.11)</option>
											<option value="33Scheme (guile 2.0.11)">Scheme (guile 2.0.11)</option>
											<option value="46Sed (sed-4.2)">Sed (sed-4.2)</option>
											<option value="23Smalltalk (gst 3.2.4)">Smalltalk (gst 3.2.4)</option>
											<option value="38Tcl (tclsh 8.6)">Tcl (tclsh 8.6)</option>
											<option value="42TECS ()">TECS ()</option>
											<option value="62Text (plain text)">Text (plain text)</option>
											<option value="6Whitespace (wspace 0.3)">Whitespace (wspace 0.3)</option>
									</select>
								</div>
								</h4>
								   

								<textarea  name="id"   hidden=""><?php echo $id;?></textarea>
								<textarea  name="IID"  hidden=""><?php echo $pi;?></textarea>
								<textarea  name="oj"  hidden="">spoj</textarea>
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