{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/supernote.js></script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
{literal}
<script type="text/javascript">
/* jQuery plugins supernote START  */
var supernote = new SuperNote('supernote', {});
function animFade(ref, counter){
    var f = ref.filters, done = (counter == 1);
    if (f) {
        if (!done && ref.style.filter.indexOf("alpha") == -1) 
            ref.style.filter += ' alpha(opacity=' + (counter * 100) + ')';
        else 
            if (f.length && f.alpha) 
                with (f.alpha) {
                    if (done) 
                        enabled = false;
                    else {
                        opacity = (counter * 100);
                        enabled = true
                    }
                }
    }
    else 
        ref.style.opacity = ref.style.MozOpacity = counter * 0.999;
};
supernote.animations[supernote.animations.length] = animFade;
addEvent(document, 'click', function(evt){
    var elm = evt.target || evt.srcElement, closeBtn, note;
    while (elm) {
        if ((/note-close/).test(elm.className)) 
            closeBtn = elm;
        if ((/snb-pinned/).test(elm.className)) {
            note = elm;
            break
        }
        elm = elm.parentNode;
    }
    if (closeBtn && note) {
        var noteData = note.id.match(/([a-z_\-0-9]+)-note-([a-z_\-0-9]+)/i);
        for (var i = 0; i < SuperNote.instances.length; i++) 
            if (SuperNote.instances[i].myName == noteData[1]) {
                setTimeout('SuperNote.instances[' + i + '].setVis("' + noteData[2] +
                '", false, true)', 100);
                cancelEvent(evt);
            }
    }
});
addEvent(supernote, 'show', function(noteID){
});
addEvent(supernote, 'hide', function(noteID){
});
/* jQuery plugins supernote END  */

$(document).ready(function(){
    // 单位岗位二级联动
    $("select[name=unitID]").change(function(){
        var j_d = $(".j_unitPositionArr").val();
                j_d = eval(j_d);
    
        $.each(j_d, function(i, n){
            if ($("select[name=unitID]").val() == n.unitID) {
                $("select[name=positionID] option:not(:eq(0))").remove();
                $.each(n.position, function(j, v){
                    $("select[name=positionID]").append("<option value=" + v.positionID + ">" +
                    v.name +
                    "</option>");
                });
            
            }
            if (!$("select[name=unitID]").val()) {
                $.each(n.position, function(j, v){
                    $("select[name=positionID]").append("<option value=" + v.positionID + ">" +
                    v.name +
                    "</option>");
                });
            }
        });
    
    });
    $("input[name=reset]").click(function(){
    	window.location.href = "tInfoStatus.php";
    });
 // 人才信息查询
    $("input[name=c]").one("click", function(){
        $(this).val("");           
    });
    //全反选
	$(".chkAll").click(function(){
        var cC, aC;
        var thisName = $(this).attr("name");
        var chkName = thisName.replace("Chk", "Check");
        cC = this;
        aC = '.' + chkName ;
        checkAll(cC, aC);
        var tempJsonTxt="";
        $(".tCheck:checked").each(function(){
            tempJsonTxt += '{"whichID":"talentID","nameTxt": "'+$(this).attr("alt")+'","value":"'+$(this).val()+'"},';
        });
        if(!IsEmpty(tempJsonTxt)){
            tempJsonTxt=  "["+tempJsonTxt.slice(0,-1)+"]";
        }
        $("input[name=tempJson]").val(tempJsonTxt);
    });
	//跳转到总库查询
	$("#allTalentChk").click(function(){		
			if(!IsEmpty($(this).attr("checked"))) {
				$("#wSForm").attr("action","tInfo.php");
				$("#wSForm").attr("target","_blank");
			}else{
				$("#wSForm").attr("action","");
				$("#wSForm").attr("target","");
			}

	});
    //电话,复试通知,等选择保存
	  $(".radioSub").each(function(i){
	  	$(this).click(function(){
			var chkType = $(this).val();
			var talentArr = $(this).attr("alt");
			var lineIndex = $(this).attr("lineIndex");
			$("input[name='remarks[]']").attr("disabled",true);
			$("input[name='remarks[]']").attr("class","");
			$("input[name='remarks[]']").eq(lineIndex).attr("disabled",false);
			$("input[name='remarks[]']").eq(lineIndex).attr("class","supernote-click-remarks"+chkType);
			if(!IsEmpty($(this).attr("checked"))) {
				var ck = "1";
			}else{
				var ck="0";
			}
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "tSQL.php";
	        d =  "checkType="+chkType+ "&btn=" + btnName+"&ck="+ck+"&talentArr="+talentArr;
	        dt = "json";
	        m = function(json){
	            var i, n, k, v;
	            $.each(json, function(i, n){
	                switch (i) {
	                    case "error":
	                        alert(n);
	                        break;
	                    case "succ":
	                    	
	                        break;
	                }
	            });
	        };
	         ajaxAction(t, u, d, dt, m);
		});
	  });
    
	  //培训项目通过提交    
	  $(".trainChkSub").each(function(i){
	  	$(this).click(function(){
			var chkType = $(this).val();
			var talentArr = $(this).attr("alt");
			var lineIndex = $(this).attr("lineIndex");
			$("input[name='remarks[]']").attr("disabled",true);
			$("input[name='remarks[]']").attr("class","");
			$("input[name='remarks[]']").eq(lineIndex).attr("disabled",false);
			$("input[name='remarks[]']").eq(lineIndex).attr("class","supernote-click-remarks"+chkType);
			if(!IsEmpty($(this).attr("checked"))) {
				var ck = "1";
			}else{
				var ck="0";
			}
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "tSQL.php";
	        d =  "checkType="+chkType+ "&btn=" + btnName+"&ck="+ck+"&talentArr="+talentArr;
	        dt = "json";
	        m = function(json){
	            var i, n, k, v;
	            $.each(json, function(i, n){
	                switch (i) {
	                    case "error":
	                        alert(n);
	                        break;
	                    case "succ":
	                    	
	                        break;
	                }
	            });
	        };
	         ajaxAction(t, u, d, dt, m);
		});
	  });
	  //资料提交情况    
	  $(".materialChkSub").each(function(i){
	  	$(this).click(function(){
			var chkType = $(this).val();
			var talentArr = $(this).attr("alt");
			var lineIndex = $(this).attr("lineIndex");
			$("input[name='remarks[]']").attr("disabled",true);
			$("input[name='remarks[]']").attr("class","");
			$("input[name='remarks[]']").eq(lineIndex).attr("disabled",false);
			$("input[name='remarks[]']").eq(lineIndex).attr("class","supernote-click-remarks"+chkType);
			if(!IsEmpty($(this).attr("checked"))) {
				var ck = "1";
			}else{
				var ck="0";
			}
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "tSQL.php";
	        d =  "checkType="+chkType+ "&btn=" + btnName+"&ck="+ck+"&talentArr="+talentArr;
	        dt = "json";
	        m = function(json){
	            var i, n, k, v;
	            $.each(json, function(i, n){
	                switch (i) {
	                    case "error":
	                        alert(n);
	                        break;
	                    case "succ":
	                    	
	                        break;
	                }
	            });
	        };
	         ajaxAction(t, u, d, dt, m);
		});
	  });
	//资料完整性变更情况    
	  $(".materialCompleteChkSub").each(function(i){
	  	$(this).click(function(){
			var chkType = $(this).val();
			var talentArr = $(this).attr("alt");
			var lineIndex = $(this).attr("lineIndex");
			$("input[name='remarks[]']").attr("disabled",true);
			$("input[name='remarks[]']").attr("class","");
			$("input[name='remarks[]']").eq(lineIndex).attr("disabled",false);
			$("input[name='remarks[]']").eq(lineIndex).attr("class","supernote-click-remarks"+chkType);
			if(!IsEmpty($(this).attr("checked"))) {
				var ck = "1";
			}else{
				var ck="0";
			}
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "tSQL.php";
	        d =  "checkType="+chkType+ "&btn=" + btnName+"&ck="+ck+"&talentArr="+talentArr;
	        dt = "json";
	        m = function(json){
	            var i, n, k, v;
	            $.each(json, function(i, n){
	                switch (i) {
	                    case "error":
	                        alert(n);
	                        break;
	                    case "succ":
	                    	
	                        break;
	                }
	            });
	        };
	         ajaxAction(t, u, d, dt, m);
		});
	  });
	// cell表示的是点击的第几个cell
		var cell,wCell; 
		
		// 遍历单元格  给num赋值 记住单元格的位置
		$("input[name='wantedArea[]']").each(function(i){
			var thisObj = $("input[name='wantedArea[]']").eq(i);
			thisObj.click(function(){
				wCell = i;				
			});	
			var talentArr = $(this).attr("alt");
			thisObj.blur(function(){
				var c=$(this).val();		
				var data= "btn=wantedAreaSub&wantedArea="+c+"&talentArr="+$(this).attr("alt");
				 remarksAction(data);			
			});	
	    }); 
		// 遍历单元格  给num赋值 记住单元格的位置
		$("input[name='remarks[]']").each(function(i){
			var thisObj = $("input[name='remarks[]']").eq(i);
			thisObj.click(function(){
				cell = i;				
			});	
			var talentArr = $(this).attr("alt");
			thisObj.blur(function(){
				var c=$(this).val();		
				var data= "btn=remarksSub&remarks="+c+"&talentArr="+$(this).attr("alt");
				 remarksAction(data);			
			});	
	    });
        //合同信息相关的 -- 遍历单元格  给num赋值 记住单元格的位置
        $("textarea[name='contactInfo[]']").each(function(i){
            var thisObj = $("textarea[name='contactInfo[]']").eq(i);
            thisObj.click(function(){
                cCell = i;
            });
            var talentArr = $(this).attr("alt");
            thisObj.blur(function(){
                var c=$(this).val();
                var data= "btn=contactInfoSub&contactInfo="+c+"&talentArr="+$(this).attr("alt");
                remarksAction(data);
            });
        });
        // 导出选中到excel
        $(":button[name=download]").click(function(){
            if(isChecked(".tCheck")){
                $("#tInfoStatusForm").attr("action", location.href);
                $("input[name=downloadExcel]").val("true");
                $("#tInfoStatusForm").submit();
             }else{
                $("#tInfoStatusForm").attr("action", "tinfoexcelout.php");
                $("#tInfoStatusForm").submit();
            }
        });

		// 使用cell的值，向相应备注位置的单元格填充选中的内容
		$(".remarksList").each(function(k){
				$(this).click(function(){
 			        var content = $(this).text();
 			       $("input[name='remarks[]']").eq(cell).val(content);
 			        var data= "btn=remarksSub&remarks="+content+"&talentArr="+$("input[name='remarks[]']").eq(cell).attr("alt");
 			       $("input[name='remarks[]']").eq(cell).focus();
 	 			});
	  	});
    //使用cell的值，向相应意向区域位置的单元格填充选中的内容
		$(".wantedAreaList").each(function(k){
				$(this).click(function(){
 			        var content = $(this).text();
 			        content =$("input[name='wantedArea[]']").eq(wCell).val()+","+content
 			       $("input[name='wantedArea[]']").eq(wCell).val(content);
 			        var data= "btn=wantedAreaSub&wantedArea="+content+"&talentArr="+$("input[name='wantedArea[]']").eq(wCell).attr("alt");
 			 	  $("input[name='wantedArea[]']").eq(wCell).focus();
 	 			});
	  	});
            //导入成绩
            $(".insertMarks").each(function(i){
            $(this). click(function(){
                var url = $(this).attr("dataSrc");
                tipsWindown('新建','iframe:'+url, '1200', '580', 'true', '', 'true', 'leotheme','true');
            });
        });
		//提交备注函数
		function remarksAction(data){
			
			// Ajax提交到服务器		      
		    	var t,u,d,dt,m;
		    	t = "post";
		    	u = "tSQL.php";
		    	d = data;
		    	dt = "json"; 			    	
		    	m = function(json){
		    		var i,n;
					$.each(json,function(i,n){
						switch(i){
						case "error":
							alert(n);
							break;
//						case "success":
//							window.location.reload();
							break;
						}
					});
			    };
			    ajaxAction(t, u, d, dt, m);
		}

        //获取临时处理数据
        $(".tCheck").click(function(){
            var tempJsonTxt="";
            $(".tCheck:checked").each(function(){
                tempJsonTxt += '{"whichID":"talentID","nameTxt": "'+$(this).attr("alt")+'","value":"'+$(this).val()+'"},';
            });
            if(!IsEmpty(tempJsonTxt)){
                 tempJsonTxt=  "["+tempJsonTxt.slice(0,-1)+"]";
            }
            $("input[name=tempJson]").val(tempJsonTxt);
        });


});
</script>
{/literal}
{include file="tempManage/show.tpl"}
<div id="main">
<input type="hidden" name="tempJson" value="">
<fieldset>
        <legend><code>人才应聘状态处理</code></legend>
        <p class="notice">特别提示: <br>1. 查询条件中勾选"总库"",包含储备及其他人才<br>2. 转岗的人员,会被重置为"本部初试"状态</p>
        <fieldset>
        <legend><code>查询条件</code></legend>
     <input	type="hidden" class="j_unitPositionArr" value='{$j_unitPositionArr}'>
    <form method="GET" class="form" id="wSForm" >
        <table height="100" border="0" width="90%">
                <tr>
                 <td >
                    <strong>条件</strong>
                  <select name="m" class="req-string">
                            {html_options options=$model selected=$s_m}
                        </select>
                        <input type="text" name="c" value="{$s_c}" />
                        <input 	name="allTalentChk" id="allTalentChk" type="checkbox" value="1"  {$allTalentChk} />
                        总库</td>
                        <td colspan="2"><input type="submit" name="wS" value="查询" /><input type="button" name="reset" value="重置" /></td>
                    <td rowspan="3"><p class="success"><b>合同签订信息范本</b><br><br> 合同类型:  全日制<br>合同期限: {$smarty.now|date_format:"%Y"}年 月 日 至 {($smarty.now+3*365*24*60*60)|date_format:"%Y"}年 月 日 <br>报到日期: {$smarty.now|date_format:"%Y"}年 月 日</p></td>
                </tr>
                <tr>
                <td><strong>单位</strong>
                    <select name="unitID">
                            <option value="">-----------------请选择-----------------</option>
                            {foreach from = $unitPositionArr item = val} 
                           		 {html_options	values=$val.unitID output= $val.unitName|replace:"深圳市":'' selected= $s_unitID} 
                            {/foreach}
                        </select>
                   <strong>岗位</strong> 
                   <select name="positionID">
                            <option value="">-------请选择------</option>
                            {foreach from= $unitPositionArr item= val key=key } 
                                 {if $s_unitID}
                                {foreach from= $val	item=u key= k}
                                 {if  $k eq "position" && $val['unitID'] eq $s_unitID}
                                        {foreach from= $u item= m key= n}
                                            {html_options values= $m.positionID output=$m.name selected=$s_positionID}
		                                {/foreach} 
		                            {/if}
                           		  {/foreach}
                             {else}
                             	{foreach from= $val	item=u key= k}
                                 {if  $k eq "position"}
                                        {foreach from= $u item= m key= n}
                                            {html_options values= $m.positionID output=$m.name selected=$s_positionID}
		                                {/foreach} 
		                            {/if}
                        	     {/foreach}
                             {/if}
                         {/foreach}
                  </select> 
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>市场</strong>  
                    <select name="marketID">
                           <option value="">-------请选择------</option>
                           {foreach from=$marketArr item=val}
                             {html_options values=$val.marketID output=$val.name selected=$s_marketID}
                           {/foreach}
                     </select>
                     <strong>排序</strong>
                     <select name="order">
                        {html_options options=$orderArr selected=$s_order}
                        </select>
                  </td>
                </tr>
           </table>
           </form>
        </fieldset>
        <fieldset>
        <legend><code>结果</code></legend>
        <div id="tabsJ">
             <ul>
        {foreach item=val from=$statusArr}
          <li {if $s_status eq $val}id="current"{/if}><a href="{$httpPath}recruitManage/tInfoStatus.php?status={$val}{$queryString}"  ><span class="red">{$statusToCHNArr.$val.name}   (<i>{count($arr.$val)}</i>  ) </span></a></li>
        {/foreach}
        </ul>
        </div>
        <table class="myTable" width="100%">
        	<tr>
        		<th><input name="tChk" class="chkAll"type="checkbox"></th>
        		<th>编号</th>
        		<th>姓名</th>
        		<th>性别</th>
        		<th>电话</th>
        		<th>岗位</th>
        		<th>驾照</th>
        		<th>操作</th>
        		<th>下个流程</th>
        		<th>备注</th>
        		{switch $s_status}
        		{case "7"}
        		<th>培训</th>
        		{/case}
        		{case "8"}
        		<th>资料</th>
        		<th>辅助</th>        		
        		{/case}
                {case "98"}
                    <th>合同签订信息</th>
                {/case}
        		{case "99"}
                <th>合同签订信息</th>
        		<th>资料</th>
        		{/case}
        		{/switch}
        		<th>意向区域</th>
        		<th>招聘人</th>
        		<th>创建时间</th>
        	</tr>
            <form name="tInfoStatusForm" id="tInfoStatusForm" method="post">
                <input type="hidden" name="downloadExcel" value="">
                {foreach item=val key=key name=foo from=$arr[$s_status]}
                    <tr>
                        <td><input name="talents[]" class="tCheck" type="checkbox" alt="{$val.name}"
                                   value="{$val.talentID}"></td>
                        <td>
                            {if $web_workerBasicArr[$val.talentID].infoConfirm == 1}
                            <span class="positive">
                                    {/if}
                                {if $web_workerBasicArr[$val.talentID].infoConfirm == 0}
                                {if $web_wInfo_extraArr[$web_workerBasicArr[$val.talentID].wID].wID }
                                <span class="negative">
                                        {/if}
                                    {/if}
                                    {$val.talentID}
                                </span>

                        </td>
        		<td><a href="{$httpPath}recruitManage/tUpdate.php?tid={$val.talentID}" target="_blank">{$val.name}</a></td>
        		<td>{$val.sexName}</td>
        		<td>{$val.telephone}</td>
        		<td><a href="{$httpPath}recruitManage/positionInfo.php?id={$val.positionID}" target="_blank">{$val.positionName}</a></td>
        		<td>{$val.lisence}</td>
        		<td>{html_radios name="procedurerStatus[]" class="radioSub" lineIndex="{$smarty.foreach.foo.index}" alt="{$val.talentID}|{$s_status}|{$val.positionID}" options=$procedurerStatusArr checked=$s_procedurerStatusArr separator="<br>"}</td>
        		<td>{$statusToCHNArr[$preOrNextProcedurerArr[$val.positionID]['next']['procedurerID']]['name']|default:"<span class='red'>出错</span>"}</td>
        		<td>
				{$val.remarks}<br/>
        		{foreach item=remarkVal from=$recruitNotesArr}
        		{if $remarkVal.talentID eq $val.talentID && $remarkVal.remarks}
        		 {$remarkVal.remarks} -({$remarkVal.status}) {$userArr[$remarkVal.createdBy].mName}  {$remarkVal.createdOn|date_format:"%m/%d"}<br>
        		{/if}
        		{/foreach}
        		<br><input type="text" name="remarks[]" alt="{$val.talentID}|{$s_status}" disabled/></td>
        		{switch $s_status}
        		{case "7"}   
        		<td>
        		{if array_key_exists($val.talentID,$newRecruitMarksArr)}
        		{foreach from=$needTrainArr[$val.positionID] item=nval key=nkey}
        		{assign var='checked' value="unchecked"}
        		{assign var='marksRemarks' value=''}
        		 {assign var='createdOn' value=''}
        			{foreach from=$newRecruitMarksArr[$val.talentID] item=rval }
        			    {if $rval['trainClassicID'] == $nval.ID}
        				    {if $rval['marksStatus'] =="1"}
        				    {assign var='checked' value="checked"}
        				    {assign var='marksRemarks' value=$rval.remarks}
        				    {assign var='createdOn' value=$rval.createdOn}
        				    {break}
        					{else}
        					{assign var='checked' value="unchecked"}
        				    {assign var='marksRemarks' value=$rval.remarks}
        					{break}
        					{/if}
        				{/if}       
        			{/foreach}
        			<input name="trainStatus[]"  class="trainChkSub" lineIndex="{$smarty.foreach.foo.index}" value=''  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"  {$checked} /> {$nval.name}{if $marksRemarks||$createdOn}(<span class="red">{$marksRemarks}{$createdOn|date_format:"%m/%d"}</span>){/if} <br/>
        		{/foreach}
        		{else}
        			{foreach from=$needTrainArr[$val.positionID] item=nval key=nkey}
        				<input name="trainStatus[]"  class="trainChkSub" lineIndex="{$smarty.foreach.foo.index}"  value=''   alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"   /> {$nval.name}<br/>
        			{/foreach}
        		{/if}
        		</td>
        		{/case}
        		{case "8"}        	
        		<td>
        		{if $val['d_material'] neq '1'}
        		{if array_key_exists($val.talentID,$newRecruitMarksArr)}
        		{foreach from=$needMaterialArr[$val.positionID] item=nval key=nkey}
        		{assign var='checked' value="unchecked"}
        		{assign var='marksRemarks' value=''}
        		 {assign var='createdOn' value=''}
        			{foreach from=$newRecruitMarksArr[$val.talentID] item=rval }
        			    {if $rval['trainClassicID'] == $nval.ID}
        				    {if $rval['marksStatus'] =="1"}
        				    {assign var='checked' value="checked"}
        				    {assign var='marksRemarks' value=$rval.remarks}
        				    {assign var='createdOn' value=$rval.createdOn}
        				    {break}
        					{else}
        					{assign var='checked' value="unchecked"}
        					{break}
        					{/if}
        				{/if}       
        			{/foreach}
        			<input name="materialStatus[]"  class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"  {$checked} /> {$nval.name}{if $marksRemarks||$createdOn}(<span class="red">{$marksRemarks}{$createdOn|date_format:"%m/%d"}</span>){/if} <br/>
        		{/foreach}
        		{else}
        			{foreach from=$needMaterialArr[$val.positionID] item=nval key=nkey}
        				<input name="materialStatus[]"  class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"   /> {$nval.name}<br/>
        			{/foreach}
        		{/if}
        		{else}
        		<input name="materialComplete[]"  class="materialCompleteChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"  checked /> 齐
        		{/if}
        		</td>
        		<td>
        		{if array_key_exists($val.talentID,$newRecruitMarksArr)}
        		{foreach from=$needWaitArr[$val.positionID] item=nval key=nkey}
        		{assign var='checked' value="unchecked"}
        		{assign var='marksRemarks' value=''}
        		{assign var='createdOn' value=''}
        			{foreach from=$newRecruitMarksArr[$val.talentID] item=rval }
        			    {if $rval['trainClassicID'] == $nval.ID}
        				    {if $rval['marksStatus'] =="1"}
        				    {assign var='checked' value="checked"}
        			     	 {assign var='marksRemarks' value=$rval.remarks}
        				    {assign var='createdOn' value=$rval.createdOn}
        				    {break}
        					{else}
        					{assign var='checked' value="unchecked"}
        					{break}
        					{/if}
        				{/if}       
        			{/foreach}
        			<input name="materialStatus[]"  class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"  {$checked} /> {$nval.name}{if $marksRemarks||$createdOn}(<span class="red">{$marksRemarks}{$createdOn|date_format:"%m/%d"}</span>){/if} <br/>
        		{/foreach}
        		{else}
        			{foreach from=$needWaitArr[$val.positionID] item=nval key=nkey}
        				<input name="materialStatus[]"  class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"   /> {$nval.name}<br/>
        			{/foreach}
        		{/if}
        		</td>
        		{/case}
                {case "98"}
                <td>
                    <textarea name="contactInfo[]" alt="{$val.talentID}|{$s_status}" cols="25" rows="5">{foreach item=remarkVal from=$recruitNotesArr}{if $remarkVal.talentID eq $val.talentID && $remarkVal.contactInfo}{$remarkVal.contactInfo}{/if}{/foreach}</textarea>
                </td>
                {/case}
        		{case "99"}
                <td>
                    <textarea name="contactInfo[]" alt="{$val.talentID}|{$s_status}" cols="25" rows="5">{foreach item=remarkVal from=$recruitNotesArr}{if $remarkVal.talentID eq $val.talentID && $remarkVal.contactInfo}{$remarkVal.contactInfo}{/if}{/foreach}</textarea>
                </td>
        		<td>
        		{if $val['d_material'] neq '1'}
        		{if array_key_exists($val.talentID,$newRecruitMarksArr)}
        		{foreach from=$needMaterialArr[$val.positionID] item=nval key=nkey}
        		{assign var='checked' value="unchecked"}
        		{assign var='marksRemarks' value=''}
        		{assign var='createdOn' value=''}
        			{foreach from=$newRecruitMarksArr[$val.talentID] item=rval }
        			    {if $rval['trainClassicID'] == $nval.ID}
        				    {if $rval['marksStatus'] =="1"}
        				    {assign var='checked' value="checked"}
        				    {assign var='marksRemarks' value=$rval.remarks}
        				    {assign var='createdOn' value=$rval.createdOn}
        				    {break}
        					{else}
        					{assign var='checked' value="unchecked"}
        					{break}
        					{/if}
        				{/if}       
        			{/foreach}
        			<input name="materialStatus[]"  class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"  {$checked} /> {$nval.name}{if $marksRemarks||$createdOn}(<span class="red">{$marksRemarks}{$createdOn|date_format:"%m/%d"}</span>){/if} <br/>
        		{/foreach}
        		{else}
        			{foreach from=$needMaterialArr[$val.positionID] item=nval key=nkey}
        				<input name="materialStatus[]"  class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"   /> {$nval.name}<br/>
        			{/foreach}
        		{/if}
        		{else}
        		<input name="materialComplete[]"  class="materialCompleteChkSub" lineIndex="{$smarty.foreach.foo.index}"  alt="{$nval.ID}|{$val.talentID}|{$s_status}|{$val.positionID}" type="checkbox"  checked /> 齐
        		{/if}
        		</td>  
        		{/case}
        		{/switch}
        		<td><input type="text" size="10" name="wantedArea[]" alt="{$val.talentID}"   class="supernote-click-wantedArea"  value="{$val.wantedArea}"/></td>
        		<td>{$val.mName}</td>
        		<td>{$val.createdOn|date_format:"%m/%d"}</td>
        	</tr>
        	{/foreach}
        	</form>
        </table>
        {foreach item=val key=key  from=$recruitRemarksArr}
        <div id="supernote-note-remarks{$key}" class="snp-mouseoffset notedefault">
							<h5>备注类型</h5>
							<ul>
								{foreach from=$val item=v key=k}
								<li>{$k+1}.   <a class="remarksList">{$v}</a></li>
								{/foreach}
							</ul>
		</div>
		{/foreach}	
		 <div id="supernote-note-wantedArea" class="snp-mouseoffset notedefault">
							<h5>意向区域</h5>
							<ul>
								{foreach from=$wantedAreaArr item=v key=k}
								<li>{$k+1}.   <a class="wantedAreaList">{$v}</a></li>
								{/foreach}
							</ul>
			</div>	
			<form method="POST">
			<input name="download" type="button" value="下载为EXCEL">
			{switch $s_status}
        		{case "7"}
				<input name="insertMarks" class="insertMarks"  dataSrc="{$httpPath}excelAction/readExcel.php?a=recruitMarksMulInsert&status={$s_status}" type="button" value="导入成绩">
        		<input name="insertNotes" class="insertMarks"  dataSrc="{$httpPath}excelAction/readExcel.php?a=recruitNotesMulInsert&status={$s_status}" type="button"  value="导入流程状态">
        		{/case}
        		{default}
				<input name="insertNotes" class="insertMarks"  dataSrc="{$httpPath}excelAction/readExcel.php?a=recruitNotesMulInsert&status={$s_status}" type="button"  value="导入流程状态">
        		{/default}
        	{/switch}	
			</form>	
			</fieldset>	
    </fieldset>   
</div>
 {include file="footer.tpl"}