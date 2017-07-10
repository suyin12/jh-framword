{include file="header.tpl"}
<style>
   .scroll::-webkit-scrollbar-thumb{
    border-radius: 8px;
    border: 3px solid #fff;
    background-color: rgba(0, 0, 0, .3);
	}

	.scroll::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 14px;
    height: 14px;

}
table.table-bordered.dataTable {
    /*border-collapse: none !important;*/
}
</style>
<!-- <script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script> -->
{literal}
    <script type="text/javascript">
//     $(document).ready(function(){
// {/literal}
//     {if $smarty.post.selPost neq '1'}
// {literal}    
//         if(getQuery("selPost")!="1"){ 
//          $('.myTable').fixedHeaderTable({ height: '500', altClass: 'odd',fixedColumns: 2, themeClass: 'myTable' });
//          }
// {/literal}
//     {/if}
// {literal}    
//              //筛选条件的POST提交.. wInfo.php
//         $(".selPost").change(function(){
//             $(".selForm").submit();
//         });
//                 // 员工信息查询
//         $("input[name=c]").one("click", function(){
//             $(this).val("");
//             $(":checkbox[name=status]").attr("checked",false);
//         });
//         $("input[name=wS]").click(function(){
//             successFun = function(){
//                 $("#wSForm").submit();
//             }
//             validator("input[name=wS]", "#wSForm", "#errorDiv", successFun);
//         });
//         // 全选/反选
//         $('#CK').click(function(){
//             if ($(this).attr('checked') == true) {
//                 $(".ckb").attr('checked', true);
//             }
//             else {
//                 $('.ckb').attr('checked', false);
//             }
//         });
    
//         // 客户经理/单位二级联动
//         $("select[name=mID]").change(function(){
//             var j_d = $(".j_unitManager").val();
//                     j_d = eval(j_d);
        
//             $.each(j_d, function(i, n){
//                 if ($("select[name=mID]").val() == n.mID) {
//                     $("select[name=unitID] option:not(:eq(0))").remove();
//                     $.each(n.unit, function(j, v){
//                         $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
//                         v.unitName +
//                         "</option>");
//                     });
                
//                 }
//                 if (!$("select[name=mID]").val()) {
//                     $.each(n.unit, function(j, v){
//                         $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
//                         v.unitName +
//                         "</option>");
//                     });
//                 }
//             });
        
//         });
    
//     });
    </script>
{/literal}
            <div class="col-md-10 content-wrapper" style='padding-top: 0;'>


	<!-- 框架div版本2 -->

    <!--     <div class="widget widget-table">
            <div class="widget-header">
                <h3>
                    结果
                </h3>
            </div>
            <div class="widget-content">
                <div class="table-responsive" style="overflow-x:hidden; ">
                    <div id="datatable-basic-scrolling_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row">
                           <form role="form">
   <div class="form-group">
   <table>
   <tr>
   <td>
      <label for="name" class="la_query">请选择查询条件</label>
      </td>
      <td>
     <select name="featured-datatable_length " aria-controls="featured-datatable" class="form-control input-sm form_select">
                                                        <option value="">
                                                            姓名
                                                        </option>
                                                        <option value="1">
                                                            员工编号
                                                        </option>
                                                        <option value="2">
                                                            身份证
                                                        </option>
                                                        <option value="3">
                                                            社保号
                                                        </option>
                                                        <option value="4">
                                                            工资账号
                                                        </option>
                                                        <option value="5">
                                                            档案编号
                                                        </option>
                                                        <option value="6">
                                                            特定编号
                                                        </option>
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control input-sm input-te" placeholder="" aria-controls="visit-stat-table">
                                                         <label class="control-inline fancy-checkbox la_query">
                                                            <input type="checkbox" name="checkbox" data-parsley-multiple="checkbox" data-parsley-id="2927">
                                                            <span>不包含离职员工</span>
                                                        </label>
                                                    </td>
                                               
        </tr>
        <tr>
            <td class="td_option">
                客户经理
            </td>
            <td class="td_option">
                 
                 <select name="featured-datatable_length " aria-controls="featured-datatable" class="form-control input-sm form_select">
                            <option value="">--请选择--</option>

                             
                            <option value="2">周育鑫</option>
  
                            <option value="4">superAdmin</option>
  
                            <option value="118">何剑鸿</option>
  
                            <option value="7">陈健恒</option>
  
                            <option value="12">王璇</option>
  
                            <option value="27">方晓文</option>
  
                            <option value="55">陈丽娜</option>
  
                            <option value="99">汪慧研</option>
  
                            <option value="76">冷佳龙</option>
  
                            <option value="85">肖辉雄</option>
  
                            <option value="93">吴廷锴</option>
  
                            <option value="103">刘炽东</option>
  
                            <option value="120">曾康</option>
  
                            <option value="125">张宝灵</option>
  
                            <option value="127">廖思琪</option>
                                                    </select>
            </td>
             <td class="td_option">
                单位 
                <select name="featured-datatable_length " aria-controls="featured-datatable" class="form-control input-sm form_select">
                            <option value="">---------------请选择------------</option>

                             
                                                                                 
                                                                                 
                                                                            
                                                                        <option value="2202.088">中国移动通信集团广东有限公司深圳分公司</option>

                                                                        <option value="100019">中建一局华北分公司</option>

                                                                        <option value="2202.056">中建一局集团建设发展有限公司</option>

                                                                        <option value="2202.072">中铁二院(深圳分公司)</option>

                                                                        <option value="2202.066">人力资源及社会保障局</option>

                                                                        <option value="100001">出租屋管理中心(广济缘)</option>

                                                                        <option value="100020">南湖小学</option>

                                                                        <option value="100014">南湖街道办</option>

                                                                        <option value="2202.042">深圳出租屋综合管理信息中心</option>

                                                                        <option value="2202.089">前海吉信互联网金融服务有限公司</option>

                                                                        <option value="2202.043">天和信息服务有限公司</option>

                                                                        <option value="2202.093">法制教育学校</option>

                                                                        <option value="100012">清水河街道办</option>

                                                                        <option value="2202.065">罗湖区规划土地监察大队</option>

                                                                        <option value="100015">翠竹街道办</option>

                                                                        <option value="2202.087">顺丰中转场外包</option>

                                
                                                                                                                         <option value="2202.083">中国通信服务</option>

                                                                        <option value="2202.040">中国邮政储蓄银行深圳分行</option>

                                                                        <option value="2202.010">商函广告局</option>

                                                                        <option value="2202.025">国通物业</option>

                                                                        <option value="100018">国通物业管理有限公司国通大厦分公司</option>

                                                                        <option value="2202.082">国通电信发展股份有限公司</option>

                                                                        <option value="2202.002">报刊实业发展有限公司</option>

                                                                        <option value="2202.007">邮区中心局</option>

                                                                        <option value="2202.029">邮政局南山分局</option>

                                                                        <option value="2202.079">邮政局坪山分局</option>

                                                                        <option value="2202.011">邮政局宝安分局</option>

                                                                        <option value="2202.030">邮政局投递分局</option>

                                                                        <option value="2202.014">邮政局机关</option>

                                                                        <option value="2202.027">邮政局福田分局</option>

                                                                        <option value="2202.028">邮政局罗湖分局</option>

                                                                        <option value="2202.085">邮政局龙华分局</option>

                                                                        <option value="2202.012">邮政局龙岗分局</option>

                                                                        <option value="2202.016">邮政电子局</option>

                                                                        <option value="2202.032">鑫雁邮电印刷包装有限公司</option>

                                                                        <option value="2202.022">集邮公司</option>

                                                                        <option value="100005">邮政南山分局劳务承揽</option>

                                                                        <option value="100003">邮政坪山分局劳务承揽</option>

                                                                        <option value="100004">邮政宝安分局劳务承揽</option>

                                                                        <option value="2202.084">邮政局电商小包局</option>

                                                                        <option value="100010">邮政投递分局劳务承揽</option>

                                                                        <option value="100008">邮政福田分局劳务承揽</option>

                                                                        <option value="100006">邮政罗湖分局劳务承揽</option>

                                                                        <option value="100007">邮政龙华分局劳务承揽</option>

                                                                        <option value="100011">邮政龙岗分局劳务承揽</option>

                                                                        <option value="100016">金融业务局</option>

                                
                                                                                                                         <option value="2202.092">中国建筑一局</option>

                                                                        <option value="2202.088">中国移动通信集团广东有限公司深圳分公司</option>

                                                                        <option value="100019">中建一局华北分公司</option>

                                                                        <option value="2202.056">中建一局集团建设发展有限公司</option>

                                                                        <option value="2202.072">中铁二院(深圳分公司)</option>

                                                                        <option value="2202.066">人力资源及社会保障局</option>

                                                                        <option value="100001">出租屋管理中心(广济缘)</option>

                                                                        <option value="100020">南湖小学</option>

                                                                        <option value="100014">南湖街道办</option>

                                                                        <option value="2202.042">深圳出租屋综合管理信息中心</option>

                                                                        <option value="2202.089">前海吉信互联网金融服务有限公司</option>

                                                                        <option value="2202.043">天和信息服务有限公司</option>

                                                                        <option value="2202.093">法制教育学校</option>

                                                                        <option value="100012">清水河街道办</option>

                                                                        <option value="2202.065">罗湖区规划土地监察大队</option>

                                                                        <option value="100015">翠竹街道办</option>

                                
                                                                          
                                                    </select>
            </td>

        </tr>
    </table>
   </div>
