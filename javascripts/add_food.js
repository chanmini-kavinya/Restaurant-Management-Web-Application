// JavaScript Document
/*let file = document.getElementById("fileName");
function validateFileType()
	{
		  var fileName = file.value,
		  idxDot = fileName.lastIndexOf(".") + 1,
		  extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
		  if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
			//TO DO
		  }else{
			alert("Only jpg/jpeg and png files are allowed!");
			file.value = "";  // Reset the input so no files are uploaded
		  }
	}*/


function validateform(form)
	{
		
		if(document.form1.txtName.value.length==0)
		{
			alert("Please enter the food name");
			return false;
		}
		else if(document.form1.txtPrice.value.length==0)
		{
			alert("Please enter the price");
			return false;
		}
		else if(isNaN(document.form1.txtPrice.value))
		{
		alert("Price should be numeric");
		return false; 
		}
		else
		{
			return true;
		}
		

	}