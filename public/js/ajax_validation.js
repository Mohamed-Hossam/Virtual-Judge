function register_validation()
{
	
	var handle = document.forms['Rform']['handle'].value;
	var firstname = document.forms['Rform']['firstname'].value;
	var lastname = document.forms['Rform']['lastname'].value;
	var password = document.forms['Rform']['password'].value;
	var Cpassword = document.forms['Rform']['Cpassword'].value;
	var email = document.forms['Rform']['email'].value;
	var school = document.forms['Rform']['school'].value;
	
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				//exit;
				result=JSON.parse(result);
				
				document.getElementById("v_handle").innerHTML = result['handle'];
				document.getElementById("v_firstname").innerHTML = result['firstname'];
				document.getElementById("v_lastname").innerHTML = result['lastname'];
				document.getElementById("v_password").innerHTML = result['password'];
				document.getElementById("v_Cpassword").innerHTML = result['Cpassword'];
				document.getElementById("v_email").innerHTML = result['email'];
				document.getElementById("v_school").innerHTML = result['school'];
		
				
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.getElementById("R").submit();
				}
			}
		};
		var v = "handle="+handle+"&"+"firstname="+firstname+"&"+"lastname="+lastname+"&"+"password="+password+"&"+"Cpassword="+Cpassword+"&"+"email="+email+"&"+"school="+school;
		hr.open("POST", "app/controller/registerController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}
function login_validation()
{
	var Handle = document.forms['Lform']['Handle'].value;
	var Password = document.forms['Lform']['Password'].value;
	
	
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
			
				document.getElementById("v_Handle").innerHTML = result['Handle'];
				document.getElementById("v_Password").innerHTML = result['Password'];
			
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.getElementById("L").submit();
				}
			}
		};
		var v = "Handle="+Handle+"&"+"Password="+Password;
		hr.open("POST", "app/controller/loginController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}
function submit_validation()
{
	var solution = editor.getValue();
	var lang = document.forms['SForm']['lang'].value;
	var id = document.forms['SForm']['id'].value;
	var CID = document.forms['SForm']['CID'].value;
	var IID = document.forms['SForm']['IID'].value;
	var oj = document.forms['SForm']['oj'].value;
	
	
	document.getElementById("SBUT").disabled = true;
	
		document.getElementById("mes").innerHTML='<img src="http://localhost/our3/public/img/loader.gif" width="45" height="45"/> Loading...';
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				alert(result);
			
				result=JSON.parse(result);
				
				document.getElementById("mes").innerHTML ="<h4 style='color:red;'>" +result['solution']+"</h4>";
			
				
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.forms['SForm'].submit();
				}
				document.getElementById("SBUT").disabled = false;
			}
		};
		var v = "solution="+encodeURIComponent(solution)+"&"+"lang="+encodeURIComponent(lang)+"&"+"id="+id+"&"+"CID="+CID+"&"+"IID="+IID+"&"+"oj="+oj;
		

		hr.open("POST", "../controller/submitController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}

function add_contest_validation()
{
	var contest_name = document.forms['form']['contest_name'].value;
	var date = document.forms['form']['date'].value;
	var hour = document.forms['form']['hour'].value;
	var min = document.forms['form']['min'].value;
	var Edate = document.forms['form']['Edate'].value;
	var Ehour = document.forms['form']['Ehour'].value;
	var Emin = document.forms['form']['Emin'].value;
	var type = document.forms['form']['type'].value;
	
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
				
				document.getElementById("v_contest_name").innerHTML=result['contest_name'];
				document.getElementById("v_start").innerHTML=result['start'];
				document.getElementById("v_end").innerHTML=result['end'];
											
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.forms['form'].submit();
				}
			}
		};
		var v = "contest_name="+encodeURIComponent(contest_name)+"&"+"date="+date+"&"+"hour="+hour+"&"+"min="+min+"&"+"Edate="+Edate+"&"+"Ehour="+Ehour+"&"+"Emin="+Emin+"&"+"type="+type;
	
		hr.open("POST", "../controller/addcontestController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}

function add_problem_validation()
{
		var	id	      		= document.forms['form']['id'].value;
		var mode      		= document.forms['form']['mode'].value;
		var level     		= document.forms['form']['level'].value;
		var operation 		= document.forms['form']['operation'].value;
		var regional  		= document.forms['form']['regional'].value;
		var world     		= document.forms['form']['world'].value;
		var problem_search  = document.forms['form']['problem_search'].value;
		var problem_num  	= document.forms['form']['problem_num'].value;
		
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
				
				document.getElementById("error").innerHTML=result['error'];
											
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.forms['form'].submit();
				}
			}
		};
		var v = "problem_search="+encodeURIComponent(problem_search)+'&'+"id="+id;
		v+='&'+"mode="+mode+'&'+"level="+level+'&'+"operation="+operation+'&'+"regional="+regional+'&'+"world="+world+'&'+"problem_num="+problem_num;
	
		hr.open("POST", "../controller/addcontestproblemController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}
function invite_contest_validation()
{
	var name = document.forms['form']['name'].value;
	var	id	 = document.forms['form']['id'].value;
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
				
				document.getElementById("v_name").innerHTML=result['name'];
											
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.forms['form'].submit();
				}
			}
		};
		var v = "name="+encodeURIComponent(name)+'&'+"id="+id;
	
		hr.open("POST", "../controller/inviteController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}

function edit_contest_validation()
{
	var contest_name = document.forms['form']['contest_name'].value;
	var date = document.forms['form']['date'].value;
	var hour = document.forms['form']['hour'].value;
	var min = document.forms['form']['min'].value;
	var Edate = document.forms['form']['Edate'].value;
	var Ehour = document.forms['form']['Ehour'].value;
	var Emin = document.forms['form']['Emin'].value;
	var type = document.forms['form']['type'].value;
	var	id	 = document.forms['form']['id'].value;
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
				
				document.getElementById("v_contest_name").innerHTML=result['contest_name'];
				document.getElementById("v_start").innerHTML=result['start'];
				document.getElementById("v_end").innerHTML=result['end'];
											
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.forms['form'].submit();
				}
			}
		};
		var v = "contest_name="+encodeURIComponent(contest_name)+"&"+"date="+date+"&"+"hour="+hour+"&"+"min="+min+"&"+"Edate="+Edate+"&"+"Ehour="+Ehour+"&"+"Emin="+Emin+"&"+"type="+type+"&"+"id="+id;
	
		hr.open("POST", "../controller/editcontestController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}
function register_team_validation()
{
		var team_name = document.forms['form']['team_name'].value;
		var	id	 = document.forms['form']['id'].value;
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
				
				document.getElementById("v_team_name").innerHTML=result['team_name'];
											
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.forms['form'].submit();
				}
			}
		};
		var v = "team_name="+encodeURIComponent(team_name)+'&'+"id="+id;
	
		hr.open("POST", "../controller/registerteamController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}
function blog_validation()
{
	var blog_title = document.forms['form']['blog_title'].value;
	var txtEditor = document.forms['form']['txtEditorContent'].value;
	var tags = document.forms['form']['tags'].value;
	var blog_about = document.forms['form']['blog_about'].value;
	var edit = document.forms['form']['edit'].value;
	
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				
				result=JSON.parse(result);
				
				document.getElementById("v_blog_title").innerHTML =result['blog_title'];
				document.getElementById("v_blog_about").innerHTML =result['blog_about'];
				document.getElementById("v_txtEditor").innerHTML =result['txtEditor'];
				document.getElementById("v_tags").innerHTML =result['tags'];
				
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.forms['form'].submit();
				}
			}
		};
		var v = "blog_title="+encodeURIComponent(blog_title)+"&"+"blog_about="+encodeURIComponent(blog_about)+"&"+"txtEditor="+encodeURIComponent(txtEditor)+"&"+"tags="+encodeURIComponent(tags)+"&"+"edit="+edit;
		
		hr.open("POST", "../controller/postController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}

function comment_validation()
{
	var comment = document.forms['form']['comment'].value;
	var id = document.forms['form']['id'].value;
	
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
				
				document.getElementById("v_comment").innerHTML=result['comment'];
											
				if(result["statue"].indexOf('OK')!=-1)
				{
					document.getElementById("comment").value=' ';
					$('.comments').append(result['c']);
					window.scrollTo(0,10000000);
				}
			}
		};
		var v = "comment="+encodeURIComponent(comment)+"&"+"id="+encodeURIComponent(id);
		
		hr.open("POST", "../controller/commentController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}

function reply_validation()
{
	var reply = document.forms['Rform']['reply'].value;
	var comment_id = document.forms['Rform']['comment_id'].value;
	
		var hr = new XMLHttpRequest();
		hr.onreadystatechange = function() 
		{
			if(hr.readyState == 4 && hr.status == 200) 
			{		
				result = hr.responseText;
				//alert(result);
				result=JSON.parse(result);
				
				document.getElementById("v_reply").innerHTML=result['reply'];
											
				if(result["statue"].indexOf('OK')!=-1)
				{
					$("#"+comment_id).append(result['c']);
					$('#reply_model').modal('hide');
					document.forms['Rform']['reply'].value=' ';
				}
			}
		};
		var v = "reply="+encodeURIComponent(reply)+"&"+"comment_id="+encodeURIComponent(comment_id);
		
		hr.open("POST", "../controller/replayController.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.send(v);
}