</form>
                        </div>
                        <div class="dataTables_scroll">
                        <table>
                        <tr>
                            <div class="dataTables_scrollHead" style="/*overflow: hidden;*/ position: relative; border: 0px; width: 100%;">
                                <div class="dataTables_scrollHeadInner" style="box-sizing: content-box;/* width: 1219px;*/ padding-right: 17px;">
                                    <table class="table table-hover datatable dataTable no-footer" role="grid" style="margin-left: 0px; /*width: 1219px;*/ width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc sorting_pd sorting_handle" tabindex="0" aria-controls="datatable-basic-scrolling" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Browser: activate to sort column descending" style="line-height: 30px;">
                                                    操作
                                                </th>

                                                <th class="sorting sorting_name" tabindex="0" aria-controls="datatable-basic-scrolling" rowspan="1" colspan="1" aria-label="Operating System: activate to sort column ascending">
                                                    姓名
                                                </th>
                                                <th class="sorting  sorting_estate" tabindex="0" aria-controls="datatable-basic-scrolling" rowspan="1" colspan="1" aria-label="Visits: activate to sort column ascending">
                                                    <select name="featured-datatable_length" aria-controls="featured-datatable" class="form-control input-sm form_select">
                                                        <option value="">
                                                            状态
                                                        </option>
                                                        <option value="1">
                                                            离职
                                                        </option>
                                                        <option value="2">
                                                            在职
                                                        </option>
                                                    </select>
                                                </th>
                                                <th class="sorting sorting_unit" tabindex="0" aria-controls="datatable-basic-scrolling" rowspan="1" colspan="1" aria-label="New Visits: activate to sort column ascending">
                                                    <select class="form-control input-sm" name="unitSel" style="margin-right: 0;">
                                                        <option value="">
                                                            单位
                                                        </option>
                                                        <option value="邮政宝安分局劳务承揽">
                                                            邮政宝安分局劳务承揽
                                                        </option>
                                                        <option value="邮政龙华分局劳务承揽">
                                                            邮政龙华分局劳务承揽
                                                        </option>
                                                        <option value="邮政龙岗分局劳务承揽">
                                                            邮政龙岗分局劳务承揽
                                                        </option>
                                                        <option value="速递物流劳务外包">
                                                            速递物流劳务外包
                                                        </option>
                                                        <option value="翠竹街道办">
                                                            翠竹街道办
                                                        </option>
                                                        <option value="深圳出租屋综合管理信息中心">
                                                            深圳出租屋综合管理信息中心
                                                        </option>
                                                        <option value="出租屋管理中心(广济缘)">
                                                            出租屋管理中心(广济缘)
                                                        </option>
                                                        <option value="深圳市罗湖区东晓街道办事处">
                                                            罗湖区东晓街道办事处
                                                        </option>
                                                        <option value="邮政福田分局劳务承揽">
                                                            邮政福田分局劳务承揽
                                                        </option>
                                                        <option value="深圳市邮政局福田分局">
                                                            邮政局福田分局
                                                        </option>
                                                        <option value="邮政投递分局劳务承揽">
                                                            邮政投递分局劳务承揽
                                                        </option>
                                                        <option value="深圳市国通物业管理有限公司国通大厦分公司">
                                                            国通物业管理有限公司国通大厦分公司
                                                        </option>
                                                        <option value="深圳市国通物业">
                                                            国通物业
                                                        </option>
                                                        <option value="深圳市罗湖区防洪设施管理所">
                                                            罗湖区防洪设施管理所
                                                        </option>
                                                        <option value="广州莱帕德">
                                                            广州莱帕德
                                                        </option>
                                                        <option value="深圳顺路物流有限公司">
                                                            深圳顺路物流有限公司
                                                        </option>
                                                        <option value="邮政坪山分局劳务承揽">
                                                            邮政坪山分局劳务承揽
                                                        </option>
                                                    </select>
                                                </th>
                                        

                                                <th class="sorting sorting_filiale" tabindex="0" aria-controls="datatable-basic-scrolling" rowspan="1" colspan="1" aria-label="Bounce Rate: activate to sort column ascending">
                                                    <select name="" class="form-control input-sm select_con" style="margin-right: 0;">
                                                        <option value="">
                                                            分公司
                                                        </option>
                                                        <option value="notNull">
                                                            非空白
                                                        </option>
                                                        <option value="宝安分公司">
                                                            宝安分公司
                                                        </option>
                                                        <option value="派遣">
                                                            派遣
                                                        </option>
                                                        <option value="劳务承揽">
                                                            劳务承揽
                                                        </option>
                                                        <option value="深航中心">
                                                            深航中心
                                                        </option>
                                                        <option value="包裹业务局">
                                                            包裹业务局
                                                        </option>
                                                        <option value="包裹局">
                                                            包裹局
                                                        </option>
                                                        <option value="南山分公司">
                                                            南山分公司
                                                        </option>
                                                        <option value="五和中转场">
                                                            五和中转场
                                                        </option>
                                                        <option value="国际速递分公司">
                                                            国际速递分公司
                                                        </option>
                                                        <option value="福田分公司">
                                                            福田分公司
                                                        </option>
                                                        <option value="机关">
                                                            机关
                                                        </option>
                                                        <option value="电商物流分公司">
                                                            电商物流分公司
                                                        </option>
                                                        <option value="龙岗分公司">
                                                            龙岗分公司
                                                        </option>
                                                        <option value="客服中心">
                                                            客服中心
                                                        </option>
                                                        <option value="华强北分公司">
                                                            华强北分公司
                                                        </option>
                                                        <option value="同城分公司">
                                                            同城分公司
                                                        </option>
                                                        <option value="罗湖分公司">
                                                            罗湖分公司
                                                        </option>
                                                        <option value="光明分公司">
                                                            光明分公司
                                                        </option>
                                                        <option value="速递公司">
                                                            速递公司
                                                        </option>
                                                        <option value="技术维护中心">
                                                            技术维护中心
                                                        </option>
                                                        <option value="八卦岭中心公司">
                                                            八卦岭中心公司
                                                        </option>
                                                        <option value="顺丰速运">
                                                            顺丰速运
                                                        </option>
                                                        <option value="汇海运输">
                                                            汇海运输
                                                        </option>
                                                        <option value="广州">
                                                            广州
                                                        </option>
                                                        <option value="广州航空组">
                                                            广州航空组
                                                        </option>
                                                        <option value="深圳">
                                                            深圳
                                                        </option>
                                                        <option value="汇海">
                                                            汇海
                                                        </option>
                                                        <option value="顺丰商业">
                                                            顺丰商业
                                                        </option>
                                                        <option value="汇海运输有限公司福永分公司">
                                                            汇海运输有限公司福永分公司
                                                        </option>
                                                        <option value="仓配二三线">
                                                            仓配二三线
                                                        </option>
                                                        <option value="755EN.速运深圳区.运输分部">
                                                            755EN.速运深圳区.运输分部
                                                        </option>
                                                        <option value="速递投递公司">
                                                            速递投递公司
                                                        </option>
                                                        <option value="仓配一线">
                                                            仓配一线
                                                        </option>
                                                        <option value="深圳市顺丰商业有限公司">
                                                            深圳市顺丰商业有限公司
                                                        </option>
                                                        <option value="华强">
                                                            华强
                                                        </option>
                                                        <option value="五和">
                                                            五和
                                                        </option>
                                                        <option value="同城公司">
                                                            同城公司
                                                        </option>
                                                        <option value="金融业务局">
                                                            金融业务局
                                                        </option>
                                                        <option value="福田分局">
                                                            福田分局
                                                        </option>
                                                        <option value="邮政局机关">
                                                            邮政局机关
                                                        </option>
                                                        <option value="罗湖分局">
                                                            罗湖分局
                                                        </option>
                                                    </select>
                                                </th>
                                                <th class="sorting sorting_branch" tabindex="0" aria-controls="datatable-basic-scrolling" rowspan="1" colspan="1" aria-label="Bounce Rate: activate to sort column ascending">
                                                    <select name="" class="form-control input-sm select_section">
                                                        <option value="">
                                                            部门
                                                        </option>
                                                        <option value="notNull">
                                                            非空白
                                                        </option>
                                                        <option value="755LQL.速运事业群.华南大区.速运深圳区.布吉分部.民乐站">
                                                            755LQL.速运事业群.华南大区.速运深圳区.布吉分部.民乐站
                                                        </option>
                                                        <option value="E755SAB.仓配物流事业群.仓配深圳区.民治速配站.皓月花园顺丰站">
                                                            E755SAB.仓配物流事业群.仓配深圳区.民治速配站.皓月花园顺丰站
                                                        </option>
                                                        <option value="755BKGS.商业事业群.商业深圳分公司.宝安中心区域.深圳金鼎店">
                                                            755BKGS.商业事业群.商业深圳分公司.宝安中心区域.深圳金鼎店
                                                        </option>
                                                        <option value="顺丰店">
                                                            顺丰店
                                                        </option>
                                                        <option value="755BEBS.商业事业群.商业深圳分公司.白石龙区域.世纪春城店">
                                                            755BEBS.商业事业群.商业深圳分公司.白石龙区域.世纪春城店
                                                        </option>
                                                        <option value="755DK.速运事业群.华南大区.速运深圳区.坑梓分部">
                                                            755DK.速运事业群.华南大区.速运深圳区.坑梓分部
                                                        </option>
                                                        <option value="755CE.速运事业群.华南大区.速运深圳区.龙岭分部">
                                                            755CE.速运事业群.华南大区.速运深圳区.龙岭分部
                                                        </option>
                                                        <option value="E755SMM.仓配物流事业群.仓配深圳区.深圳顺大速配站.华侨村顺丰站">
                                                            E755SMM.仓配物流事业群.仓配深圳区.深圳顺大速配站.华侨村顺丰站
                                                        </option>
                                                        <option value="755Y.深圳区客户部">
                                                            755Y.深圳区客户部
                                                        </option>
                                                        <option value="755Y.速运事业群.华南大区.速运深圳区.营运部.车辆管理组">
                                                            755Y.速运事业群.华南大区.速运深圳区.营运部.车辆管理组
                                                        </option>
                                                        <option value="755Y.速运事业群.华南大区.速运深圳区.客服部.理赔投诉组">
                                                            755Y.速运事业群.华南大区.速运深圳区.客服部.理赔投诉组
                                                        </option>
                                                        <option value="755WD.营运中心.华南分拨区.深圳彩田中转场">
                                                            755WD.营运中心.华南分拨区.深圳彩田中转场
                                                        </option>
                                                        <option value="755W.速运事业群.华南大区.速运深圳区.运营规划部.黄田中转场">
                                                            755W.速运事业群.华南大区.速运深圳区.运营规划部.黄田中转场
                                                        </option>
                                                        <option value="755WF.速运事业群.华南大区.速运深圳区.运营规划部.五和中转场">
                                                            755WF.速运事业群.华南大区.速运深圳区.运营规划部.五和中转场
                                                        </option>
                                                        <option value="755U.速运事业群.华南大区.速运深圳区.华强分部">
                                                            755U.速运事业群.华南大区.速运深圳区.华强分部
                                                        </option>
                                                        <option value="755WA.深圳区坂田中转场">
                                                            755WA.深圳区坂田中转场
                                                        </option>
                                                        <option value="E755Y.仓配物流事业群.仓配深圳区.客户部.客户服务组">
                                                            E755Y.仓配物流事业群.仓配深圳区.客户部.客户服务组
                                                        </option>
                                                        <option value="755DS.速运事业群.华南大区.速运深圳区.深圳重货管理部.宝安重货营业点">
                                                            755DS.速运事业群.华南大区.速运深圳区.深圳重货管理部.宝安重货营业点
                                                        </option>
                                                        <option value="755WD.速运事业群.华南大区.速运深圳区.运营规划部.彩田中转场">
                                                            755WD.速运事业群.华南大区.速运深圳区.运营规划部.彩田中转场
                                                        </option>
                                                        <option value="755AB.速运事业群.华南大区.速运深圳区.大芬分部">
                                                            755AB.速运事业群.华南大区.速运深圳区.大芬分部
                                                        </option>
                                                        <option value="755AAFS.商业事业群.商业深圳分公司.市民中心区域.广厦店">
                                                            755AAFS.商业事业群.商业深圳分公司.市民中心区域.广厦店
                                                        </option>
                                                        <option value="755AM.速运事业群.华南大区.速运深圳区.皇岗分部">
                                                            755AM.速运事业群.华南大区.速运深圳区.皇岗分部
                                                        </option>
                                                        <option value="755AV.速运事业群.华南大区.速运深圳区.龙东分部">
                                                            755AV.速运事业群.华南大区.速运深圳区.龙东分部
                                                        </option>
                                                        <option value="755P.速运事业群.华南大区.速运深圳区.观澜分部">
                                                            755P.速运事业群.华南大区.速运深圳区.观澜分部
                                                        </option>
                                                        <option value="755BN.速运事业群.华南大区.速运深圳区.上塘分部">
                                                            755BN.速运事业群.华南大区.速运深圳区.上塘分部
                                                        </option>
                                                        <option value="755HJL.速运事业群.华南大区.速运深圳区.龙岭分部.龙岭山庄站">
                                                            755HJL.速运事业群.华南大区.速运深圳区.龙岭分部.龙岭山庄站
                                                        </option>
                                                        <option value="755E.速运事业群.华南大区.速运深圳区.龙岗分部">
                                                            755E.速运事业群.华南大区.速运深圳区.龙岗分部
                                                        </option>
                                                        <option value="755AE.速运事业群.华南大区.速运深圳区.坪地分部">
                                                            755AE.速运事业群.华南大区.速运深圳区.坪地分部
                                                        </option>
                                                        <option value="755EF.速运事业群.华南大区.速运深圳区.深圳重货管理部.大芬重货营业点">
                                                            755EF.速运事业群.华南大区.速运深圳区.深圳重货管理部.大芬重货营业点
                                                        </option>
                                                        <option value="755FTL.速运事业群.华南大区.速运深圳区.民治分部.深圳金龙站">
                                                            755FTL.速运事业群.华南大区.速运深圳区.民治分部.深圳金龙站
                                                        </option>
                                                        <option value="755AVES.商业事业群.商业深圳分公司.双龙坪坑区域.风临四季店">
                                                            755AVES.商业事业群.商业深圳分公司.双龙坪坑区域.风临四季店
                                                        </option>
                                                        <option value="755A.速运事业群.华南大区.速运深圳区.福田分部">
                                                            755A.速运事业群.华南大区.速运深圳区.福田分部
                                                        </option>
                                                        <option value="755Q.速运事业群.华南大区.速运深圳区.田贝分部">
                                                            755Q.速运事业群.华南大区.速运深圳区.田贝分部
                                                        </option>
                                                        <option value="755ED.速运事业群.华南大区.速运深圳区.深圳重货管理部.坪山重货营业点">
                                                            755ED.速运事业群.华南大区.速运深圳区.深圳重货管理部.坪山重货营业点
                                                        </option>
                                                        <option value="755BE.速运事业群.华南大区.速运深圳区.民治分部">
                                                            755BE.速运事业群.华南大区.速运深圳区.民治分部
                                                        </option>
                                                        <option value="E755EB.仓配物流事业群.仓配深圳区.机场速配营业部">
                                                            E755EB.仓配物流事业群.仓配深圳区.机场速配营业部
                                                        </option>
                                                        <option value="755CK.速运事业群.华南大区.速运深圳区.布心分部">
                                                            755CK.速运事业群.华南大区.速运深圳区.布心分部
                                                        </option>
                                                        <option value="755CF.速运事业群.华南大区.速运深圳区.龙西分部">
                                                            755CF.速运事业群.华南大区.速运深圳区.龙西分部
                                                        </option>
                                                        <option value="755DV.速运事业群.华南大区.速运深圳区.深圳重货管理部.龙华重货营业点">
                                                            755DV.速运事业群.华南大区.速运深圳区.深圳重货管理部.龙华重货营业点
                                                        </option>
                                                        <option value="755AQ.速运事业群华南大区速运深圳区吉厦村速运营业部">
                                                            755AQ.速运事业群华南大区速运深圳区吉厦村速运营业部
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区营运部车辆管理组">
                                                            速运事业群华南大区速运深圳区营运部车辆管理组
                                                        </option>
                                                        <option value="755WE.营运中心.华南分拨区.深圳九围陆运重货中转场">
                                                            755WE.营运中心.华南分拨区.深圳九围陆运重货中转场
                                                        </option>
                                                        <option value="755BP.速运事业群.华南大区.速运深圳区.福民分部">
                                                            755BP.速运事业群.华南大区.速运深圳区.福民分部
                                                        </option>
                                                        <option value="755LEL.速运事业群.华南大区.速运深圳区.民治分部.横岭四区站">
                                                            755LEL.速运事业群.华南大区.速运深圳区.民治分部.横岭四区站
                                                        </option>
                                                        <option value="755E.深圳区龙岗分部">
                                                            755E.深圳区龙岗分部
                                                        </option>
                                                        <option value="755AD.速运事业群.华南大区.速运深圳区.平湖分部">
                                                            755AD.速运事业群.华南大区.速运深圳区.平湖分部
                                                        </option>
                                                        <option value="755CH.速运事业群.华南大区.速运深圳区.九围分部">
                                                            755CH.速运事业群.华南大区.速运深圳区.九围分部
                                                        </option>
                                                        <option value="755G.速运事业群.华南大区.速运深圳区.南山分部">
                                                            755G.速运事业群.华南大区.速运深圳区.南山分部
                                                        </option>
                                                        <option value="755BQS.商业事业群.商业深圳分公司.万科城区域.上品雅园店">
                                                            755BQS.商业事业群.商业深圳分公司.万科城区域.上品雅园店
                                                        </option>
                                                        <option value="755AJ.速运事业群.华南大区.速运深圳区.龙华分部">
                                                            755AJ.速运事业群.华南大区.速运深圳区.龙华分部
                                                        </option>
                                                        <option value="E755SCP.仓配物流事业群.仓配深圳区.坪山速配站.土洋社区顺丰站">
                                                            E755SCP.仓配物流事业群.仓配深圳区.坪山速配站.土洋社区顺丰站
                                                        </option>
                                                        <option value="755JPL.速运事业群.华南大区.速运深圳区.上塘分部.瓦窑排站">
                                                            755JPL.速运事业群.华南大区.速运深圳区.上塘分部.瓦窑排站
                                                        </option>
                                                        <option value="755AS.速运事业群华南大区速运深圳区南头分部">
                                                            755AS.速运事业群华南大区速运深圳区南头分部
                                                        </option>
                                                        <option value="755DF.速运事业群.华南大区.速运深圳区.清湖分部">
                                                            755DF.速运事业群.华南大区.速运深圳区.清湖分部
                                                        </option>
                                                        <option value="755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点">
                                                            755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点
                                                        </option>
                                                        <option value="E755SJE.仓配物流事业群.仓配深圳区.龙华速配站.商业街顺丰站">
                                                            E755SJE.仓配物流事业群.仓配深圳区.龙华速配站.商业街顺丰站
                                                        </option>
                                                        <option value="755B.速运事业群.华南大区.速运深圳区.布吉分部">
                                                            755B.速运事业群.华南大区.速运深圳区.布吉分部
                                                        </option>
                                                        <option value="755EUL.速运事业群.华南大区.速运深圳区.民治分部.水尾新村站">
                                                            755EUL.速运事业群.华南大区.速运深圳区.民治分部.水尾新村站
                                                        </option>
                                                        <option value="755P.深圳区观澜分部">
                                                            755P.深圳区观澜分部
                                                        </option>
                                                        <option value="755DKAS.商业事业群.商业深圳分公司.双龙坪坑区域.豪方菁园店">
                                                            755DKAS.商业事业群.商业深圳分公司.双龙坪坑区域.豪方菁园店
                                                        </option>
                                                        <option value="E755Y.仓配物流事业群.仓配深圳区.客户部.客户运维组">
                                                            E755Y.仓配物流事业群.仓配深圳区.客户部.客户运维组
                                                        </option>
                                                        <option value="755AQ.速运事业群.华南大区.速运深圳区.南湾分部">
                                                            755AQ.速运事业群.华南大区.速运深圳区.南湾分部
                                                        </option>
                                                        <option value="E755SCN.仓配物流事业群.仓配深圳区.布心速配站.吉星花园顺丰站">
                                                            E755SCN.仓配物流事业群.仓配深圳区.布心速配站.吉星花园顺丰站
                                                        </option>
                                                        <option value="755K.速运事业群.华南大区.速运深圳区.坪山分部">
                                                            755K.速运事业群.华南大区.速运深圳区.坪山分部
                                                        </option>
                                                        <option value="755BDL.速运事业群.华南大区.速运深圳区.荷坳分部.龙苑新村站">
                                                            755BDL.速运事业群.华南大区.速运深圳区.荷坳分部.龙苑新村站
                                                        </option>
                                                        <option value="755WD.深圳区彩田中转场">
                                                            755WD.深圳区彩田中转场
                                                        </option>
                                                        <option value="755KVL.速运事业群.华南大区.速运深圳区.上塘分部.国鸿站">
                                                            755KVL.速运事业群.华南大区.速运深圳区.上塘分部.国鸿站
                                                        </option>
                                                        <option value="755BD.速运事业群.华南大区.速运深圳区.荷坳分部">
                                                            755BD.速运事业群.华南大区.速运深圳区.荷坳分部
                                                        </option>
                                                        <option value="E755SCE.仓配物流事业群.仓配深圳区.龙华速配站.华侨新村顺丰站">
                                                            E755SCE.仓配物流事业群.仓配深圳区.龙华速配站.华侨新村顺丰站
                                                        </option>
                                                        <option value="755KJL.速运事业群.华南大区.速运深圳区.上塘分部.盛世江南站">
                                                            755KJL.速运事业群.华南大区.速运深圳区.上塘分部.盛世江南站
                                                        </option>
                                                        <option value="755BL.速运事业群.华南大区.速运深圳区.华为分部">
                                                            755BL.速运事业群.华南大区.速运深圳区.华为分部
                                                        </option>
                                                        <option value="755DAAS.商业事业群.商业深圳分公司.东门商圈区域.可园一期店">
                                                            755DAAS.商业事业群.商业深圳分公司.东门商圈区域.可园一期店
                                                        </option>
                                                        <option value="755M.速运事业群.华南大区.速运深圳区.盐田分部">
                                                            755M.速运事业群.华南大区.速运深圳区.盐田分部
                                                        </option>
                                                        <option value="755BL.深圳区华为分部">
                                                            755BL.深圳区华为分部
                                                        </option>
                                                        <option value="755DA.速运事业群.华南大区.速运深圳区.罗岗分部">
                                                            755DA.速运事业群.华南大区.速运深圳区.罗岗分部
                                                        </option>
                                                        <option value="755CEES.商业事业群.商业深圳分公司.布吉关外区域.长龙店">
                                                            755CEES.商业事业群.商业深圳分公司.布吉关外区域.长龙店
                                                        </option>
                                                        <option value="E755SFS.仓配物流事业群.仓配深圳区.龙岭速配站.深圳下水径顺丰站">
                                                            E755SFS.仓配物流事业群.仓配深圳区.龙岭速配站.深圳下水径顺丰站
                                                        </option>
                                                        <option value="755BNL.速运事业群.华南大区.速运深圳区.布吉分部.大发埔村站">
                                                            755BNL.速运事业群.华南大区.速运深圳区.布吉分部.大发埔村站
                                                        </option>
                                                        <option value="755WF.营运中心.华南分拨区.深圳五和中转场">
                                                            755WF.营运中心.华南分拨区.深圳五和中转场
                                                        </option>
                                                        <option value="755AJBS.商业事业群.商业深圳分公司.龙华观平区域.福轩新村店">
                                                            755AJBS.商业事业群.商业深圳分公司.龙华观平区域.福轩新村店
                                                        </option>
                                                        <option value="E755SKA.仓配物流事业群.仓配深圳区.民治速配站.龙塘新村顺丰站">
                                                            E755SKA.仓配物流事业群.仓配深圳区.民治速配站.龙塘新村顺丰站
                                                        </option>
                                                        <option value="E755SFM.仓配物流事业群.仓配深圳区.民治速配站.深圳松仔园顺丰站">
                                                            E755SFM.仓配物流事业群.仓配深圳区.民治速配站.深圳松仔园顺丰站
                                                        </option>
                                                        <option value="E755SFC.仓配物流事业群.仓配深圳区.龙华速配站.谭罗新村顺丰站">
                                                            E755SFC.仓配物流事业群.仓配深圳区.龙华速配站.谭罗新村顺丰站
                                                        </option>
                                                        <option value="E755SKS.仓配物流事业群.仓配深圳区.深圳顺大速配站.和平小区顺丰站">
                                                            E755SKS.仓配物流事业群.仓配深圳区.深圳顺大速配站.和平小区顺丰站
                                                        </option>
                                                        <option value="755AK.速运事业群.华南大区.速运深圳区.沙井分部">
                                                            755AK.速运事业群.华南大区.速运深圳区.沙井分部
                                                        </option>
                                                        <option value="坪山">
                                                            坪山
                                                        </option>
                                                        <option value="755BTL.速运事业群.华南大区.速运深圳区.民治分部.逸秀新村站">
                                                            755BTL.速运事业群.华南大区.速运深圳区.民治分部.逸秀新村站
                                                        </option>
                                                        <option value="755BD.速运事业群华南大区速运深圳区荷坳社区速运营业部">
                                                            755BD.速运事业群华南大区速运深圳区荷坳社区速运营业部
                                                        </option>
                                                        <option value="755JGL.速运事业群.华南大区.速运深圳区.荷坳分部.安良站">
                                                            755JGL.速运事业群.华南大区.速运深圳区.荷坳分部.安良站
                                                        </option>
                                                        <option value="755EA.速运事业群.华南大区.速运深圳区.大浪分部">
                                                            755EA.速运事业群.华南大区.速运深圳区.大浪分部
                                                        </option>
                                                        <option value="755DUL.速运事业群.华南大区.速运深圳区.民治分部.向南新村站">
                                                            755DUL.速运事业群.华南大区.速运深圳区.民治分部.向南新村站
                                                        </option>
                                                        <option value="755GKL.速运事业群.华南大区.速运深圳区.民治分部.深圳横岭五区站">
                                                            755GKL.速运事业群.华南大区.速运深圳区.民治分部.深圳横岭五区站
                                                        </option>
                                                        <option value="坪环街道速运营业部">
                                                            坪环街道速运营业部
                                                        </option>
                                                        <option value="E755SFN.仓配物流事业群.仓配深圳区.龙华速配站.下横朗新村顺丰站">
                                                            E755SFN.仓配物流事业群.仓配深圳区.龙华速配站.下横朗新村顺丰站
                                                        </option>
                                                        <option value="区部">
                                                            区部
                                                        </option>
                                                        <option value="龙岭">
                                                            龙岭
                                                        </option>
                                                        <option value="E755SET.仓配物流事业群.仓配深圳区.深圳顺大速配站.玉翠花园顺丰站">
                                                            E755SET.仓配物流事业群.仓配深圳区.深圳顺大速配站.玉翠花园顺丰站
                                                        </option>
                                                        <option value="E755BJ.仓配物流事业群.仓配深圳区.布吉速配营业部">
                                                            E755BJ.仓配物流事业群.仓配深圳区.布吉速配营业部
                                                        </option>
                                                        <option value="E755DCB.仓配物流事业群.仓配深圳区.深圳转运仓储配送仓库">
                                                            E755DCB.仓配物流事业群.仓配深圳区.深圳转运仓储配送仓库
                                                        </option>
                                                        <option value="755AVCS.商业事业群.商业深圳分公司.双龙坪坑区域.峦山谷店">
                                                            755AVCS.商业事业群.商业深圳分公司.双龙坪坑区域.峦山谷店
                                                        </option>
                                                        <option value="755EE.速运事业群.华南大区.速运深圳区.深圳重货管理部.福田重货营业点">
                                                            755EE.速运事业群.华南大区.速运深圳区.深圳重货管理部.福田重货营业点
                                                        </option>
                                                        <option value="755BEES.商业事业群.商业深圳分公司.白石龙区域.鑫茂花园店">
                                                            755BEES.商业事业群.商业深圳分公司.白石龙区域.鑫茂花园店
                                                        </option>
                                                        <option value="E755AB.仓配物流事业群.仓配深圳区.深圳跨境速配站">
                                                            E755AB.仓配物流事业群.仓配深圳区.深圳跨境速配站
                                                        </option>
                                                        <option value="E755AG.仓配物流事业群.仓配深圳区.西乡速配站">
                                                            E755AG.仓配物流事业群.仓配深圳区.西乡速配站
                                                        </option>
                                                        <option value="E755J.仓配物流事业群.仓配深圳区.横岗速配站">
                                                            E755J.仓配物流事业群.仓配深圳区.横岗速配站
                                                        </option>
                                                        <option value="E755SJM.仓配物流事业群.仓配深圳区.民治速配站.南景新村顺丰站">
                                                            E755SJM.仓配物流事业群.仓配深圳区.民治速配站.南景新村顺丰站
                                                        </option>
                                                        <option value="皇岗">
                                                            皇岗
                                                        </option>
                                                        <option value="西乡中心公司">
                                                            西乡中心公司
                                                        </option>
                                                        <option value="755GGL.速运事业群.华南大区.速运深圳区.民治分部.深圳澳门新村站">
                                                            755GGL.速运事业群.华南大区.速运深圳区.民治分部.深圳澳门新村站
                                                        </option>
                                                        <option value="755BF.速运事业群.华南大区.速运深圳区.新洲分部">
                                                            755BF.速运事业群.华南大区.速运深圳区.新洲分部
                                                        </option>
                                                        <option value="755BGS.商业事业群.商业深圳分公司.万科城区域.深圳金洲店">
                                                            755BGS.商业事业群.商业深圳分公司.万科城区域.深圳金洲店
                                                        </option>
                                                        <option value="755LPL.速运事业群.华南大区.速运深圳区.罗岗分部.可园站">
                                                            755LPL.速运事业群.华南大区.速运深圳区.罗岗分部.可园站
                                                        </option>
                                                        <option value="755EML.速运事业群.华南大区.速运深圳区.大浪分部.赖屋山站">
                                                            755EML.速运事业群.华南大区.速运深圳区.大浪分部.赖屋山站
                                                        </option>
                                                        <option value="E755C.仓配物流事业群.仓配深圳区.顺大速配营业部">
                                                            E755C.仓配物流事业群.仓配深圳区.顺大速配营业部
                                                        </option>
                                                        <option value="755EH.速运事业群.华南大区.速运深圳区.深圳重货管理部.罗湖重货营业点">
                                                            755EH.速运事业群.华南大区.速运深圳区.深圳重货管理部.罗湖重货营业点
                                                        </option>
                                                        <option value="南湾">
                                                            南湾
                                                        </option>
                                                        <option value="755BA.速运事业群.华南大区.速运深圳区.华富分部">
                                                            755BA.速运事业群.华南大区.速运深圳区.华富分部
                                                        </option>
                                                        <option value="755DFBS.商业事业群.商业深圳分公司.龙华观平区域.深圳新碑村店">
                                                            755DFBS.商业事业群.商业深圳分公司.龙华观平区域.深圳新碑村店
                                                        </option>
                                                        <option value="侨城">
                                                            侨城
                                                        </option>
                                                        <option value="755DFGS.商业事业群.商业深圳分公司.龙华观平区域.上早村店">
                                                            755DFGS.商业事业群.商业深圳分公司.龙华观平区域.上早村店
                                                        </option>
                                                        <option value="彩田">
                                                            彩田
                                                        </option>
                                                        <option value="755CB.速运事业群.华南大区.速运深圳区.福安分部">
                                                            755CB.速运事业群.华南大区.速运深圳区.福安分部
                                                        </option>
                                                        <option value="755CA.速运事业群.华南大区.速运深圳区.景田分部">
                                                            755CA.速运事业群.华南大区.速运深圳区.景田分部
                                                        </option>
                                                        <option value="755AR.速运事业群.华南大区.速运深圳区.侨城分部">
                                                            755AR.速运事业群.华南大区.速运深圳区.侨城分部
                                                        </option>
                                                        <option value="755JDU.速运事业群.华南大区.速运深圳区.深圳重货管理部.华强重货营业点">
                                                            755JDU.速运事业群.华南大区.速运深圳区.深圳重货管理部.华强重货营业点
                                                        </option>
                                                        <option value="755Y.速运事业群.华南大区.速运深圳区.市场销售部.销售管理组">
                                                            755Y.速运事业群.华南大区.速运深圳区.市场销售部.销售管理组
                                                        </option>
                                                        <option value="755BLL.速运事业群.华南大区.速运深圳区.景田分部.布尾村站">
                                                            755BLL.速运事业群.华南大区.速运深圳区.景田分部.布尾村站
                                                        </option>
                                                        <option value="E755U.仓配物流事业群.仓配深圳区.华强速配站">
                                                            E755U.仓配物流事业群.仓配深圳区.华强速配站
                                                        </option>
                                                        <option value="755EP.速运事业群.华南大区.速运深圳区.福田分部.广华点部">
                                                            755EP.速运事业群.华南大区.速运深圳区.福田分部.广华点部
                                                        </option>
                                                        <option value="E755SGF.仓配物流事业群.仓配深圳区.梅林速配站.深圳特发小区顺丰站">
                                                            E755SGF.仓配物流事业群.仓配深圳区.梅林速配站.深圳特发小区顺丰站
                                                        </option>
                                                        <option value="755DN.速运事业群.华南大区.速运深圳区.深圳重货管理部.南山重货营业点">
                                                            755DN.速运事业群.华南大区.速运深圳区.深圳重货管理部.南山重货营业点
                                                        </option>
                                                        <option value="755AA.速运事业群.华南大区.速运深圳区.梅林分部">
                                                            755AA.速运事业群.华南大区.速运深圳区.梅林分部
                                                        </option>
                                                        <option value="755FQL.速运事业群.华南大区.速运深圳区.梅林分部.深圳莲花北村站">
                                                            755FQL.速运事业群.华南大区.速运深圳区.梅林分部.深圳莲花北村站
                                                        </option>
                                                        <option value="E755SME.仓配物流事业群.仓配深圳区.福田速配站.上沙顺丰站">
                                                            E755SME.仓配物流事业群.仓配深圳区.福田速配站.上沙顺丰站
                                                        </option>
                                                        <option value="E755AA.仓配物流事业群.仓配深圳区.梅林速配站">
                                                            E755AA.仓配物流事业群.仓配深圳区.梅林速配站
                                                        </option>
                                                        <option value="755EVL.速运事业群.华南大区.速运深圳区.福安分部.田面新村站">
                                                            755EVL.速运事业群.华南大区.速运深圳区.福安分部.田面新村站
                                                        </option>
                                                        <option value="E755A.仓配物流事业群.仓配深圳区.福田速配站">
                                                            E755A.仓配物流事业群.仓配深圳区.福田速配站
                                                        </option>
                                                        <option value="755DG.速运事业群.华南大区.速运深圳区.前海分部">
                                                            755DG.速运事业群.华南大区.速运深圳区.前海分部
                                                        </option>
                                                        <option value="755AABS.商业事业群.商业深圳分公司.市民中心区域.围面村店">
                                                            755AABS.商业事业群.商业深圳分公司.市民中心区域.围面村店
                                                        </option>
                                                        <option value="E755AM.仓配物流事业群.仓配深圳区.皇岗速配站">
                                                            E755AM.仓配物流事业群.仓配深圳区.皇岗速配站
                                                        </option>
                                                        <option value="755KNL.速运事业群.华南大区.速运深圳区.新洲分部.桂花苑站">
                                                            755KNL.速运事业群.华南大区.速运深圳区.新洲分部.桂花苑站
                                                        </option>
                                                        <option value="755DGAS.商业事业群.商业深圳分公司.依云伴山店">
                                                            755DGAS.商业事业群.商业深圳分公司.依云伴山店
                                                        </option>
                                                        <option value="755UBS.商业事业群.商业深圳分公司.市民中心区域.红荔村店">
                                                            755UBS.商业事业群.商业深圳分公司.市民中心区域.红荔村店
                                                        </option>
                                                        <option value="755AAES.商业事业群.商业深圳分公司.梅林路店">
                                                            755AAES.商业事业群.商业深圳分公司.梅林路店
                                                        </option>
                                                        <option value="755GAS.商业事业群.商业深圳分公司.缘来居店">
                                                            755GAS.商业事业群.商业深圳分公司.缘来居店
                                                        </option>
                                                        <option value="755AP.速运事业群.华南大区.速运深圳区.西丽分部">
                                                            755AP.速运事业群.华南大区.速运深圳区.西丽分部
                                                        </option>
                                                        <option value="755EN.速运事业群.华南大区.速运深圳区.运输分部">
                                                            755EN.速运事业群.华南大区.速运深圳区.运输分部
                                                        </option>
                                                        <option value="755TFS.商业事业群.商业深圳分公司.南油大厦区域.南园店">
                                                            755TFS.商业事业群.商业深圳分公司.南油大厦区域.南园店
                                                        </option>
                                                        <option value="755ASGS.商业事业群.商业深圳分公司.西丽职院区域.星海名城店">
                                                            755ASGS.商业事业群.商业深圳分公司.西丽职院区域.星海名城店
                                                        </option>
                                                        <option value="755APBS.商业事业群.商业深圳分公司.西丽职院区域.德意名居店">
                                                            755APBS.商业事业群.商业深圳分公司.西丽职院区域.德意名居店
                                                        </option>
                                                        <option value="755JEN.速运事业群.华南大区.速运深圳区.深圳重货管理部.西丽重货营业点">
                                                            755JEN.速运事业群.华南大区.速运深圳区.深圳重货管理部.西丽重货营业点
                                                        </option>
                                                        <option value="755DL.速运事业群.华南大区.速运深圳区.南油分部.后海点部">
                                                            755DL.速运事业群.华南大区.速运深圳区.南油分部.后海点部
                                                        </option>
                                                        <option value="755DQ.速运事业群.华南大区.速运深圳区.朗山分部">
                                                            755DQ.速运事业群.华南大区.速运深圳区.朗山分部
                                                        </option>
                                                        <option value="755APCS.商业事业群.商业深圳分公司.西丽职院区域.西湖林语店">
                                                            755APCS.商业事业群.商业深圳分公司.西丽职院区域.西湖林语店
                                                        </option>
                                                        <option value="755W.营运中心.华南分拨区.深圳黄田中转场">
                                                            755W.营运中心.华南分拨区.深圳黄田中转场
                                                        </option>
                                                        <option value="755AT.速运事业群.华南大区.速运深圳区.蛇口分部">
                                                            755AT.速运事业群.华南大区.速运深圳区.蛇口分部
                                                        </option>
                                                        <option value="755T.速运事业群.华南大区.速运深圳区.南油分部">
                                                            755T.速运事业群.华南大区.速运深圳区.南油分部
                                                        </option>
                                                        <option value="755AS.速运事业群.华南大区.速运深圳区.南头分部">
                                                            755AS.速运事业群.华南大区.速运深圳区.南头分部
                                                        </option>
                                                        <option value="755CQ.速运事业群.华南大区.速运深圳区.福星分部">
                                                            755CQ.速运事业群.华南大区.速运深圳区.福星分部
                                                        </option>
                                                        <option value="755LBL.速运事业群.华南大区.速运深圳区.南头分部.大新站">
                                                            755LBL.速运事业群.华南大区.速运深圳区.南头分部.大新站
                                                        </option>
                                                        <option value="755APBS.商业事业群.商业深圳分公司.德意名居店">
                                                            755APBS.商业事业群.商业深圳分公司.德意名居店
                                                        </option>
                                                        <option value="南山特服">
                                                            南山特服
                                                        </option>
                                                        <option value="E755SJN.仓配物流事业群.仓配深圳区.南山速配站.阳光棕榈园顺丰站">
                                                            E755SJN.仓配物流事业群.仓配深圳区.南山速配站.阳光棕榈园顺丰站
                                                        </option>
                                                        <option value="755ASJS.商业事业群.商业深圳分公司.方鼎华庭店">
                                                            755ASJS.商业事业群.商业深圳分公司.方鼎华庭店
                                                        </option>
                                                        <option value="E755AP.仓配物流事业群.仓配深圳区.西丽速配站">
                                                            E755AP.仓配物流事业群.仓配深圳区.西丽速配站
                                                        </option>
                                                        <option value="755ASKS.商业事业群.商业深圳分公司.前海花园店">
                                                            755ASKS.商业事业群.商业深圳分公司.前海花园店
                                                        </option>
                                                        <option value="755ATJS.商业事业群.商业深圳分公司.皇庭港湾店">
                                                            755ATJS.商业事业群.商业深圳分公司.皇庭港湾店
                                                        </option>
                                                        <option value="755AMAS.商业事业群.商业深圳分公司.星河店">
                                                            755AMAS.商业事业群.商业深圳分公司.星河店
                                                        </option>
                                                        <option value="755TGS.商业事业群.商业深圳分公司.南油大厦区域.后海花园店">
                                                            755TGS.商业事业群.商业深圳分公司.南油大厦区域.后海花园店
                                                        </option>
                                                        <option value="755ASFS.商业事业群.商业深圳分公司.西丽职院区域.南海明珠店">
                                                            755ASFS.商业事业群.商业深圳分公司.西丽职院区域.南海明珠店
                                                        </option>
                                                        <option value="755APCS.商业事业群.商业深圳分公司.西湖林语店">
                                                            755APCS.商业事业群.商业深圳分公司.西湖林语店
                                                        </option>
                                                        <option value="755TCS.商业事业群.商业深圳分公司.南油大厦区域.蔚蓝海岸店">
                                                            755TCS.商业事业群.商业深圳分公司.南油大厦区域.蔚蓝海岸店
                                                        </option>
                                                        <option value="755ATCS.商业事业群.商业深圳分公司.海月花园店">
                                                            755ATCS.商业事业群.商业深圳分公司.海月花园店
                                                        </option>
                                                        <option value="755ATJS.商业事业群.商业深圳分公司.南油大厦区域.皇庭港湾店">
                                                            755ATJS.商业事业群.商业深圳分公司.南油大厦区域.皇庭港湾店
                                                        </option>
                                                        <option value="E755SFP.仓配物流事业群.仓配深圳区.南山速配站.深圳新德家园顺丰站">
                                                            E755SFP.仓配物流事业群.仓配深圳区.南山速配站.深圳新德家园顺丰站
                                                        </option>
                                                        <option value="南山">
                                                            南山
                                                        </option>
                                                        <option value="E755SMN.仓配物流事业群.仓配深圳区.蛇口速配站.阳光花园顺丰站">
                                                            E755SMN.仓配物流事业群.仓配深圳区.蛇口速配站.阳光花园顺丰站
                                                        </option>
                                                        <option value="755ASBS.商业事业群.商业深圳分公司.西丽职院区域.深圳钰龙园店">
                                                            755ASBS.商业事业群.商业深圳分公司.西丽职院区域.深圳钰龙园店
                                                        </option>
                                                        <option value="755ASDS.商业事业群.商业深圳分公司.西丽职院区域.古城店">
                                                            755ASDS.商业事业群.商业深圳分公司.西丽职院区域.古城店
                                                        </option>
                                                        <option value="755ASLS.商业事业群.商业深圳分公司.南航店">
                                                            755ASLS.商业事业群.商业深圳分公司.南航店
                                                        </option>
                                                        <option value="755ET.速运事业群.华南大区.速运深圳区.南头分部.南新点部">
                                                            755ET.速运事业群.华南大区.速运深圳区.南头分部.南新点部
                                                        </option>
                                                        <option value="755AGGS.商业事业群.商业深圳分公司.宝安机场区域.果岭店">
                                                            755AGGS.商业事业群.商业深圳分公司.宝安机场区域.果岭店
                                                        </option>
                                                        <option value="755TFS.商业事业群.商业深圳分公司.南园店">
                                                            755TFS.商业事业群.商业深圳分公司.南园店
                                                        </option>
                                                        <option value="755ASCS.商业事业群.商业深圳分公司.华府店">
                                                            755ASCS.商业事业群.商业深圳分公司.华府店
                                                        </option>
                                                        <option value="755CD.速运事业群.华南大区.速运深圳区.沙河分部">
                                                            755CD.速运事业群.华南大区.速运深圳区.沙河分部
                                                        </option>
                                                        <option value="755TCS.商业事业群.商业深圳分公司.蔚蓝海岸店">
                                                            755TCS.商业事业群.商业深圳分公司.蔚蓝海岸店
                                                        </option>
                                                        <option value="755CAAS.商业事业群.商业深圳分公司.市民中心区域.时尚天地店">
                                                            755CAAS.商业事业群.商业深圳分公司.市民中心区域.时尚天地店
                                                        </option>
                                                        <option value="755ASKS.商业事业群.商业深圳分公司.西丽职院区域.前海花园店">
                                                            755ASKS.商业事业群.商业深圳分公司.西丽职院区域.前海花园店
                                                        </option>
                                                        <option value="755ARAS.商业事业群.商业深圳分公司.南油大厦区域.香域中央店">
                                                            755ARAS.商业事业群.商业深圳分公司.南油大厦区域.香域中央店
                                                        </option>
                                                        <option value="755ATHS.商业事业群.商业深圳分公司.曙光店">
                                                            755ATHS.商业事业群.商业深圳分公司.曙光店
                                                        </option>
                                                        <option value="755CFGS.商业事业群.商业深圳分公司.双龙坪坑区域.中央悦城店">
                                                            755CFGS.商业事业群.商业深圳分公司.双龙坪坑区域.中央悦城店
                                                        </option>
                                                        <option value="755EFS.商业事业群.商业深圳分公司.龙岗大运区域.君悦豪庭店">
                                                            755EFS.商业事业群.商业深圳分公司.龙岗大运区域.君悦豪庭店
                                                        </option>
                                                        <option value="755EES.商业事业群.商业深圳分公司.龙岗大运区域.鸿基花园店">
                                                            755EES.商业事业群.商业深圳分公司.龙岗大运区域.鸿基花园店
                                                        </option>
                                                        <option value="755BNS.商业事业群.商业深圳分公司.万科城区域.月朗苑店">
                                                            755BNS.商业事业群.商业深圳分公司.万科城区域.月朗苑店
                                                        </option>
                                                        <option value="755AQDS.商业事业群.商业深圳分公司.布吉关外区域.玉岭花园店">
                                                            755AQDS.商业事业群.商业深圳分公司.布吉关外区域.玉岭花园店
                                                        </option>
                                                        <option value="龙岗">
                                                            龙岗
                                                        </option>
                                                        <option value="755ARBS.商业事业群.商业深圳分公司.南油大厦区域.熙园店">
                                                            755ARBS.商业事业群.商业深圳分公司.南油大厦区域.熙园店
                                                        </option>
                                                        <option value="755ATDS.商业事业群.商业深圳分公司.南油大厦区域.深圳兰园店">
                                                            755ATDS.商业事业群.商业深圳分公司.南油大厦区域.深圳兰园店
                                                        </option>
                                                        <option value="755DAAS.商业事业群.商业深圳分公司.可园一期店">
                                                            755DAAS.商业事业群.商业深圳分公司.可园一期店
                                                        </option>
                                                        <option value="755GAS.商业事业群.商业深圳分公司.西丽职院区域.缘来居店">
                                                            755GAS.商业事业群.商业深圳分公司.西丽职院区域.缘来居店
                                                        </option>
                                                        <option value="755DKAS.商业事业群.商业深圳分公司.豪方菁园店">
                                                            755DKAS.商业事业群.商业深圳分公司.豪方菁园店
                                                        </option>
                                                        <option value="755JCS.商业事业群.商业深圳分公司.景冠华诚店">
                                                            755JCS.商业事业群.商业深圳分公司.景冠华诚店
                                                        </option>
                                                        <option value="755ATGS.商业事业群.商业深圳分公司.南油大厦区域.玫瑰园店">
                                                            755ATGS.商业事业群.商业深圳分公司.南油大厦区域.玫瑰园店
                                                        </option>
                                                        <option value="西丽">
                                                            西丽
                                                        </option>
                                                        <option value="755TBS.商业事业群.商业深圳分公司.南油大厦区域.深圳南门店">
                                                            755TBS.商业事业群.商业深圳分公司.南油大厦区域.深圳南门店
                                                        </option>
                                                        <option value="755BEJS.商业事业群.商业深圳分公司.白石龙区域.樟坑店">
                                                            755BEJS.商业事业群.商业深圳分公司.白石龙区域.樟坑店
                                                        </option>
                                                        <option value="755ABFS.商业事业群.商业深圳分公司.康达尔店">
                                                            755ABFS.商业事业群.商业深圳分公司.康达尔店
                                                        </option>
                                                        <option value="755AVBS.商业事业群.商业深圳分公司.双龙坪坑区域.赤石岗店">
                                                            755AVBS.商业事业群.商业深圳分公司.双龙坪坑区域.赤石岗店
                                                        </option>
                                                        <option value="755AVDS.商业事业群.商业深圳分公司.双龙坪坑区域.怡龙店">
                                                            755AVDS.商业事业群.商业深圳分公司.双龙坪坑区域.怡龙店
                                                        </option>
                                                        <option value="755EJS.商业事业群.商业深圳分公司.龙岗大运区域.锦绣东方店">
                                                            755EJS.商业事业群.商业深圳分公司.龙岗大运区域.锦绣东方店
                                                        </option>
                                                        <option value="龙岭分部">
                                                            龙岭分部
                                                        </option>
                                                        <option value="南油分部">
                                                            南油分部
                                                        </option>
                                                        <option value="755BDAS.商业事业群.商业深圳分公司.龙岗大运区域.大运店">
                                                            755BDAS.商业事业群.商业深圳分公司.龙岗大运区域.大运店
                                                        </option>
                                                        <option value="755ABBS.商业事业群.商业深圳分公司.中海怡翠店">
                                                            755ABBS.商业事业群.商业深圳分公司.中海怡翠店
                                                        </option>
                                                        <option value="755AVAS.商业事业群.商业深圳分公司.双龙坪坑区域.鹏达店">
                                                            755AVAS.商业事业群.商业深圳分公司.双龙坪坑区域.鹏达店
                                                        </option>
                                                        <option value="755ASGS.商业事业群.商业深圳分公司.星海名城店">
                                                            755ASGS.商业事业群.商业深圳分公司.星海名城店
                                                        </option>
                                                        <option value="E755SCA.仓配物流事业群.仓配深圳区.坪地速配站.东湖街顺丰站">
                                                            E755SCA.仓配物流事业群.仓配深圳区.坪地速配站.东湖街顺丰站
                                                        </option>
                                                        <option value="755ABCS.商业事业群.商业深圳分公司.深圳曼城店">
                                                            755ABCS.商业事业群.商业深圳分公司.深圳曼城店
                                                        </option>
                                                        <option value="755KCS.商业事业群.商业深圳分公司.双龙坪坑区域.金域缇香店">
                                                            755KCS.商业事业群.商业深圳分公司.双龙坪坑区域.金域缇香店
                                                        </option>
                                                        <option value="755ADAS.商业事业群.商业深圳分公司.龙岗大运区域.深圳守珍街店">
                                                            755ADAS.商业事业群.商业深圳分公司.龙岗大运区域.深圳守珍街店
                                                        </option>
                                                        <option value="755CFGS.商业事业群.商业深圳分公司.中央悦城店">
                                                            755CFGS.商业事业群.商业深圳分公司.中央悦城店
                                                        </option>
                                                        <option value="755CEFS.商业事业群.商业深圳分公司.布吉关外区域.中心花园店">
                                                            755CEFS.商业事业群.商业深圳分公司.布吉关外区域.中心花园店
                                                        </option>
                                                        <option value="E755G.仓配物流事业群.仓配深圳区.南山速配营业部">
                                                            E755G.仓配物流事业群.仓配深圳区.南山速配营业部
                                                        </option>
                                                        <option value="E755SCZ.仓配物流事业群.仓配深圳区.龙岭速配站.新梅子园顺丰站">
                                                            E755SCZ.仓配物流事业群.仓配深圳区.龙岭速配站.新梅子园顺丰站
                                                        </option>
                                                        <option value="755DABS.商业事业群.商业深圳分公司.东门商圈区域.假日名城店">
                                                            755DABS.商业事业群.商业深圳分公司.东门商圈区域.假日名城店
                                                        </option>
                                                        <option value="755CEFS.商业事业群.商业深圳分公司.中心花园店">
                                                            755CEFS.商业事业群.商业深圳分公司.中心花园店
                                                        </option>
                                                        <option value="E755CK.仓配物流事业群.仓配深圳区.布心速配站">
                                                            E755CK.仓配物流事业群.仓配深圳区.布心速配站
                                                        </option>
                                                        <option value="755BFBS.商业事业群.商业深圳分公司.深圳嘉葆润店">
                                                            755BFBS.商业事业群.商业深圳分公司.深圳嘉葆润店
                                                        </option>
                                                        <option value="755AVCS.商业事业群.商业深圳分公司.峦山谷店">
                                                            755AVCS.商业事业群.商业深圳分公司.峦山谷店
                                                        </option>
                                                        <option value="755EKS.商业事业群.商业深圳分公司.熙和园店">
                                                            755EKS.商业事业群.商业深圳分公司.熙和园店
                                                        </option>
                                                        <option value="755AQES.商业事业群.商业深圳分公司.东门商圈区域.深圳国展苑店">
                                                            755AQES.商业事业群.商业深圳分公司.东门商圈区域.深圳国展苑店
                                                        </option>
                                                        <option value="755ASJS.商业事业群.商业深圳分公司.西丽职院区域.方鼎华庭店">
                                                            755ASJS.商业事业群.商业深圳分公司.西丽职院区域.方鼎华庭店
                                                        </option>
                                                        <option value="755ATCS.商业事业群.商业深圳分公司.南油大厦区域.海月花园店">
                                                            755ATCS.商业事业群.商业深圳分公司.南油大厦区域.海月花园店
                                                        </option>
                                                        <option value="755EGS.商业事业群.商业深圳分公司.海逸雅居店">
                                                            755EGS.商业事业群.商业深圳分公司.海逸雅居店
                                                        </option>
                                                        <option value="755ADBS.商业事业群.商业深圳分公司.龙岗大运区域.深圳茗翠园店">
                                                            755ADBS.商业事业群.商业深圳分公司.龙岗大运区域.深圳茗翠园店
                                                        </option>
                                                        <option value="755CAAS.商业事业群.商业深圳分公司.时尚天地店">
                                                            755CAAS.商业事业群.商业深圳分公司.时尚天地店
                                                        </option>
                                                        <option value="755DBS.商业事业群.商业深圳分公司.东门商圈区域.百合店">
                                                            755DBS.商业事业群.商业深圳分公司.东门商圈区域.百合店
                                                        </option>
                                                        <option value="755ASFS.商业事业群.商业深圳分公司.南海明珠店">
                                                            755ASFS.商业事业群.商业深圳分公司.南海明珠店
                                                        </option>
                                                        <option value="755DGBS.商业事业群.商业深圳分公司.泛海拉菲店">
                                                            755DGBS.商业事业群.商业深圳分公司.泛海拉菲店
                                                        </option>
                                                        <option value="755ATFS.商业事业群.商业深圳分公司.汉京山店">
                                                            755ATFS.商业事业群.商业深圳分公司.汉京山店
                                                        </option>
                                                        <option value="E755G.仓配物流事业群.仓配深圳区.南山速配站">
                                                            E755G.仓配物流事业群.仓配深圳区.南山速配站
                                                        </option>
                                                        <option value="755CD.速运事业群华南大区速运深圳区沙河工业区速运营业部">
                                                            755CD.速运事业群华南大区速运深圳区沙河工业区速运营业部
                                                        </option>
                                                        <option value="755EE.速运事业群华南大区速运深圳区上梅林速运重货营业部">
                                                            755EE.速运事业群华南大区速运深圳区上梅林速运重货营业部
                                                        </option>
                                                        <option value="755T.速运事业群华南大区速运深圳区南油服装城速运营业部">
                                                            755T.速运事业群华南大区速运深圳区南油服装城速运营业部
                                                        </option>
                                                        <option value="755E.速运事业群华南大区速运深圳区爱联陂头背村速运营业部">
                                                            755E.速运事业群华南大区速运深圳区爱联陂头背村速运营业部
                                                        </option>
                                                        <option value="755CE.速运事业群华南大区速运深圳区布吉一村速运营业部">
                                                            755CE.速运事业群华南大区速运深圳区布吉一村速运营业部
                                                        </option>
                                                        <option value="755CF.速运事业群华南大区速运深圳区陂头肚社区速运营业部">
                                                            755CF.速运事业群华南大区速运深圳区陂头肚社区速运营业部
                                                        </option>
                                                        <option value="755ET.速运事业群华南大区速运深圳区建安大院速运营业部仓前锦福苑速运营业点">
                                                            755ET.速运事业群华南大区速运深圳区建安大院速运营业部仓前锦福苑速运营业点
                                                        </option>
                                                        <option value="755AP.速运事业群华南大区速运深圳区九祥岭村速运营业部">
                                                            755AP.速运事业群华南大区速运深圳区九祥岭村速运营业部
                                                        </option>
                                                        <option value="755AD.速运事业群华南大区速运深圳区富民工业区速运营业部">
                                                            755AD.速运事业群华南大区速运深圳区富民工业区速运营业部
                                                        </option>
                                                        <option value="755AV.速运事业群华南大区速运深圳区龙东社区速运营业部">
                                                            755AV.速运事业群华南大区速运深圳区龙东社区速运营业部
                                                        </option>
                                                        <option value="755ED.速运事业群华南大区速运深圳区同乐速运重货营业部">
                                                            755ED.速运事业群华南大区速运深圳区同乐速运重货营业部
                                                        </option>
                                                        <option value="755CA.速运事业群华南大区速运深圳区景鹏综合楼速运营业部">
                                                            755CA.速运事业群华南大区速运深圳区景鹏综合楼速运营业部
                                                        </option>
                                                        <option value="755G.速运事业群华南大区速运深圳区科技园中区速运营业部">
                                                            755G.速运事业群华南大区速运深圳区科技园中区速运营业部
                                                        </option>
                                                        <option value="755K.速运事业群华南大区速运深圳区坪环街道速运营业部">
                                                            755K.速运事业群华南大区速运深圳区坪环街道速运营业部
                                                        </option>
                                                        <option value="755AB.速运事业群华南大区速运深圳区松元头速运营业部">
                                                            755AB.速运事业群华南大区速运深圳区松元头速运营业部
                                                        </option>
                                                        <option value="755KCS.商业事业群商业深圳分公司金域缇香店">
                                                            755KCS.商业事业群商业深圳分公司金域缇香店
                                                        </option>
                                                        <option value="755CFDS.商业事业群商业深圳分公司水岸新都店">
                                                            755CFDS.商业事业群商业深圳分公司水岸新都店
                                                        </option>
                                                        <option value="755EF.速运事业群华南大区速运深圳区荣丰大厦速运重货营业部">
                                                            755EF.速运事业群华南大区速运深圳区荣丰大厦速运重货营业部
                                                        </option>
                                                        <option value="755DG.速运事业群华南大区速运深圳区前海湾花园速运营业部">
                                                            755DG.速运事业群华南大区速运深圳区前海湾花园速运营业部
                                                        </option>
                                                        <option value="755AT.速运事业群华南大区速运深圳区兴华工业区速运营业部">
                                                            755AT.速运事业群华南大区速运深圳区兴华工业区速运营业部
                                                        </option>
                                                        <option value="755DK.速运事业群华南大区速运深圳区宝梓中路速运营业部">
                                                            755DK.速运事业群华南大区速运深圳区宝梓中路速运营业部
                                                        </option>
                                                        <option value="755AR.速运事业群华南大区速运深圳区侨香速运营业部">
                                                            755AR.速运事业群华南大区速运深圳区侨香速运营业部
                                                        </option>
                                                        <option value="755AS.速运事业群华南大区速运深圳区建安大院速运营业部">
                                                            755AS.速运事业群华南大区速运深圳区建安大院速运营业部
                                                        </option>
                                                        <option value="755DKBS.商业事业群商业深圳分公司深圳龙田店">
                                                            755DKBS.商业事业群商业深圳分公司深圳龙田店
                                                        </option>
                                                        <option value="755A.速运事业群华南大区速运深圳区天安速运营业部">
                                                            755A.速运事业群华南大区速运深圳区天安速运营业部
                                                        </option>
                                                        <option value="河南省郸城县吴台镇杨老家行政村侯庄村0001号">
                                                            河南省郸城县吴台镇杨老家行政村侯庄村0001号
                                                        </option>
                                                        <option value="755CCS.商业事业群商业深圳分公司兴华店">
                                                            755CCS.商业事业群商业深圳分公司兴华店
                                                        </option>
                                                        <option value="755DA.速运事业群华南大区速运深圳区罗岗街道办速运营业部">
                                                            755DA.速运事业群华南大区速运深圳区罗岗街道办速运营业部
                                                        </option>
                                                        <option value="755CFGS.商业事业群商业深圳分公司中央悦城店">
                                                            755CFGS.商业事业群商业深圳分公司中央悦城店
                                                        </option>
                                                        <option value="755EFS.商业事业群商业深圳分公司君悦豪庭店">
                                                            755EFS.商业事业群商业深圳分公司君悦豪庭店
                                                        </option>
                                                        <option value="755BF.速运事业群华南大区速运深圳区金地工业区速运营业部">
                                                            755BF.速运事业群华南大区速运深圳区金地工业区速运营业部
                                                        </option>
                                                        <option value="755AE.速运事业群华南大区速运深圳区坪地街道办速运营业部">
                                                            755AE.速运事业群华南大区速运深圳区坪地街道办速运营业部
                                                        </option>
                                                        <option value="755DNL.速运事业群华南大区速运深圳区布吉一村速运营业部教育新村速运营业站">
                                                            755DNL.速运事业群华南大区速运深圳区布吉一村速运营业部教育新村速运营业站
                                                        </option>
                                                        <option value="755CPES.商业事业群商业深圳分公司宝安松沙区域楼岗店">
                                                            755CPES.商业事业群商业深圳分公司宝安松沙区域楼岗店
                                                        </option>
                                                        <option value="755DQ.速运事业群华南大区速运深圳区朗山分部">
                                                            755DQ.速运事业群华南大区速运深圳区朗山分部
                                                        </option>
                                                        <option value="755AR.速运事业群华南大区速运深圳区侨城分部">
                                                            755AR.速运事业群华南大区速运深圳区侨城分部
                                                        </option>
                                                        <option value="755CMDS.商业深圳区深圳后瑞店">
                                                            755CMDS.商业深圳区深圳后瑞店
                                                        </option>
                                                        <option value="755DL.速运事业群华南大区速运深圳区南油分部后海点部">
                                                            755DL.速运事业群华南大区速运深圳区南油分部后海点部
                                                        </option>
                                                        <option value="755T.速运事业群华南大区速运深圳区南油分部">
                                                            755T.速运事业群华南大区速运深圳区南油分部
                                                        </option>
                                                        <option value="755AP.速运事业群华南大区速运深圳区西丽分部">
                                                            755AP.速运事业群华南大区速运深圳区西丽分部
                                                        </option>
                                                        <option value="755BF.速运事业群华南大区速运深圳区新洲分部">
                                                            755BF.速运事业群华南大区速运深圳区新洲分部
                                                        </option>
                                                        <option value="755A.速运事业群华南大区速运深圳区福田分部">
                                                            755A.速运事业群华南大区速运深圳区福田分部
                                                        </option>
                                                        <option value="755G.速运事业群华南大区速运深圳区南山分部">
                                                            755G.速运事业群华南大区速运深圳区南山分部
                                                        </option>
                                                        <option value="755AT.速运事业群华南大区速运深圳区蛇口分部">
                                                            755AT.速运事业群华南大区速运深圳区蛇口分部
                                                        </option>
                                                        <option value="P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部">
                                                            P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区前海湾花园速运营业部">
                                                            速运事业群华南大区速运深圳区前海湾花园速运营业部
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区天安速运营业部">
                                                            速运事业群华南大区速运深圳区天安速运营业部
                                                        </option>
                                                        <option value="755KES.商业事业群商业深圳分公司东城国际店">
                                                            755KES.商业事业群商业深圳分公司东城国际店
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区沙河工业区速运营业部">
                                                            速运事业群华南大区速运深圳区沙河工业区速运营业部
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区金地工业区速运营业部">
                                                            速运事业群华南大区速运深圳区金地工业区速运营业部
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区建安大院速运营业部">
                                                            速运事业群华南大区速运深圳区建安大院速运营业部
                                                        </option>
                                                        <option value="商业事业群商业深圳分公司深圳梧桐山店">
                                                            商业事业群商业深圳分公司深圳梧桐山店
                                                        </option>
                                                        <option value="速运事业群华南大区深圳区营运部车辆管理组">
                                                            速运事业群华南大区深圳区营运部车辆管理组
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区兴华工业区速运营业部">
                                                            速运事业群华南大区速运深圳区兴华工业区速运营业部
                                                        </option>
                                                        <option value="755DS.速运事业群华南大区速运深圳区三围速运重货营业部">
                                                            755DS.速运事业群华南大区速运深圳区三围速运重货营业部
                                                        </option>
                                                        <option value="E755SAV.仓配物流事业群.仓配深圳区.观澜速配站.旭玫新村顺丰站">
                                                            E755SAV.仓配物流事业群.仓配深圳区.观澜速配站.旭玫新村顺丰站
                                                        </option>
                                                    </select>
                                                </th>
                                             
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="dataTables_scrollBody" style="overflow-x: hidden; height: 380px; width: 100%;">
                               <table class="table table-sorting table-striped table-hover table-bordered datatable dataTable no-footer" id="datatable-data-export" role="grid" aria-describedby="datatable-data-export_info">
            <tbody>
                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>
                                                <tr role="row" class="odd">
                    <td class="sorting_1 sorting_edit">
                        <a href="#">编辑</a>
                    </td>
                    <td class="sorting_name">
                        <a href="#">成厚权文</a>
                    </td>
                    <td class="sorting_estate">
                        在职      
                    </td>
                    <td class="unit">
                        国通物业管理有限公司国通大厦分公司
                    </td>
                    <td class="firm">
                        汇海运输有限公司福永分公司
                    </td>
                    <td class="section">
                        P755CDA.冷运事业部冷运深圳分公司深圳冷运部深圳清湖食品冷库清湖食品冷库中转配送部
                    </td>
                </tr>

            </tbody>
        </table>
                        
                        </div>
                        <div class="row">
            <div class="col-sm-6">
                <div class="dataTables_info" id="datatable-column-filter_info" role="status" aria-live="polite" style="font-size: 13px;">
                   共7959条记录 1/398页
                </div>
            </div>
            <div class="col-sm-6">
                <div class="dataTables_paginate paging_simple_numbers" id="datatable-column-filter_paginate">
                    <ul class="pagination">
                        <li class="paginate_button previous disabled" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_previous">
                            <a href="#">首页</a>
                        </li>
                         <li class="paginate_button previous disabled" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_previous">
                            <a href="#">上一页</a>
                        </li>
                        <li class="paginate_button active" aria-controls="datatable-column-filter" tabindex="0">
                            <a href="#">1</a>
                        </li>
                        <li class="paginate_button" aria-controls="datatable-column-filter" tabindex="0">
                            <a href="#">2</a>
                        </li>
                        <li class="paginate_button next" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_next">
                            <a href="#">下一页</a>
                        </li>
                        <li class="paginate_button next" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_next">
                            <a href="#">末页</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div style="float: right;">
        <label class="control-inline fancy-checkbox la_query">
                                                            <input type="checkbox" name="checkbox" data-parsley-multiple="checkbox" data-parsley-id="2927">
                                                            <span>不包含离职员工</span>
                                                        </label>
                
                                        <input type="submit" class="btn btn-primary fa fa-floppy-o" value="保存为EXCEL"> 
             </div>                       
                    </div>
                </div>
            </div>
        </div> -->
	<!-- 框架div版本2 end -->


