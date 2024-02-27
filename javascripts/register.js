// JavaScript Document

function validateform(form)
	{
		
		if(document.regForm.txtName.value.length==0)
		{
			alert("Please enter your name");
			return false;
		}
		else if(document.regForm.txtAddress.value.length==0)
		{
			alert("Please enter your address");
			return false;
		}
		else if(document.regForm.txtMobile.value.length==0)
		{
			alert("Please enter mobile number");
			return false;
		}
		else if(isNaN(document.regForm.txtMobile.value))
		{
		alert("Mobile number should be numeric");
		return false; 
		}
		
		else if(!/^(?:7|0|(?:\+94))[0-9]{8,9}$/.test(document.regForm.txtMobile.value)) 
		{
		alert("Please enter a valid mobile number");
		return false; 
		}
		
		else if(document.regForm.password.value!=document.regForm.cpassword.value)
		{
		alert("Password and confirm password do not match");
		return false; 
		}
		
		else if(document.regForm.password.value!=document.regForm.cpassword.value)
		{
		alert("Password and confirm password do not match");
		return false; 
		}
		else
		{
			return true;
		}
		

	}