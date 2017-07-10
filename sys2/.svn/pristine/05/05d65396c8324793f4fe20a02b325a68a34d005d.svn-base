var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject()
{
	var xmlHttp;
	
	try
	{
		xmlHttp = new XMLHttpRequest();
	}
	catch (e)
		
		{
			var XmlHttpVersions = new Array("MSXML2.XMlHTTP.6.0",
											"MSXML2.XMlHTTP.5.0",
											"MSXML2.XMlHTTP.4.0",
											"MSXML2.XMlHTTP.3.0",
											"MSXML2.XMlHTTP",
											"Microsoft.XMlHTTP");
	for(var i=0;i<XmlHttpVersions.length && !xmlHttp;i++)
	{
		try
		{
			xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
		}
		catch (e) {}
	}
		}
		
		
		if(!xmlHttp)
			alert("Error crearing XMLHttpRequest");
		else
			return xmlHttp;
}




function CallServer_name()
{
var js_name=document.getElementById("js_name").value;
        if (js_name!="")
        {
var url ="check-name.php?js_name="+js_name; //UTF-8下要用encodeURI
xmlHttp.open("GET",url,true);
xmlHttp.onreadystatechange=handleRequestStateChange_name;
xmlHttp.send(null);
        }else
        {
        	nameDiv = document.getElementById("name_check");
        	nameDiv.innerHTML = "用户名不能为空";
        //alert("请您填写用户名！");
        }

}


function CallServer_email()
{
	
var js_email=document.getElementById("js_email").value;
        if (js_email!="")
        {
        //	myDiv = document.getElementById("email_check");
        //	myDiv.innerHTML = "js_name";
var url ="check-email.php?js_email="+js_email; //UTF-8下要用encodeURI
xmlHttp.open("GET",url,true);
xmlHttp.onreadystatechange=handleRequestStateChange_email;
xmlHttp.send(null);
        }else
        {
        	myDiv = document.getElementById("email_check");
        	myDiv.innerHTML = "email were not empty";
        //alert("请您填写用户名！");
        }

}




function handleRequestStateChange_name()
{
	nameDiv = document.getElementById("name_check");
	if(xmlHttp.readyState < 4)
	{
	//	nameDiv.innerHTML = "loading...<br/>";

	}
		else 	if(xmlHttp.readyState == 4)
		{
			if(xmlHttp.status == 200)
			{
				
				try
				{
				nameDiv.innerHTML=xmlHttp.responseText;
				}
				catch (e)
				{
					alert("error" + e.toString());
				}
			}
			else
			{
				alert("problrm" + e.toString());
			}
		}
}


function handleRequestStateChange_email()
{
//	alert("请您填写用户名！");
	myDiv = document.getElementById("email_check");
	if(xmlHttp.readyState < 4)
	{
	//	myDiv.innerHTML = "loading...<br/>";

	}
		else 	if(xmlHttp.readyState == 4)
		{
			if(xmlHttp.status == 200)
			{
				
				try
				{
				myDiv.innerHTML=xmlHttp.responseText;
				}
				catch (e)
				{
					alert("error" + e.toString());
				}
			}
			else
			{
				alert("problrm" + e.toString());
			}
		}
}




function checkpass1()
  {
    var Inform="tx1";
 var Inputname="repassword";
    var Form=Inform+"."
    eval("Temp="+Form+Inputname+".value;"); 
 //alert(Temp);
 if(Temp==""){ 
 msg="it can't to be empty!!"; 
 }
 else
 {  
      if(Temp.length<6||Temp.length>20)
   {
     msg="password must between 6 and 20";
   }
   else
   {
  var Inputname1="password";
     eval("Temp1="+Form+Inputname1+".value");
  if (Temp!=Temp1)
  {
          eval(Form+Inputname+".value='';");
    eval(Form+Inputname1+".value='';");
    eval(Form+Inputname1+".focus();");
    msg="twice password are different！"; 
    msg1="";
    var ch1=document.getElementById("password2");
    ch1.innerHTML="<font color='#aaaaaa'>"+msg1+"</font>";
  }
  else
  {
    msg="right input!!";
  }
   }
 }
 var ch=document.getElementById("password3");
 ch.innerHTML="<font color='#aaaaaa'>"+msg+"</font>"; 
  }
  
  
function checkpass()
  {
    var Inform="tx1";
 var Inputname="password";
    var Form=Inform+"."
    eval("Temp="+Form+Inputname+".value;"); 
 //alert(Temp);
 if(Temp==""){ 
 msg="it can't to be empty!!"; 
 }
 else
 {  
      if(Temp.length<6||Temp.length>20)
   {
     msg="password must between 6 and 20";
   }
   else
   {
     msg="right input!!";
   }
 }
 var ch=document.getElementById("password2");
 ch.innerHTML="<font color='#aaaaaa'>"+msg+"</font>";
  }

function checkAddress()
{
  var Inform="tx1";
var Inputname="address";
  var Form=Inform+"."
  eval("Temp="+Form+Inputname+".value;"); 
//alert(Temp);
if(Temp==""){ 
msgAds="it can't to be empty!!"; 
}
else
{  
    
	msgAds="right input!!";

}
var chAds=document.getElementById("addressMsg");
chAds.innerHTML="<font color='#aaaaaa'>"+msgAds+"</font>";
}