<!-- 结束 div -->
<!-- </div>
</div>
</div> -->
<!-- 结束 div  end-->

<div class="widget widget-table">
<div class="row">
<div class="col-md-12 ">

    <div class="bs-example" data-example-id="panel-without-body-with-table">
    <div class="widget-header">
                                        <h3><i class="fa fa-table"></i>查询结果</h3>
                                    </div>
            
    <div class="col-md-12">
    <!-- bootstarp表格 -->
<div class="bs-example Inquire" data-example-id="simple-form-inline">
<form method="GET" class="form" id="wSForm" action="http://192.168.0.8/workerInfo/wInfo.php">
    <div class="form-inline form_Inquire">
      <div class="form-group ">
      
        <label for="exampleInputName2">选择查询条件</label>
        <select name="featured-datatable_length" aria-controls="featured-datatable" class="form-control input-sm form_select">
                                                        <option value="name">姓名</option>
<option value="uID">员工编号</option>
<option value="pID">身份证</option>
<option value="sID">社保号</option>
<option value="bID">工资账号</option>
<option value="dID">档案编号</option>
<option value="spID">特定编号</option>
                                                    </select>
                                                     
      </div>
      <div style="float: right;">
      <div class="form-group">
      <fieldset>
        <input type="text" class="form-control" id="exampleInputName2" placeholder="">
      </div>
        <div class="form-group">
            <div class="checkbox">
        <label>
          <input type="checkbox">不包含离职员工
        </label>
      </div>
      </div>
        </div>
    </div>
    <div class="form-inline" style="clear: both;">
      <div class="form-group ">
        <label for="exampleInputName2">客户经理</label>
        <select name="featured-datatable_length" aria-controls="featured-datatable" class="form-control input-sm form_select">
        
            <option value="">--请选择--</option>

                             
                            <option value="2">周育鑫</option>
  
                            <option value="4">superAdmin</option>
  
                            <option value="118">何剑鸿</option>
  
                            <option value="7">陈健恒</option>
  
                            <option value="12">王璇</option>
  
                            <option value="27">方晓文</option>
  
                            <option value="55">陈丽娜</option>
  
                            <option value="99">汪慧研</option>
  
                            <option value="76">冷佳龙</option>
  
                            <option value="85">肖辉雄</option>
  
                            <option value="93">吴廷锴</option>
  
                            <option value="103">刘炽东</option>
  
                            <option value="120">曾康</option>
  
                            <option value="125">张宝灵</option>
  
                            <option value="127">廖思琪</option>
        </select>
      </div>
     
         <div class="form-group">
        <label for="exampleInputName2">单位</label>
 <select name="featured-datatable_length " aria-controls="featured-datatable" class="form-control input-sm form_select">
                            <option value="">---------------请选择------------</option>

                             
                                                                                 
                                                                                 
                                                                            
                                                                        <option value="2202.088">中国移动通信集团广东有限公司深圳分公司</option>

                                                                        <option value="100019">中建一局华北分公司</option>


                                
                                                                          
                                                    </select> 
        
      </div>

               <div class="form-group">
        <label for="exampleInputName2">合并类别</label>
 <select name="featured-datatable_length " aria-controls="featured-datatable" class="form-control input-sm form_select">
                            <option value="">---------------请选择------------</option>
                                 <option value="1">中国邮政集团公司深圳市分公司</option>
