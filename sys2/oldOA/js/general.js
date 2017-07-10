//ajax
function ajaxAction(t, u, d, dt, m) {
	$.ajax( {
		type : t,
		url : u,
		data : d,
		dataType : dt,
		error : function(html) {
			alert('ajax提交出错,请联系系统管理员!');
		},
		success : m
	});
}

// ajax 请求完毕后隐藏加载条
$("#loading").bind("ajaxSend", function() {
	$(this).show();
}).bind("ajaxComplete", function() {
	$(this).fadeOut("slow");
});
// 提交验证
function validator(item, form, errorDiv, successFun) {
	$(item).formValidator( {
		onSuccess : successFun,
		scope : form,
		errorDiv : errorDiv,
		errorMsg : {
			reqString : '请填写信息',
			reqDate : '日期格式不正确(2009-10-21)',
			reqNum : '填写信息必须是数字',
			reqMailNotValid : 'E-Mail不合法',
			reqMailEmpty : 'E-mail不能为空',
			reqSame : '填入信息不一致',
			reqBoth : 'Related field(s) required',
			reqMin : '长度不够'
		}
	});
}

// 获取GET参数
function getQuery(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if (r != null)
		return unescape(r[2]);
	return null;
}

// 全选/反选
function checkAll(clickChk, actionChk) {
	if ($(clickChk).attr('checked') == true) {
		$(actionChk).attr('checked', true);
	} else {
		$(actionChk).attr('checked', false);
	}
}

// 判断变量为空 true为空,FALSE为非空

function IsEmpty(v) {
	switch (typeof v) {
	case 'undefined':
		return true;
		break;
	case 'string':
		if (trim(v).length == 0)
			return true;
		break;
	case 'boolean':
		if (!v)
			return true;
		break;
	case 'number':
		if (0 === v)
			return true;
		break;
	case 'object':
		if (null === v)
			return true;
		if (undefined !== v.length && v.length == 0)
			return true;
		for ( var k in v) {
			return false;
		}
		return true;
		break;
	}
	return false;
}
// 去空格
function trim(str) {
	return str.replace(/(^[\\s]*)|([\\s]*$)/g, "");
}
function lTrim(str) {
	return str.replace(/(^[\\s]*)/g, "");
}
function rTrim(str) {
	return str.replace(/([\\s]*$)/g, "");
}

// 判断数组是否重复 返回 true 重复,FALSE 不重复 ,另外exec 可替换test,返回为数组形式
function validArrRepeat(arr) {
	
    var ret = /(\x0f[^\x0f]+\x0f)[\s\S]*\1/g.exec("\x0f" + arr.join("\x0f\x0f")+ "\x0f");
	return ret;
}

// 验证数组重复 object 表示JQUERY的选择器
function validRepeat(object) {
	var selVal = new Array;
	$(object).each(function(i) {
		var thisValue = $(this).val();
		if (IsEmpty(thisValue) == false) {
			selVal[i] = thisValue;
		}
	});
	repVal = validArrRepeat(selVal);
	if (repVal) {
		// 反序,取得重复字符串
		repVal.sort();
		// 去除自主添加的分隔符,取得重复字符串
		var errorVal = (repVal[0]).replace(/\x0f/g, "");
		// 错误处理,只取最后一个错误,也就是说若要全部错误显示,则需存放在一个数组中,而不是一个变量
		$(object).each(function(k) {
			if ($(this).val() == errorVal) {

				$(this).addClass("error-input");
			} else {
				$(this).removeClass("error-input");
				return true;
			}
		});
	}
}
//true是空,false为非空
function isChecked(checkName){
		     var checkValue;
            $(checkName+":checked").each(function(i){
                checkValue +=$(this).val();
                });
          if(IsEmpty(checkValue)==true){
                 return true;
              }else{
                 return false;
              }
		}

		
//URL中文字符转码

 // PE = percent encoding
 function fPEUtf8ToGb(sUtf8PE)
 { // shawl.qiu code, return string; Func: fGetUtf8PE
  if(sUtf8PE.indexOf("%")===-1) return sUtf8PE;
  var iLBound = parseInt("7d", 16);
  
  for(var i=0, j=sUtf8PE.length; i<j; i++)
  {
   var iIndex = sUtf8PE.indexOf("%", i);
   if(iIndex===-1) break;
   i=iIndex+1;
   
   var sHex = sUtf8PE.slice(i, i+2);
   if(parseInt(sHex, 16)>iLBound)
   {
    var sHexExt = sUtf8PE.slice(i+2, i+8);
    if(/\%..\%/.test(sHexExt))
    {
     var TempStr = sUtf8PE.slice(i-1, i+8);
     TempStr = fGetUtf8PE(TempStr);
     sUtf8PE = [sUtf8PE.slice(0, i-1), TempStr, sUtf8PE.slice(i+8)].join("");
     i-=1;
    }
   } // end if(parseInt(sHex, 16)>iLBound)
  } // end for(var i=0, j=sUtf8PE.length; i<j; i++)
  
  if(sUtf8PE.indexOf("%")===-1) return sUtf8PE;
  
  for(var i=0, j=sUtf8PE.length; i<j; i++)
  {
   var iIndex = sUtf8PE.indexOf("%", i);
   if(iIndex===-1) break;
   i=iIndex+1;
   
   var sHex = sUtf8PE.slice(i, i+2);
   var iDec = parseInt(sHex, 16);
   var sAsc = String.fromCharCode(iDec);
   sUtf8PE = [sUtf8PE.slice(0, i-1), sAsc, sUtf8PE.slice(i+2)].join("");
   i-=1;
  } // end for(var i=0, j=sUtf8PE.length; i<j; i++)
  
  return sUtf8PE;
 } // end function fPEUtf8ToGb(sUtf8PE)

 // PE = percent encoding
 function fGetUtf8PE(sUtf8PE) // %xx%xx%xx
 { // shawl.qiu code, return string
  var Ar = sUtf8PE.replace(/\%/, "").split("%");
  var TAr = [];
  for(var i=0, j=Ar.length; i<j; i++) 
  {
   Ar[i] = parseInt(Ar[i], 16).toString(2);
   var iZeroIndex = Ar[i].indexOf("0");
    if(i===0)
    {
     Ar[i] = Ar[i].slice(iZeroIndex+1);
     TAr.push(Ar[i]);
    }
    else
    {
     Ar[i] = Ar[i].substr(2);
     TAr.push(Ar[i]);
    }
  } // end for(var i=0, j=Ar.length; i<j; i++) 
  var sHex = parseInt(TAr.join(""), 2).toString(16);
  return unescape("%u"+sHex);
 } // end function fGetUtf8PE(sUtf8PE)

 function utf8ToStr(URIStr){
 	return fPEUtf8ToGb(escape(URIStr));
 }
