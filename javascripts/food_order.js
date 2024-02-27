// JavaScript Document
if(document.frmOrder.txtCusID.value.length==0)
	{
		alert("Please enter customer ID");
		return false;
	}
else if(isNaN(document.frmOrder.txtCusID.value))
{
		alert("Customer ID should be numeric");
		return false;
}
else if(document.frmOrder.dateOrder.value=="")
	{
		alert("Please select a date");
		return false;
	}
else if(document.frmOrder.txtAmount.value.length==0)
	{
		alert("Please enter amount");
		return false;
	}
else if(isNaN(document.frmOrder.txtAmount.value))
{
		alert("Amount should be numeric");
		return false;
}
else
	{
		return true;
	}