<option value="2">速递物流</option>
<option value="3">顺丰速递</option>
<option value="4">邮政承揽</option>


                                
                                                                          
                                                    </select> 
        
      </div>
      <div class="form-group">
          <button class="btn  btn-primary btn-sm">查询</button>
      </div>
      </form>
    </div>
    </fieldset>
  </div>
    <div class="panel panel-default panel_font" >
    
      
 
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <td class="ta_line">操作</td>
            <td class="ta_line">姓名</td>
            <th> 
             <select name="featured-datatable_length" aria-controls="featured-datatable" class="form-control input-sm form_select">
                                                        <option value="">
                                                            状态
                                                        </option>
                                                        <option value="1">
                                                            离职
                                                        </option>
                                                        <option value="2">
                                                            在职
                                                        </option>
                                                    </select>
                                                    </th>
            
            <th>
                <select name="featured-datatable_length " aria-controls="featured-datatable" class="form-control input-sm form_select">
                            <option value="">单位</option>

                             
                                                                                 
                                                                                 
                                                                            
                                                                        <option value="2202.088">中国移动通信集团广东有限公司深圳分公司</option>

                                                                        <option value="100019">中建一局华北分公司</option>

                                                                        <option value="2202.056">中建一局集团建设发展有限公司</option>

                                                              

                                
                                                                          
                                                    </select>
                                                    </th>
                                                    <th>
                                                        <select name="" class="form-control input-sm select_con form_select">
                                                        <option value="">
                                                            分公司
                                                        </option>
                                                        <option value="notNull">
                                                            非空白
                                                        </option>
                                                        <option value="宝安分公司">
                                                            宝安分公司
                                                        </option>
                                                        <option value="派遣">
                                                            派遣
                                                        </option>
                                                        <option value="劳务承揽">
                                                            劳务承揽
                                                        </option>
                                                        <option value="深航中心">
                                                            深航中心
                                                        </option>
                                                        <option value="包裹业务局">
                                                            包裹业务局
                                                        </option>
                                                        <option value="包裹局">
                                                            包裹局
                                                        </option>
                                                        <option value="南山分公司">
                                                            南山分公司
                                                        </option>
                                                        <option value="五和中转场">
                                                            五和中转场
                                                        </option>
                                                        <option value="国际速递分公司">
                                                            国际速递分公司
                                                        </option>
                                                        <option value="福田分公司">
                                                            福田分公司
                                                        </option>
                                                        <option value="机关">
                                                            机关
                                                        </option>
                                                        <option value="电商物流分公司">
                                                            电商物流分公司
                                                        </option>
                                                        <option value="龙岗分公司">
                                                            龙岗分公司
                                                        </option>
                                                        <option value="客服中心">
                                                            客服中心
                                                        </option>
                                                        <option value="华强北分公司">
                                                            华强北分公司
                                                        </option>
                                                        <option value="同城分公司">
                                                            同城分公司
                                                        </option>
                                                        <option value="罗湖分公司">
                                                            罗湖分公司
                                                        </option>
                                                        <option value="光明分公司">
                                                            光明分公司
                                                        </option>
                                                        <option value="速递公司">
                                                            速递公司
                                                        </option>
                                                        <option value="技术维护中心">
                                                            技术维护中心
                                                        </option>
                                                        <option value="八卦岭中心公司">
                                                            八卦岭中心公司
                                                        </option>
                                                        <option value="顺丰速运">
                                                            顺丰速运
                                                        </option>
                                                        <option value="汇海运输">
                                                            汇海运输
                                                        </option>
                                                        <option value="广州">
                                                            广州
                                                        </option>
                                                        <option value="广州航空组">
                                                            广州航空组
                                                        </option>
                                                        <option value="深圳">
                                                            深圳
                                                        </option>
                                                        <option value="汇海">
                                                            汇海
                                                        </option>
                                                        <option value="顺丰商业">
                                                            顺丰商业
                                                        </option>
                                                        <option value="汇海运输有限公司福永分公司">
                                                            汇海运输有限公司福永分公司
                                                        </option>
                                                        <option value="仓配二三线">
                                                            仓配二三线
                                                        </option>
                                                        <option value="755EN.速运深圳区.运输分部">
                                                            755EN.速运深圳区.运输分部
                                                        </option>
                                                        <option value="速递投递公司">
                                                            速递投递公司
                                                        </option>
                                                        <option value="仓配一线">
                                                            仓配一线
                                                        </option>
                                                        <option value="深圳市顺丰商业有限公司">
                                                            深圳市顺丰商业有限公司
                                                        </option>
                                                        <option value="华强">
                                                            华强
                                                        </option>
                                                        <option value="五和">
                                                            五和
                                                        </option>
                                                        <option value="同城公司">
                                                            同城公司
                                                        </option>
                                                        <option value="金融业务局">
                                                            金融业务局
                                                        </option>
                                                        <option value="福田分局">
                                                            福田分局
                                                        </option>
                                                        <option value="邮政局机关">
                                                            邮政局机关
                                                        </option>
                                                        <option value="罗湖分局">
                                                            罗湖分局
                                                        </option>
                                                    </select>
                                                    </th>
                                                    <th>
                                                         <select name="" class="form-control input-sm select_section">
                                                        <option value="">
                                                            部门
                                                        </option>
                                                        <option value="notNull">
                                                            非空白
                                                        </option>
                                                        <option value="755LQL.速运事业群.华南大区.速运深圳区.布吉分部.民乐站">
                                                            755LQL.速运事业群.华南大区.速运深圳区.布吉分部.民乐站
                                                        </option>
                                                        <option value="E755SAB.仓配物流事业群.仓配深圳区.民治速配站.皓月花园顺丰站">
                                                            E755SAB.仓配物流事业群.仓配深圳区.民治速配站.皓月花园顺丰站
                                                        </option>
                                                        <option value="755BKGS.商业事业群.商业深圳分公司.宝安中心区域.深圳金鼎店">
                                                            755BKGS.商业事业群.商业深圳分公司.宝安中心区域.深圳金鼎店
                                                        </option>
                                                        <option value="顺丰店">
                                                            顺丰店
                                                        </option>
                                                        <option value="755BEBS.商业事业群.商业深圳分公司.白石龙区域.世纪春城店">
                                                            755BEBS.商业事业群.商业深圳分公司.白石龙区域.世纪春城店
                                                        </option>
                                                        <option value="755DK.速运事业群.华南大区.速运深圳区.坑梓分部">
                                                            755DK.速运事业群.华南大区.速运深圳区.坑梓分部
                                                        </option>
                                                        <option value="755CE.速运事业群.华南大区.速运深圳区.龙岭分部">
                                                            755CE.速运事业群.华南大区.速运深圳区.龙岭分部
                                                        </option>
                                                        <option value="E755SMM.仓配物流事业群.仓配深圳区.深圳顺大速配站.华侨村顺丰站">
                                                            E755SMM.仓配物流事业群.仓配深圳区.深圳顺大速配站.华侨村顺丰站
                                                        </option>
                                                        <option value="755Y.深圳区客户部">
                                                            755Y.深圳区客户部
                                                        </option>
                                                        <option value="755Y.速运事业群.华南大区.速运深圳区.营运部.车辆管理组">
                                                            755Y.速运事业群.华南大区.速运深圳区.营运部.车辆管理组
                                                        </option>
                                                        <option value="755Y.速运事业群.华南大区.速运深圳区.客服部.理赔投诉组">
                                                            755Y.速运事业群.华南大区.速运深圳区.客服部.理赔投诉组
                                                        </option>
                                                        <option value="755WD.营运中心.华南分拨区.深圳彩田中转场">
                                                            755WD.营运中心.华南分拨区.深圳彩田中转场
                                                        </option>
                                                        <option value="755W.速运事业群.华南大区.速运深圳区.运营规划部.黄田中转场">
                                                            755W.速运事业群.华南大区.速运深圳区.运营规划部.黄田中转场
                                                        </option>
                                                        <option value="755WF.速运事业群.华南大区.速运深圳区.运营规划部.五和中转场">
                                                            755WF.速运事业群.华南大区.速运深圳区.运营规划部.五和中转场
                                                        </option>
                                                        <option value="755U.速运事业群.华南大区.速运深圳区.华强分部">
                                                            755U.速运事业群.华南大区.速运深圳区.华强分部
                                                        </option>
                                                        <option value="755WA.深圳区坂田中转场">
                                                            755WA.深圳区坂田中转场
                                                        </option>
                                                        <option value="E755Y.仓配物流事业群.仓配深圳区.客户部.客户服务组">
                                                            E755Y.仓配物流事业群.仓配深圳区.客户部.客户服务组
                                                        </option>
                                                        <option value="755DS.速运事业群.华南大区.速运深圳区.深圳重货管理部.宝安重货营业点">
                                                            755DS.速运事业群.华南大区.速运深圳区.深圳重货管理部.宝安重货营业点
                                                        </option>
                                                        <option value="755WD.速运事业群.华南大区.速运深圳区.运营规划部.彩田中转场">
                                                            755WD.速运事业群.华南大区.速运深圳区.运营规划部.彩田中转场
                                                        </option>
                                                        <option value="755AB.速运事业群.华南大区.速运深圳区.大芬分部">
                                                            755AB.速运事业群.华南大区.速运深圳区.大芬分部
                                                        </option>
                                                        <option value="755AAFS.商业事业群.商业深圳分公司.市民中心区域.广厦店">
                                                            755AAFS.商业事业群.商业深圳分公司.市民中心区域.广厦店
                                                        </option>
                                                        <option value="755AM.速运事业群.华南大区.速运深圳区.皇岗分部">
                                                            755AM.速运事业群.华南大区.速运深圳区.皇岗分部
                                                        </option>
                                                        <option value="755AV.速运事业群.华南大区.速运深圳区.龙东分部">
                                                            755AV.速运事业群.华南大区.速运深圳区.龙东分部
                                                        </option>
                                                        <option value="755P.速运事业群.华南大区.速运深圳区.观澜分部">
                                                            755P.速运事业群.华南大区.速运深圳区.观澜分部
                                                        </option>
                                                        <option value="755BN.速运事业群.华南大区.速运深圳区.上塘分部">
                                                            755BN.速运事业群.华南大区.速运深圳区.上塘分部
                                                        </option>
                                                        <option value="755HJL.速运事业群.华南大区.速运深圳区.龙岭分部.龙岭山庄站">
                                                            755HJL.速运事业群.华南大区.速运深圳区.龙岭分部.龙岭山庄站
                                                        </option>
                                                        <option value="755E.速运事业群.华南大区.速运深圳区.龙岗分部">
                                                            755E.速运事业群.华南大区.速运深圳区.龙岗分部
                                                        </option>
                                                        <option value="755AE.速运事业群.华南大区.速运深圳区.坪地分部">
                                                            755AE.速运事业群.华南大区.速运深圳区.坪地分部
                                                        </option>
                                                        <option value="755EF.速运事业群.华南大区.速运深圳区.深圳重货管理部.大芬重货营业点">
                                                            755EF.速运事业群.华南大区.速运深圳区.深圳重货管理部.大芬重货营业点
                                                        </option>
                                                        <option value="755FTL.速运事业群.华南大区.速运深圳区.民治分部.深圳金龙站">
                                                            755FTL.速运事业群.华南大区.速运深圳区.民治分部.深圳金龙站
                                                        </option>
                                                        <option value="755AVES.商业事业群.商业深圳分公司.双龙坪坑区域.风临四季店">
                                                            755AVES.商业事业群.商业深圳分公司.双龙坪坑区域.风临四季店
                                                        </option>
                                                        <option value="755A.速运事业群.华南大区.速运深圳区.福田分部">
                                                            755A.速运事业群.华南大区.速运深圳区.福田分部
                                                        </option>
                                                        <option value="755Q.速运事业群.华南大区.速运深圳区.田贝分部">
                                                            755Q.速运事业群.华南大区.速运深圳区.田贝分部
                                                        </option>
                                                        <option value="755ED.速运事业群.华南大区.速运深圳区.深圳重货管理部.坪山重货营业点">
                                                            755ED.速运事业群.华南大区.速运深圳区.深圳重货管理部.坪山重货营业点
                                                        </option>
                                                        <option value="755BE.速运事业群.华南大区.速运深圳区.民治分部">
                                                            755BE.速运事业群.华南大区.速运深圳区.民治分部
                                                        </option>
                                                        <option value="E755EB.仓配物流事业群.仓配深圳区.机场速配营业部">
                                                            E755EB.仓配物流事业群.仓配深圳区.机场速配营业部
                                                        </option>
                                                        <option value="755CK.速运事业群.华南大区.速运深圳区.布心分部">
                                                            755CK.速运事业群.华南大区.速运深圳区.布心分部
                                                        </option>
                                                        <option value="755CF.速运事业群.华南大区.速运深圳区.龙西分部">
                                                            755CF.速运事业群.华南大区.速运深圳区.龙西分部
                                                        </option>
                                                        <option value="755DV.速运事业群.华南大区.速运深圳区.深圳重货管理部.龙华重货营业点">
                                                            755DV.速运事业群.华南大区.速运深圳区.深圳重货管理部.龙华重货营业点
                                                        </option>
                                                        <option value="755AQ.速运事业群华南大区速运深圳区吉厦村速运营业部">
                                                            755AQ.速运事业群华南大区速运深圳区吉厦村速运营业部
                                                        </option>
                                                        <option value="速运事业群华南大区速运深圳区营运部车辆管理组">
                                                            速运事业群华南大区速运深圳区营运部车辆管理组
                                                        </option>
                                                        <option value="755WE.营运中心.华南分拨区.深圳九围陆运重货中转场">
                                                            755WE.营运中心.华南分拨区.深圳九围陆运重货中转场
                                                        </option>
                                                        <option value="755BP.速运事业群.华南大区.速运深圳区.福民分部">
                                                            755BP.速运事业群.华南大区.速运深圳区.福民分部
                                                        </option>
                                                        <option value="755LEL.速运事业群.华南大区.速运深圳区.民治分部.横岭四区站">
                                                            755LEL.速运事业群.华南大区.速运深圳区.民治分部.横岭四区站
                                                        </option>
                                                        <option value="755E.深圳区龙岗分部">
                                                            755E.深圳区龙岗分部
                                                        </option>
                                                        <option value="755AD.速运事业群.华南大区.速运深圳区.平湖分部">
                                                            755AD.速运事业群.华南大区.速运深圳区.平湖分部
                                                        </option>
                                                        <option value="755CH.速运事业群.华南大区.速运深圳区.九围分部">
                                                            755CH.速运事业群.华南大区.速运深圳区.九围分部
                                                        </option>
                                                        <option value="755G.速运事业群.华南大区.速运深圳区.南山分部">
                                                            755G.速运事业群.华南大区.速运深圳区.南山分部
                                                        </option>
                                                        <option value="755BQS.商业事业群.商业深圳分公司.万科城区域.上品雅园店">
                                                            755BQS.商业事业群.商业深圳分公司.万科城区域.上品雅园店
                                                        </option>
                                                        <option value="755AJ.速运事业群.华南大区.速运深圳区.龙华分部">
                                                            755AJ.速运事业群.华南大区.速运深圳区.龙华分部
                                                        </option>
                                                        <option value="E755SCP.仓配物流事业群.仓配深圳区.坪山速配站.土洋社区顺丰站">
                                                            E755SCP.仓配物流事业群.仓配深圳区.坪山速配站.土洋社区顺丰站
                                                        </option>
                                                        <option value="755JPL.速运事业群.华南大区.速运深圳区.上塘分部.瓦窑排站">
                                                            755JPL.速运事业群.华南大区.速运深圳区.上塘分部.瓦窑排站
                                                        </option>
                                                        <option value="755AS.速运事业群华南大区速运深圳区南头分部">
                                                            755AS.速运事业群华南大区速运深圳区南头分部
                                                        </option>
                                                        <option value="755DF.速运事业群.华南大区.速运深圳区.清湖分部">
                                                            755DF.速运事业群.华南大区.速运深圳区.清湖分部
                                                        </option>
                                                        <option value="755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点">
                                                            755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点
                                                        </option>
                                                        <option value="E755SJE.仓配物流事业群.仓配深圳区.龙华速配站.商业街顺丰站">
                                                            E755SJE.仓配物流事业群.仓配深圳区.龙华速配站.商业街顺丰站
                                                        </option>
                                                        <option value="755B.速运事业群.华南大区.速运深圳区.布吉分部">
                                                            755B.速运事业群.华南大区.速运深圳区.布吉分部
                                                        </option>
                                                        <option value="755EUL.速运事业群.华南大区.速运深圳区.民治分部.水尾新村站">
                                                            755EUL.速运事业群.华南大区.速运深圳区.民治分部.水尾新村站
                                                        </option>
                                                        <option value="755P.深圳区观澜分部">
                                                            755P.深圳区观澜分部
                                                        </option>
                                                        <option value="755DKAS.商业事业群.商业深圳分公司.双龙坪坑区域.豪方菁园店">
                                                            755DKAS.商业事业群.商业深圳分公司.双龙坪坑区域.豪方菁园店
                                                        </option>
                                                        <option value="E755Y.仓配物流事业群.仓配深圳区.客户部.客户运维组">
                                                            E755Y.仓配物流事业群.仓配深圳区.客户部.客户运维组
                                                        </option>
                                                        <option value="755AQ.速运事业群.华南大区.速运深圳区.南湾分部">
                                                            755AQ.速运事业群.华南大区.速运深圳区.南湾分部
                                                        </option>
                                                        <option value="E755SCN.仓配物流事业群.仓配深圳区.布心速配站.吉星花园顺丰站">
                                                            E755SCN.仓配物流事业群.仓配深圳区.布心速配站.吉星花园顺丰站
                                                        </option>
                                                        <option value="755K.速运事业群.华南大区.速运深圳区.坪山分部">
                                                            755K.速运事业群.华南大区.速运深圳区.坪山分部
                                                        </option>
                                                        <option value="755BDL.速运事业群.华南大区.速运深圳区.荷坳分部.龙苑新村站">
                                                            755BDL.速运事业群.华南大区.速运深圳区.荷坳分部.龙苑新村站
                                                        </option>
                                                        <option value="755WD.深圳区彩田中转场">
                                                            755WD.深圳区彩田中转场
                                                        </option>
                                                        <option value="755KVL.速运事业群.华南大区.速运深圳区.上塘分部.国鸿站">
                                                            755KVL.速运事业群.华南大区.速运深圳区.上塘分部.国鸿站
                                                        </option>
                                                        <option value="755BD.速运事业群.华南大区.速运深圳区.荷坳分部">
                                                            755BD.速运事业群.华南大区.速运深圳区.荷坳分部
                                                        </option>
                                                        <option value="E755SCE.仓配物流事业群.仓配深圳区.龙华速配站.华侨新村顺丰站">
                                                            E755SCE.仓配物流事业群.仓配深圳区.龙华速配站.华侨新村顺丰站
                                                        </option>
                                                        <option value="755KJL.速运事业群.华南大区.速运深圳区.上塘分部.盛世江南站">
                                                            755KJL.速运事业群.华南大区.速运深圳区.上塘分部.盛世江南站
                                                        </option>
                                                        <option value="755BL.速运事业群.华南大区.速运深圳区.华为分部">
                                                            755BL.速运事业群.华南大区.速运深圳区.华为分部
                                                        </option>
                                                        <option value="755DAAS.商业事业群.商业深圳分公司.东门商圈区域.可园一期店">
                                                            755DAAS.商业事业群.商业深圳分公司.东门商圈区域.可园一期店
                                                        </option>
                                                        <option value="755M.速运事业群.华南大区.速运深圳区.盐田分部">
                                                            755M.速运事业群.华南大区.速运深圳区.盐田分部
                                                        </option>
                                                        <option value="755BL.深圳区华为分部">
                                                            755BL.深圳区华为分部
                                                        </option>
                                                        <option value="755DA.速运事业群.华南大区.速运深圳区.罗岗分部">
                                                            755DA.速运事业群.华南大区.速运深圳区.罗岗分部
                                                        </option>
                                                        <option value="755CEES.商业事业群.商业深圳分公司.布吉关外区域.长龙店">
                                                            755CEES.商业事业群.商业深圳分公司.布吉关外区域.长龙店
                                                        </option>
                                                        <option value="E755SFS.仓配物流事业群.仓配深圳区.龙岭速配站.深圳下水径顺丰站">
                                                            E755SFS.仓配物流事业群.仓配深圳区.龙岭速配站.深圳下水径顺丰站
                                                        </option>
                                                        <option value="755BNL.速运事业群.华南大区.速运深圳区.布吉分部.大发埔村站">
                                                            755BNL.速运事业群.华南大区.速运深圳区.布吉分部.大发埔村站
                                                        </option>
                                                        <option value="755WF.营运中心.华南分拨区.深圳五和中转场">
                                                            755WF.营运中心.华南分拨区.深圳五和中转场
                                                        </option>
                                                        <option value="755AJBS.商业事业群.商业深圳分公司.龙华观平区域.福轩新村店">
                                                            755AJBS.商业事业群.商业深圳分公司.龙华观平区域.福轩新村店
                                                        </option>
                                                        <option value="E755SKA.仓配物流事业群.仓配深圳区.民治速配站.龙塘新村顺丰站">
                                                            E755SKA.仓配物流事业群.仓配深圳区.民治速配站.龙塘新村顺丰站
                                                        </option>
                                                        <option value="E755SFM.仓配物流事业群.仓配深圳区.民治速配站.深圳松仔园顺丰站">
                                                            E755SFM.仓配物流事业群.仓配深圳区.民治速配站.深圳松仔园顺丰站
                                                        </option>
                                                        <option value="E755SFC.仓配物流事业群.仓配深圳区.龙华速配站.谭罗新村顺丰站">
                                                            E755SFC.仓配物流事业群.仓配深圳区.龙华速配站.谭罗新村顺丰站
                                                        </option>
                                                        <option value="E755SKS.仓配物流事业群.仓配深圳区.深圳顺大速配站.和平小区顺丰站">
                                                            E755SKS.仓配物流事业群.仓配深圳区.深圳顺大速配站.和平小区顺丰站
                                                        </option>
                                                        <option value="755AK.速运事业群.华南大区.速运深圳区.沙井分部">
                                                            755AK.速运事业群.华南大区.速运深圳区.沙井分部
                                                        </option>
                                                        <option value="坪山">
                                                            坪山
                                                        </option>
                                                        <option value="755BTL.速运事业群.华南大区.速运深圳区.民治分部.逸秀新村站">
                                                            755BTL.速运事业群.华南大区.速运深圳区.民治分部.逸秀新村站
                                                        </option>
                                                        <option value="755BD.速运事业群华南大区速运深圳区荷坳社区速运营业部">
                                                            755BD.速运事业群华南大区速运深圳区荷坳社区速运营业部
                                                        </option>
                                                        <option value="755JGL.速运事业群.华南大区.速运深圳区.荷坳分部.安良站">
                                                            755JGL.速运事业群.华南大区.速运深圳区.荷坳分部.安良站
                                                        </option>
                                                        <option value="755EA.速运事业群.华南大区.速运深圳区.大浪分部">
                                                            755EA.速运事业群.华南大区.速运深圳区.大浪分部
                                                        </option>
                                                        <option value="755DUL.速运事业群.华南大区.速运深圳区.民治分部.向南新村站">
                                                            755DUL.速运事业群.华南大区.速运深圳区.民治分部.向南新村站
                                                        </option>
                                                        <option value="755GKL.速运事业群.华南大区.速运深圳区.民治分部.深圳横岭五区站">
                                                            755GKL.速运事业群.华南大区.速运深圳区.民治分部.深圳横岭五区站
                                                        </option>
                                                        <option value="坪环街道速运营业部">
                                                            坪环街道速运营业部
                                                        </option>
                                                        <option value="E755SFN.仓配物流事业群.仓配深圳区.龙华速配站.下横朗新村顺丰站">
                                                            E755SFN.仓配物流事业群.仓配深圳区.龙华速配站.下横朗新村顺丰站
                                                        </option>
                                                        <option value="区部">
                                                            区部
                                                        </option>
                                                        <option value="龙岭">
                                                            龙岭
                                                        </option>
                                                        <option value="E755SET.仓配物流事业群.仓配深圳区.深圳顺大速配站.玉翠花园顺丰站">
                                                            E755SET.仓配物流事业群.仓配深圳区.深圳顺大速配站.玉翠花园顺丰站
                                                        </option>
                                                        <option value="E755BJ.仓配物流事业群.仓配深圳区.布吉速配营业部">
                                                            E755BJ.仓配物流事业群.仓配深圳区.布吉速配营业部
                                                        </option>
                                                        <option value="E755DCB.仓配物流事业群.仓配深圳区.深圳转运仓储配送仓库">
                                                            E755DCB.仓配物流事业群.仓配深圳区.深圳转运仓储配送仓库
                                                        </option>
                                                        <option value="755AVCS.商业事业群.商业深圳分公司.双龙坪坑区域.峦山谷店">
                                                            755AVCS.商业事业群.商业深圳分公司.双龙坪坑区域.峦山谷店
                                                        </option>
                                                        <option value="755EE.速运事业群.华南大区.速运深圳区.深圳重货管理部.福田重货营业点">
                                                            755EE.速运事业群.华南大区.速运深圳区.深圳重货管理部.福田重货营业点
                                                        </option>
                                                        <option value="755BEES.商业事业群.商业深圳分公司.白石龙区域.鑫茂花园店">
                                                            755BEES.商业事业群.商业深圳分公司.白石龙区域.鑫茂花园店
                                                        </option>
                                                        <option value="E755AB.仓配物流事业群.仓配深圳区.深圳跨境速配站">
                                                            E755AB.仓配物流事业群.仓配深圳区.深圳跨境速配站
                                                        </option>
                                                        <option value="E755AG.仓配物流事业群.仓配深圳区.西乡速配站">
                                                            E755AG.仓配物流事业群.仓配深圳区.西乡速配站
                                                        </option>
                                                        <option value="E755J.仓配物流事业群.仓配深圳区.横岗速配站">
                                                            E755J.仓配物流事业群.仓配深圳区.横岗速配站
                                                        </option>
                                                        <option value="E755SJM.仓配物流事业群.仓配深圳区.民治速配站.南景新村顺丰站">
                                                            E755SJM.仓配物流事业群.仓配深圳区.民治速配站.南景新村顺丰站
                                                        </option>
                                                        <option value="皇岗">
                                                            皇岗
                                                        </option>
                                                        <option value="西乡中心公司">
                                                            西乡中心公司
                                                        </option>
                                                        <option value="755GGL.速运事业群.华南大区.速运深圳区.民治分部.深圳澳门新村站">
                                                            755GGL.速运事业群.华南大区.速运深圳区.民治分部.深圳澳门新村站
                                                        </option>
                                                        <option value="755BF.速运事业群.华南大区.速运深圳区.新洲分部">
                                                            755BF.速运事业群.华南大区.速运深圳区.新洲分部
                                                        </option>
                                                        <option value="755BGS.商业事业群.商业深圳分公司.万科城区域.深圳金洲店">
                                                            755BGS.商业事业群.商业深圳分公司.万科城区域.深圳金洲店
                                                        </option>
                                                        <option value="755LPL.速运事业群.华南大区.速运深圳区.罗岗分部.可园站">
                                                            755LPL.速运事业群.华南大区.速运深圳区.罗岗分部.可园站
                                                        </option>
                                                        <option value="755EML.速运事业群.华南大区.速运深圳区.大浪分部.赖屋山站">
                                                            755EML.速运事业群.华南大区.速运深圳区.大浪分部.赖屋山站
                                                        </option>
                                                        <option value="E755C.仓配物流事业群.仓配深圳区.顺大速配营业部">
                                                            E755C.仓配物流事业群.仓配深圳区.顺大速配营业部
                                                        </option>
                                                        <option value="755EH.速运事业群.华南大区.速运深圳区.深圳重货管理部.罗湖重货营业点">
                                                            755EH.速运事业群.华南大区.速运深圳区.深圳重货管理部.罗湖重货营业点
                                                        </option>
                                                        <option value="南湾">
                                                            南湾
                                                        </option>
                                                        <option value="755BA.速运事业群.华南大区.速运深圳区.华富分部">
                                                            755BA.速运事业群.华南大区.速运深圳区.华富分部
                                                        </option>
                                                        <option value="755DFBS.商业事业群.商业深圳分公司.龙华观平区域.深圳新碑村店">
                                                            755DFBS.商业事业群.商业深圳分公司.龙华观平区域.深圳新碑村店
                                                        </option>
                                                        <option value="侨城">
                                                            侨城
                                                        </option>
                                                        <option value="755DFGS.商业事业群.商业深圳分公司.龙华观平区域.上早村店">
                                                            755DFGS.商业事业群.商业深圳分公司.龙华观平区域.上早村店
                                                        </option>
                                                        <option value="彩田">
                                                            彩田
                                                        </option>
                                                        <option value="755CB.速运事业群.华南大区.速运深圳区.福安分部">
                                                            755CB.速运事业群.华南大区.速运深圳区.福安分部
                                                        </option>
                                                        <option value="755CA.速运事业群.华南大区.速运深圳区.景田分部">
                                                            755CA.速运事业群.华南大区.速运深圳区.景田分部
                                                        </option>
                                                        <option value="755AR.速运事业群.华南大区.速运深圳区.侨城分部">
                                                            755AR.速运事业群.华南大区.速运深圳区.侨城分部
                                                        </option>
                                                        <option value="755JDU.速运事业群.华南大区.速运深圳区.深圳重货管理部.华强重货营业点">
                                                            755JDU.速运事业群.华南大区.速运深圳区.深圳重货管理部.华强重货营业点
                                                        </option>
                                                        <option value="755Y.速运事业群.华南大区.速运深圳区.市场销售部.销售管理组">
                                                            755Y.速运事业群.华南大区.速运深圳区.市场销售部.销售管理组
                                                        </option>
                                                        <option value="755BLL.速运事业群.华南大区.速运深圳区.景田分部.布尾村站">
                                                            755BLL.速运事业群.华南大区.速运深圳区.景田分部.布尾村站
                                                        </option>
                                                        <option value="E755U.仓配物流事业群.仓配深圳区.华强速配站">
                                                            E755U.仓配物流事业群.仓配深圳区.华强速配站
                                                        </option>
                                                        <option value="755EP.速运事业群.华南大区.速运深圳区.福田分部.广华点部">
                                                            755EP.速运事业群.华南大区.速运深圳区.福田分部.广华点部
                                                        </option>
                                                        <option value="E755SGF.仓配物流事业群.仓配深圳区.梅林速配站.深圳特发小区顺丰站">
                                                            E755SGF.仓配物流事业群.仓配深圳区.梅林速配站.深圳特发小区顺丰站
                                                        </option>
                                                        <option value="755DN.速运事业群.华南大区.速运深圳区.深圳重货管理部.南山重货营业点">
                                                            755DN.速运事业群.华南大区.速运深圳区.深圳重货管理部.南山重货营业点
                                                        </option>
                                                        <option value="755AA.速运事业群.华南大区.速运深圳区.梅林分部">
                                                            755AA.速运事业群.华南大区.速运深圳区.梅林分部
                                                        </option>
                                                        <option value="755FQL.速运事业群.华南大区.速运深圳区.梅林分部.深圳莲花北村站">
                                                            755FQL.速运事业群.华南大区.速运深圳区.梅林分部.深圳莲花北村站
                                                        </option>
                                                        <option value="E755SME.仓配物流事业群.仓配深圳区.福田速配站.上沙顺丰站">
                                                            E755SME.仓配物流事业群.仓配深圳区.福田速配站.上沙顺丰站
                                                        </option>
                                                        <option value="E755AA.仓配物流事业群.仓配深圳区.梅林速配站">
                                                            E755AA.仓配物流事业群.仓配深圳区.梅林速配站
                                                        </option>
                                                        <option value="755EVL.速运事业群.华南大区.速运深圳区.福安分部.田面新村站">
                                                            755EVL.速运事业群.华南大区.速运深圳区.福安分部.田面新村站
                                                        </option>
                                                        <option value="E755A.仓配物流事业群.仓配深圳区.福田速配站">
                                                            E755A.仓配物流事业群.仓配深圳区.福田速配站
                                                        </option>
                                                        <option value="755DG.速运事业群.华南大区.速运深圳区.前海分部">
                                                            755DG.速运事业群.华南大区.速运深圳区.前海分部
                                                        </option>
                                                        <option value="755AABS.商业事业群.商业深圳分公司.市民中心区域.围面村店">
                                                            755AABS.商业事业群.商业深圳分公司.市民中心区域.围面村店
                                                        </option>
                                                        <option value="E755AM.仓配物流事业群.仓配深圳区.皇岗速配站">
                                                            E755AM.仓配物流事业群.仓配深圳区.皇岗速配站
                                                        </option>
                                                        <option value="755KNL.速运事业群.华南大区.速运深圳区.新洲分部.桂花苑站">
                                                            755KNL.速运事业群.华南大区.速运深圳区.新洲分部.桂花苑站
                                                        </option>
                                                        <option value="755DGAS.商业事业群.商业深圳分公司.依云伴山店">
                                                            755DGAS.商业事业群.商业深圳分公司.依云伴山店
                                                        </option>
                                                        <option value="755UBS.商业事业群.商业深圳分公司.市民中心区域.红荔村店">
                                                            755UBS.商业事业群.商业深圳分公司.市民中心区域.红荔村店
                                                        </option>
                                                        <option value="755AAES.商业事业群.商业深圳分公司.梅林路店">
                                                            755AAES.商业事业群.商业深圳分公司.梅林路店
                                                        </option>
                                                        <option value="755GAS.商业事业群.商业深圳分公司.缘来居店">
                                                            755GAS.商业事业群.商业深圳分公司.缘来居店
                                                        </option>
                                                        <option value="755AP.速运事业群.华南大区.速运深圳区.西丽分部">
                                                            755AP.速运事业群.华南大区.速运深圳区.西丽分部
                                                        </option>
                                                        <option value="755EN.速运事业群.华南大区.速运深圳区.运输分部">
                                                            755EN.速运事业群.华南大区.速运深圳区.运输分部
                                                        </option>
                                                        <option value="755TFS.商业事业群.商业深圳分公司.南油大厦区域.南园店">
                                                            755TFS.商业事业群.商业深圳分公司.南油大厦区域.南园店
                                                        </option>
                                                        <option value="755ASGS.商业事业群.商业深圳分公司.西丽职院区域.星海名城店">
                                                            755ASGS.商业事业群.商业深圳分公司.西丽职院区域.星海名城店
                                                        </option>
                                                        <option value="755APBS.商业事业群.商业深圳分公司.西丽职院区域.德意名居店">
                                                            755APBS.商业事业群.商业深圳分公司.西丽职院区域.德意名居店
                                                        </option>
                                                        <option value="755JEN.速运事业群.华南大区.速运深圳区.深圳重货管理部.西丽重货营业点">
                                                            755JEN.速运事业群.华南大区.速运深圳区.深圳重货管理部.西丽重货营业点
                                                        </option>
                                                        <option value="755DL.速运事业群.华南大区.速运深圳区.南油分部.后海点部">
                                                            755DL.速运事业群.华南大区.速运深圳区.南油分部.后海点部
                                                        </option>
                                                        <option value="755DQ.速运事业群.华南大区.速运深圳区.朗山分部">
                                                            755DQ.速运事业群.华南大区.速运深圳区.朗山分部
                                                        </option>
                                                        <option value="755APCS.商业事业群.商业深圳分公司.西丽职院区域.西湖林语店">
                                                            755APCS.商业事业群.商业深圳分公司.西丽职院区域.西湖林语店
                                                        </option>
                                                        <option value="755W.营运中心.华南分拨区.深圳黄田中转场">
                                                            755W.营运中心.华南分拨区.深圳黄田中转场
                                                        </option>
                                                        <option value="755AT.速运事业群.华南大区.速运深圳区.蛇口分部">
                                                            755AT.速运事业群.华南大区.速运深圳区.蛇口分部
                                                        </option>
                                                        <option value="755T.速运事业群.华南大区.速运深圳区.南油分部">
                                                            755T.速运事业群.华南大区.速运深圳区.南油分部
                                                        </option>
                                                        <option value="755AS.速运事业群.华南大区.速运深圳区.南头分部">
                                                            755AS.速运事业群.华南大区.速运深圳区.南头分部
                                                        </option>
                                                        <option value="755CQ.速运事业群.华南大区.速运深圳区.福星分部">
                                                            755CQ.速运事业群.华南大区.速运深圳区.福星分部
                                                        </option>
                                                        <option value="755LBL.速运事业群.华南大区.速运深圳区.南头分部.大新站">
                                                            755LBL.速运事业群.华南大区.速运深圳区.南头分部.大新站
                                                        </option>
                                                        <option value="755APBS.商业事业群.商业深圳分公司.德意名居店">
                                                            755APBS.商业事业群.商业深圳分公司.德意名居店
                                                        </option>
                                                        <option value="南山特服">
                                                            南山特服
                                                        </option>
                                                        <option value="E755SJN.仓配物流事业群.仓配深圳区.南山速配站.阳光棕榈园顺丰站">
                                                            E755SJN.仓配物流事业群.仓配深圳区.南山速配站.阳光棕榈园顺丰站
                                                        </option>
                                                        <option value="755ASJS.商业事业群.商业深圳分公司.方鼎华庭店">
                                                            755ASJS.商业事业群.商业深圳分公司.方鼎华庭店
                                                        </option>
                                                        <option value="E755AP.仓配物流事业群.仓配深圳区.西丽速配站">
                                                            E755AP.仓配物流事业群.仓配深圳区.西丽速配站
                                                        </option>
                                                        <option value="755ASKS.商业事业群.商业深圳分公司.前海花园店">
                                                            755ASKS.商业事业群.商业深圳分公司.前海花园店
                                                        </option>
                                                        <option value="755ATJS.商业事业群.商业深圳分公司.皇庭港湾店">
                                                            755ATJS.商业事业群.商业深圳分公司.皇庭港湾店
                                                        </option>
                                                        <option value="755AMAS.商业事业群.商业深圳分公司.星河店">
                                                            755AMAS.商业事业群.商业深圳分公司.星河店
                                                        </option>
                                                        <option value="755TGS.商业事业群.商业深圳分公司.南油大厦区域.后海花园店">
                                                            755TGS.商业事业群.商业深圳分公司.南油大厦区域.后海花园店
                                                        </option>
                                                        <option value="755ASFS.商业事业群.商业深圳分公司.西丽职院区域.南海明珠店">
                                                            755ASFS.商业事业群.商业深圳分公司.西丽职院区域.南海明珠店
                                                        </option>
                                                        <option value="755APCS.商业事业群.商业深圳分公司.西湖林语店">
                                                            755APCS.商业事业群.商业深圳分公司.西湖林语店
                                                        </option>
                                                        <option value="755TCS.商业事业群.商业深圳分公司.南油大厦区域.蔚蓝海岸店">
                                                            755TCS.商业事业群.商业深圳分公司.南油大厦区域.蔚蓝海岸店
                                                        </option>
                                                        <option value="755ATCS.商业事业群.商业深圳分公司.海月花园店">
                                                            755ATCS.商业事业群.商业深圳分公司.海月花园店
                                                        </option>
                                                        <option value="755ATJS.商业事业群.商业深圳分公司.南油大厦区域.皇庭港湾店">
                                                            755ATJS.商业事业群.商业深圳分公司.南油大厦区域.皇庭港湾店
                                                        </option>
                                                        <option value="E755SFP.仓配物流事业群.仓配深圳区.南山速配站.深圳新德家园顺丰站">
                                                            E755SFP.仓配物流事业群.仓配深圳区.南山速配站.深圳新德家园顺丰站
                                                        </option>
                                                        <option value="南山">
                                                            南山
                                                        </option>
                                                        <option value="E755SMN.仓配物流事业群.仓配深圳区.蛇口速配站.阳光花园顺丰站">
                                                            E755SMN.仓配物流事业群.仓配深圳区.蛇口速配站.阳光花园顺丰站
                                                        </option>
                                                        <option value="755ASBS.商业事业群.商业深圳分公司.西丽职院区域.深圳钰龙园店">
                                                            755ASBS.商业事业群.商业深圳分公司.西丽职院区域.深圳钰龙园店
                                                        </option>
                                                        <option value="755ASDS.商业事业群.商业深圳分公司.西丽职院区域.古城店">
                                                            755ASDS.商业事业群.商业深圳分公司.西丽职院区域.古城店
                                                        </option>
                                                        <option value="755ASLS.商业事业群.商业深圳分公司.南航店">
                                                            755ASLS.商业事业群.商业深圳分公司.南航店
                                                        </option>
                                                        <option value="755ET.速运事业群.华南大区.速运深圳区.南头分部.南新点部">
                                                            755ET.速运事业群.华南大区.速运深圳区.南头分部.南新点部
                                                        </option>
                                                        <option value="755AGGS.商业事业群.商业深圳分公司.宝安机场区域.果岭店">
                                                            755AGGS.商业事业群.商业深圳分公司.宝安机场区域.果岭店
                                                        </option>
                                                        <option value="755TFS.商业事业群.商业深圳分公司.南园店">
                                                            755TFS.商业事业群.商业深圳分公司.南园店
                                                        </option>
                                                        <option value="755ASCS.商业事业群.商业深圳分公司.华府店">
                                                            755ASCS.商业事业群.商业深圳分公司.华府店
                                                        </option>
                                                        <option value="755CD.速运事业群.华南大区.速运深圳区.沙河分部">
                                                            755CD.速运事业群.华南大区.速运深圳区.沙河分部
                                                        </option>
                                                        <option value="755TCS.商业事业群.商业深圳分公司.蔚蓝海岸店">
                                                            755TCS.商业事业群.商业深圳分公司.蔚蓝海岸店
                                                        </option>
                                                        <option value="755CAAS.商业事业群.商业深圳分公司.市民中心区域.时尚天地店">
                                                            755CAAS.商业事业群.商业深圳分公司.市民中心区域.时尚天地店
                                                        </option>
                                                        <option value="755ASKS.商业事业群.商业深圳分公司.西丽职院区域.前海花园店">
                                                            755ASKS.商业事业群.商业深圳分公司.西丽职院区域.前海花园店
                                                        </option>
                                                        <option value="755ARAS.商业事业群.商业深圳分公司.南油大厦区域.香域中央店">
                                                            755ARAS.商业事业群.商业深圳分公司.南油大厦区域.香域中央店
                                                        </option>
                                                        <option value="755ATHS.商业事业群.商业深圳分公司.曙光店">
                                                            755ATHS.商业事业群.商业深圳分公司.曙光店
                                                        </option>
                                                        <option value="755CFGS.商业事业群.商业深圳分公司.双龙坪坑区域.中央悦城店">
                                                            755CFGS.商业事业群.商业深圳分公司.双龙坪坑区域.中央悦城店
                                                        </option>
                                                        <option value="755EFS.商业事业群.商业深圳分公司.龙岗大运区域.君悦豪庭店">
                                                            755EFS.商业事业群.商业深圳分公司.龙岗大运区域.君悦豪庭店
                                                        </option>
                                                        <option value="755EES.商业事业群.商业深圳分公司.龙岗大运区域.鸿基花园店">
                                                            755EES.商业事业群.商业深圳分公司.龙岗大运区域.鸿基花园店
                                                        </option>
                                                        <option value="755BNS.商业事业群.商业深圳分公司.万科城区域.月朗苑店">
                                                            755BNS.商业事业群.商业深圳分公司.万科城区域.月朗苑店
                                                        </option>
                                                        <option value="755AQDS.商业事业群.商业深圳分公司.布吉关外区域.玉岭花园店">
                                                            755AQDS.商业事业群.商业深圳分公司.布吉关外区域.玉岭花园店
                                                        </option>
                                                        <option value="龙岗">
                                                            龙岗
                                                        </option>
                                                        <option value="755ARBS.商业事业群.商业深圳分公司.南油大厦区域.熙园店">
                                                            755ARBS.商业事业群.商业深圳分公司.南油大厦区域.熙园店
                                                        </option>
                                                        <option value="755ATDS.商业事业群.商业深圳分公司.南油大厦区域.深圳兰园店">
                                                            755ATDS.商业事业群.商业深圳分公司.南油大厦区域.深圳兰园店
                                                        </option>
                                                        <option value="755DAAS.商业事业群.商业深圳分公司.可园一期店">
                                                            755DAAS.商业事业群.商业深圳分公司.可园一期店
                                                        </option>
                                                        <option value="755GAS.商业事业群.商业深圳分公司.西丽职院区域.缘来居店">
                                                            755GAS.商业事业群.商业深圳分公司.西丽职院区域.缘来居店
                                                        </option>
                                                        <option value="755DKAS.商业事业群.商业深圳分公司.豪方菁园店">
                                                            755DKAS.商业事业群.商业深圳分公司.豪方菁园店
                                                        </option>
                                                        <option value="755JCS.商业事业群.商业深圳分公司.景冠华诚店">
                                                            755JCS.商业事业群.商业深圳分公司.景冠华诚店
                                                        </option>
                                                        <option value="755ATGS.商业事业群.商业深圳分公司.南油大厦区域.玫瑰园店">
                                                            755ATGS.商业事业群.商业深圳分公司.南油大厦区域.玫瑰园店
                                                        </option>
                                                        <option value="西丽">
                                                            西丽
                                                        </option>
                                                        <option value="755TBS.商业事业群.商业深圳分公司.南油大厦区域.深圳南门店">
                                                            755TBS.商业事业群.商业深圳分公司.南油大厦区域.深圳南门店
                                                        </option>
                                                        <option value="755BEJS.商业事业群.商业深圳分公司.白石龙区域.樟坑店">
                                                            755BEJS.商业事业群.商业深圳分公司.白石龙区域.樟坑店
                                                        </option>
                                                        <option value="755ABFS.商业事业群.商业深圳分公司.康达尔店">
                                                            755ABFS.商业事业群.商业深圳分公司.康达尔店
                                                        </option>
                                                        <option value="755AVBS.商业事业群.商业深圳分公司.双龙坪坑区域.赤石岗店">
                                                            755AVBS.商业事业群.商业深圳分公司.双龙坪坑区域.赤石岗店
                                                        </option>
                                                        <option value="755AVDS.商业事业群.商业深圳分公司.双龙坪坑区域.怡龙店">
                                                            755AVDS.商业事业群.商业深圳分公司.双龙坪坑区域.怡龙店
                                                        </option>
                                                        <option value="755EJS.商业事业群.商业深圳分公司.龙岗大运区域.锦绣东方店">
                                                            755EJS.商业事业群.商业深圳分公司.龙岗大运区域.锦绣东方店
                                                        </option>
                                                        <option value="龙岭分部">
                                                            龙岭分部
                                                        </option>
                                                        <option value="南油分部">
                                                            南油分部
                                                        </option>
                                                        <option value="755BDAS.商业事业群.商业深圳分公司.龙岗大运区域.大运店">
                                                            755BDAS.商业事业群.商业深圳分公司.龙岗大运区域.大运店
                                                        </option>
                                                        <option value="755ABBS.商业事业群.商业深圳分公司.中海怡翠店">
                                                            755ABBS.商业事业群.商业深圳分公司.中海怡翠店
                                                        </option>
                                                        <option value="755AVAS.商业事业群.商业深圳分公司.双龙坪坑区域.鹏达店">
                                                            755AVAS.商业事业群.商业深圳分公司.双龙坪坑区域.鹏达店
                                                        </option>
                                                        <option value="755ASGS.商业事业群.商业深圳分公司.星海名城店">
                                                            755ASGS.商业事业群.商业深圳分公司.星海名城店
                                                        </option>
                                                        <option value="E755SCA.仓配物流事业群.仓配深圳区.坪地速配站.东湖街顺丰站">
                                                            E755SCA.仓配物流事业群.仓配深圳区.坪地速配站.东湖街顺丰站
                                                        </option>
                                                        <option value="755ABCS.商业事业群.商业深圳分公司.深圳曼城店">
                                                            755ABCS.商业事业群.商业深圳分公司.深圳曼城店
                                                        </option>
                                                        <option value="755KCS.商业事业群.商业深圳分公司.双龙坪坑区域.金域缇香店">
                                                            755KCS.商业事业群.商业深圳分公司.双龙坪坑区域.金域缇香店
                                                        </option>
                                                        <option value="755ADAS.商业事业群.商业深圳分公司.龙岗大运区域.深圳守珍街店">
                                                            755ADAS.商业事业群.商业深圳分公司.龙岗大运区域.深圳守珍街店
                                                        </option>
                                                        <option value="755CFGS.商业事业群.商业深圳分公司.中央悦城店">
                                                            755CFGS.商业事业群.商业深圳分公司.中央悦城店
                                                        </option>
                                                        <option value="755CEFS.商业事业群.商业深圳分公司.布吉关外区域.中心花园店">
                                                            755CEFS.商业事业群.商业深圳分公司.布吉关外区域.中心花园店
                                                        </option>
                                                        <option value="E755G.仓配物流事业群.仓配深圳区.南山速配营业部">
                                                            E755G.仓配物流事业群.仓配深圳区.南山速配营业部
                                                        </option>
                                                        <option value="E755SCZ.仓配物流事业群.仓配深圳区.龙岭速配站.新梅子园顺丰站">
                                                            E755SCZ.仓配物流事业群.仓配深圳区.龙岭速配站.新梅子园顺丰站
                                                        </option>
                                                        <option value="755DABS.商业事业群.商业深圳分公司.东门商圈区域.假日名城店">
                                                            755DABS.商业事业群.商业深圳分公司.东门商圈区域.假日名城店
                                                        </option>
                                                        <option value="755CEFS.商业事业群.商业深圳分公司.中心花园店">
                                                            755CEFS.商业事业群.商业深圳分公司.中心花园店
                                                        </option>
                                                        <option value="E755CK.仓配物流事业群.仓配深圳区.布心速配站">
                                                            E755CK.仓配物流事业群.仓配深圳区.布心速配站
                                                        </option>
                                                        <option value="755BFBS.商业事业群.商业深圳分公司.深圳嘉葆润店">
                                                            755BFBS.商业事业群.商业深圳分公司.深圳嘉葆润店
                                                        </option>
                                                        <option value="755AVCS.商业事业群.商业深圳分公司.峦山谷店">
                                                            755AVCS.商业事业群.商业深圳分公司.峦山谷店
                                                        </option>
                                                        <option value="755EKS.商业事业群.商业深圳分公司.熙和园店">
                                                            755EKS.商业事业群.商业深圳分公司.熙和园店
                                                        </option>
                                                        <option value="755AQES.商业事业群.商业深圳分公司.东门商圈区域.深圳国展苑店">
                                                            755AQES.商业事业群.商业深圳分公司.东门商圈区域.深圳国展苑店
                                                        </option>
                                                        <option value="755ASJS.商业事业群.商业深圳分公司.西丽职院区域.方鼎华庭店">
                                                            755ASJS.商业事业群.商业深圳分公司.西丽职院区域.方鼎华庭店
                                                        </option>
                                           
                                                    </select>
                                                    </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row"><a href="#">编辑</a></td>
            <td>成厚权文</td>
            <td>在职</td>
            <td>中国移动通信集团广东有限公司深圳分公司</td>
            <td>汇海运输有限公司福永分公司</td>

            <td>755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点</td>
       
          </tr>
          <tr>
            <td scope="row"><a href="#">编辑</a></td>
            <td>成厚权文</td>
            <td>在职</td>
            <td>中国移动通信集团广东有限公司深圳分公司</td>
            <td>汇海运输有限公司福永分公司</td>

            <td>755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点</td>
          
          </tr>
          <tr>
            <td scope="row"><a href="#">编辑</a></td>
            <td>成厚权文</td>
            <td>在职</td>
            <td>中国移动通信集团广东有限公司深圳分公司</td>
            <td>汇海运输有限公司福永分公司</td>

            <td>755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点</td>
           
          </tr>
            <tr>
            <td scope="row"><a href="#">编辑</a></td>
            <td>成厚权文</td>
            <td>在职</td>
            <td>中国移动通信集团广东有限公司深圳分公司</td>
            <td>汇海运输有限公司福永分公司</td>

            <td>755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点</td>
           
          </tr>
            <tr>
            <td scope="row"><a href="#">编辑</a></td>
            <td>成厚权文</td>
            <td>在职</td>
            <td>中国移动通信集团广东有限公司深圳分公司</td>
            <td>汇海运输有限公司福永分公司</td>

            <td>755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点</td>
           
          </tr>
            <tr>
            <td scope="row"><a href="#">编辑</a></td>
            <td>成厚权文</td>
            <td>在职</td>
            <td>中国移动通信集团广东有限公司深圳分公司</td>
            <td>汇海运输有限公司福永分公司</td>

            <td>755EC.速运事业群.华南大区.速运深圳区.深圳重货管理部.松岗重货营业点</td>
           
          </tr>
        </tbody>
      </table>
      </div>
    </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="dataTables_info" id="datatable-column-filter_info" role="status" aria-live="polite">
                    Showing 1 to 10 of 16 entries
                </div>
            </div>
            <div class="col-sm-6">
                <div class="dataTables_paginate paging_simple_numbers" id="datatable-column-filter_paginate">
                    <ul class="pagination">
                        <li class="paginate_button previous disabled" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_previous">
                            <a href="#">Previous</a>
                        </li>
                        <li class="paginate_button active" aria-controls="datatable-column-filter" tabindex="0">
                            <a href="#">1</a>
                        </li>
                        <li class="paginate_button" aria-controls="datatable-column-filter" tabindex="0">
                            <a href="#">2</a>
                        </li>
                        <li class="paginate_button next" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_next">
                            <a href="#">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

  </div>
  </div>
  </div>
