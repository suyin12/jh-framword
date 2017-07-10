{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script type="text/javascript">
	$(document).ready(function(){
	
	    // 判断select选项是否重复
	    $(".sub").click(function(){
	        var formID = this.form.id;
	        var btnName = $("#" + formID + " :button").attr("name")
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
	        d = $("#" + formID).serialize() + "&btn=" + btnName;
	        dt = "json";
	        m = function(json){
	            var i, n, k, v;
	            $.each(json, function(i, n){
	                switch (i) {
	                    case "error":
	                        alert(n);
	                        break;
	                    case "succ":
	                        alert(n);
	                        window.location.reload();
	                        break;
	                }
	            });
	        };
	        var ret = confirm("确定" + $(this).val() + "?");
	        if (ret == true) {
	            ajaxAction(t, u, d, dt, m);
	        }
	    });
	    
	    //选择欲编辑的公式
	    $("input[name^=formulas]").each(function(i){
	        $(this).click(function(){
	            ret = confirm("确定编辑公式吗?");
	            if (ret) {
					$("input[name^=formulas]").attr("readonly", true);
	                $(this).removeAttr("readonly");
					this.focus();
	            }
	        });
	    });
	    
	    //设置点击列表设置参数
	    $(".chart").each(function(i){
	        $(this).click(function(){
	            var chartVal = $(this).attr("id");
	            $("input[name^=formulas]").each(function(k){
	                if (!$(this).attr("readonly")) {
	                    var val = $(this).val();
	                    val = val + chartVal;
						this.focus();
	                    $(this).val(val);
	                }
	            });
	        });
	    });
		
		
	});
</script>
{/literal}
<div id="mainBody">
	<p>导入的数据生成预览:(通过选择栏,可重新排序)</p>
	<table class="myTable">
		<thead>
			<form name="cSequenceForm">
				<tr>
					<td>
						<input type="button" value="重新排序" />
					</td>
				</tr>
				<tr>
					{foreach key=key item = fieldName from=$newFieldArr}<th>
						<select name=cSequence[]>
							<option>--请选择---</option>
							{html_options options=$newFieldArr selected=$cSequence.$key}
						</select>
						<br/>
						{$fieldName}({$key})
					</th>
					{/foreach}
				</tr>
			</form>
		</thead>
		<tbody>
			{foreach item = val from =$ret}
			<tr>
				{foreach item=v from=$val }
				<td>
					{$v}
				</td>
				{/foreach}
			</tr>
			{/foreach}
		</tbody>
	</table>
	<div>
		<p>公式设置(特别提醒:选择下表中项,设置公式,这里的公式只能整列计算,)</p>
		<div id="formulasChart">
			<table class="myTable">
				{$formulasChartStr}
			</table>
		</div>
		<form name=formulasSet id = formulasSet>
			<table>
				<tr>
					<td>
						应发工资 =
					</td>
					<td>
						<input type="text" name=formulas['pay'] readonly=true size=200 />
					</td>
				</tr>
				<tr>
					<td>
						应缴纳税额 = 应发工资 - 个人社保 -
					</td>
					<td>
						<input type="text" name=formulas['ratal'] readonly=true size=200 />
					</td>
				</tr>
			</table>
			<input type="button" name="subFormulas" class="sub" value="提交公式">
		</form>
	</div>
</div>
{include file="footer.tpl"}