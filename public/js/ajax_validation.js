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