function FrontPage_Form_Validator(theForm)
{
  var checkOK = "0123456789";
  var checkStr = theForm.money.value;
  var allValid = true;
  var decPoints = 0;
  var allNum = "";
  for (i = 0;  i < checkStr.length;  i++)
  {
    ch = checkStr.charAt(i);
    for (j = 0;  j < checkOK.length;  j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length)
    {
      allValid = false;
      break;
    }
    if (ch != ",")
      allNum += ch;
  }
  if (!allValid)
  {
    alert("月收入中只能输入数字。");
    return (false);
  }

  var checkOK = "0123456789";
  var checkStr = theForm.KCmoney.value;
  var allValid = true;
  var decPoints = 0;
  var allNum = "";
  for (i = 0;  i < checkStr.length;  i++)
  {
    ch = checkStr.charAt(i);
    for (j = 0;  j < checkOK.length;  j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length)
    {
      allValid = false;
      break;
    }
    if (ch != ",")
      allNum += ch;
  }
  if (!allValid)
  {
    alert("起征额中只能输入数字。");
    return (false);
  }

var basicm,totalmoney,cha,output;
totalmoney=document.taxForm.money.value;
basicm=document.taxForm.KCmoney.value;
cha=(totalmoney-basicm);
if (cha<=0) {output=0;}
if (cha>0&&cha<=500) {output=cha*0.05;}
if (cha>500&&cha<=2000) {output=cha*0.1-25;}
if (cha>2000&&cha<=5000) {output=cha*0.15-125;}
if (cha>5000&&cha<=20000) {output=cha*0.2-375;}
if (cha>20000&&cha<=40000) {output=cha*0.25-1375;}
if (cha>40000&&cha<=60000) {output=cha*0.30-3375;}
if (cha>60000&&cha<=80000) {output=cha*0.35-6375;}
if (cha>80000&&cha<=100000) {output=cha*0.4-10375;}
if (cha>100000&&cha>100000) {output=cha*0.45-15375;}
alert("应缴个人所得税额="+output+"元"+"\n"+"\n"+"依法纳税是每个公民应尽的义务！！");
return (false);
}