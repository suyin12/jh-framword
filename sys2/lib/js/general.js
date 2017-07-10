//ajax的form各种形式的submit 例如select=>change , blur ,click
//function 构成模式为接受数据url ,操作元素item, 操作模式type
function formSubmit(url,item,type,form){
    switch(type){
        case "change":
            $(item).change(function(){
                $(form).attr("action",url);
                $(form).submit();
            });
            break;
        case "blur":
            $(item).blur(function(){
                $(form).attr("action",url);
                $(form).submit();
            });
            break;
        case "click":
            $(item).click(function(){
                $(form).attr("action",url);
                $(form).submit();
            });
            break;
    }
}

//ajax
function ajaxAction(t, u, d, dt, m){
    $.ajax({
        type: t,
        url: u,
        data: d,
        dataType: dt,
        error: function(html){
            alert('ajax提交出错,请联系系统管理员!');
        },
        success: m
    });
}
// ajax 请求完毕后隐藏加载条
$("#loading").bind("ajaxSend", function(){
    $("#info").show();
}).bind("ajaxComplete", function(){
    $("#info").fadeOut("slow");
});
//select,刷新页面
function selectReload(select){
    $(select).change(function(){
        var queryString = location.href;
        var val = $(this).val();
        var chkName = $(this).attr("name");
        var newUrl=RegularUrl(queryString ,chkName,val);
        window.location.href = newUrl;
    });
}
//勾选checkbox,刷新页面
function checkReload(checkbox){
    $(checkbox).change(function(){
        var queryString = location.href;
        var val = $(this).attr("checked");
        var chkName = $(this).attr("name");
        var newUrl=RegularUrl(queryString ,chkName,val);
        window.location.href = newUrl;
    });
}
//选择radio,刷新页面
function radioReload(radio){
    $(radio).change(function(){
        var queryString = location.href;
        var val = $(this).val();
        var chkName = $(this).attr("name");
        var newUrl=RegularUrl(queryString ,chkName,val);
        window.location.href = newUrl;
    });
}
//替换URL中的GET变量的值
function RegularUrl(url,key,value){
    var fragPos = url.lastIndexOf("#");
    var fragment="";
    if(fragPos > -1)    {
        fragment = url.substring(fragPos);
        url = url.substring(0,fragPos);
    }
    var querystart = url.indexOf("?");
    if(querystart < 0  )    {
        url +="?"+key+"="+value;
    }else  if (querystart==url.length-1) {
        url +=key+"="+value;
    } else  {
        var Re = new RegExp("[?|&]"+key+"=[^\\s&#]*","gi");
        if (Re.test(url)){
            url=url.replace(Re,"");
            if(url.indexOf("?")<0)
                url += "?"+key+"="+value;
            else
                url += "&"+key+"="+value;	  
        }
        else
            url += "&"+key+"="+value;
    }
    return url+fragment;
}
// 提交验证
function validator(item, form, errorDiv, successFun){
    $(item).formValidator({
        onSuccess: successFun,
        scope: form, 
        errorDiv: errorDiv,
        errorMsg: {
            reqString: '请填写信息',
            reqDate: '日期格式不正确(2009-10-21)',
            reqNum: '填写信息必须是数字',
            reqMailNotValid: 'E-Mail不合法',
            reqMailEmpty: 'E-mail不能为空',
            reqSame: '填入信息不一致',
            reqBoth: 'Related field(s) required',
            reqMin: '长度不够',
            reqLength:"输入长度必须为 %2 位",
            reqNotnull: '值不能为‘0’或者空'
        }
    });
}

// 获取GET参数
function getQuery(name){
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) 
        return unescape(r[2]);
    return null;
}

// 全选/反选
function checkAll(clickChk, actionChk){
    if ($(clickChk).attr('checked') == true) {
        $(actionChk).attr('checked', true);
    }
    else {
        $(actionChk).attr('checked', false);
    }
}


//true是空,false为非空,判断checkbox是否有选择
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
		
// 判断变量为空
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
function trim(str){
    return str.replace(/(^[\\s]*)|([\\s]*$)/g, "");
}

function lTrim(str){
    return str.replace(/(^[\\s]*)/g, "");
}

function rTrim(str){
    return str.replace(/([\\s]*$)/g, "");
}

// 判断数组是否重复 返回 true 重复,FALSE 不重复 ,另外exec 可替换test,返回为数组形式
function validArrRepeat(arr){
    var ret = /(\x0f[^\x0f]+\x0f)[\s\S]*\1/g.exec("\x0f" + arr.join("\x0f\x0f") + "\x0f");
    return ret;
}

// 验证数组重复 object 表示JQUERY的选择器
function validRepeat(object){
    var selVal = new Array;
    $(object).each(function(i){
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
        $(object).each(function(k){
            if ($(this).val() == errorVal) {
                $(this).addClass("error-input");
            }
            else {
                $(this).removeClass("error-input");
                return true;
            }
        });
    }
    else {
        return true;
    }
}
//二级联动,这个联动只针对  客户经理/单位
//例如 action是mID,object是unit,array为联动的数组的json
function linkage(action,object,array){
    $(action).change(function(){
        var j_d = array;
        j_d = eval(j_d);
        
        $.each(j_d, function(i, n){
            if ($(action).val() == n.mID) {
                $(object+" option:not(:eq(0))").remove();
                $.each(n.unit, function(j, v){
                    $(object).append("<option value=" + v.unitID + ">" +
                        v.unitName +
                        "</option>");
                });
            }
            if (!$(action).val()) {
                $.each(n.unit, function(j, v){
                    $(object).append("<option value=" + v.unitID + ">" +
                        v.unitName +
                        "</option>");
                });
            }
        });
        
    });
}

//身份证号码严格验证

function cidInfo(sId){

    var aCity = {
        11: "北京",
        12: "天津",
        13: "河北",
        14: "山西",
        15: "内蒙古",
        21: "辽宁",
        22: "吉林",
        23: "黑龙江",
        31: "上海",
        32: "江苏",
        33: "浙江",
        34: "安徽",
        35: "福建",
        36: "江西",
        37: "山东",
        41: "河南",
        42: "湖北",
        43: "湖南",
        44: "广东",
        45: "广西",
        46: "海南",
        50: "重庆",
        51: "四川",
        52: "贵州",
        53: "云南",
        54: "西藏",
        61: "陕西",
        62: "甘肃",
        63: "青海",
        64: "宁夏",
        65: "***",
        71: "台湾",
        81: "香港",
        82: "澳门",
        91: "国外"
    }
    var iSum = 0
    var info = ""
    if (!/^d{17}(d|x)$/i.test(sId)) 
        return false;
    sId = sId.replace(/x$/i, "a");
    if (aCity[parseInt(sId.substr(0, 2))] == null) 
        return "Error:非法地区";
    sBirthday = sId.substr(6, 4) + "-" + Number(sId.substr(10, 2)) + "-" + Number(sId.substr(12, 2));
    var d = new Date(sBirthday.replace(/-/g, "/"))
    if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate())) 
        return "Error:非法生日";
    for (var i = 17; i >= 0; i--) 
        iSum += (Math.pow(2, i) % 11) * parseInt(sId.charAt(17 - i), 11)
    if (iSum % 11 != 1) 
        return "Error:非法证号";
    return aCity[parseInt(sId.substr(0, 2))] + "," + sBirthday + "," + (sId.substr(16, 1) % 2 ? "男" : "女")
}