</div>
</div>
    <!-- bootstarp表格  end-->


</div>
</div>            
<script type="text/javascript">
function divScroll(scrollDiv){
    var scrollLeft = scrollDiv.scrollLeft;
    document.getElementById("tableDiv_title").scrollLeft = scrollLeft;
    document.getElementById("tableDiv_body").scrollLeft = scrollLeft;        
}
function divYScroll(scrollYDiv){
    var scrollTop = scrollYDiv.scrollTop;
    document.getElementById("tableDiv_y").scrollTop = scrollTop;    
}
function onwheel(event){
    var evt = event||window.event;
    var bodyDivY = document.getElementById("tableDiv_y");
    var scrollDivY = document.getElementById("scrollDiv_y");
    if (bodyDivY.scrollHeight>bodyDivY.offsetHeight){
        if (evt.deltaY){
            bodyDivY.scrollTop = bodyDivY.scrollTop + evt.deltaY*7;
            scrollDivY.scrollTop = scrollDivY.scrollTop + evt.deltaY*7;
        }else{
            bodyDivY.scrollTop = bodyDivY.scrollTop - evt.wheelDelta/5;
            scrollDivY.scrollTop = scrollDivY.scrollTop - evt.wheelDelta/5;
        }
    }
}
</script>
{include file="footer.tpl"}