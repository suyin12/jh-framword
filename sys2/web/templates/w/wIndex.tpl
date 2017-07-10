{include file="w/header.tpl"}
<div id="main">
    <div class="ym-wrapper">
       <div class="ym-wbox">
           <div class="ym-grid linearize-level-1">
               <div class="ym-g66 ym-gl ">
                   <section class="box">
                       <p></p>
                       <h3>{$statuInfo.conditionName.name}</h3>
                       <div class="ym-g80 centered">
                           <section class=" info pad">
                               <table>
                                   <tr>
                                       <td width="80px">时 间:</td>
                                       <td>{$statuInfo.beginDatatime}</td>
                                   </tr>
                                   <tr>
                                       <td>地 点:</td>
                                       <td>
                                           <a href="http://map.baidu.com/?newmap=1&ie=utf-8&s=s%26wd%3D+{$statuInfo.address}">{$statuInfo.address}</a>
                                       </td>
                                   </tr>
                                   <tr>
                                       <td>联系人:</td>
                                       <td>{$statuInfo.contact}</td>
                                   </tr>
                                   <tr>
                                       <td>联系电话:</td>
                                       <td>{$statuInfo.cPhone}</td>
                                   </tr>
                                   <tr>
                                       <td>携带资料:</td>
                                       <td>{$statuInfo.datum}</td>
                                   </tr>
                                   <tr>
                                       <td>备 注:</td>
                                       <td>{$statuInfo.remark}</td>
                                   </tr>
                                   <tr>
                                       <td>车 站:</td>
                                       <td>{$statuInfo.station}</td>
                                   </tr>
                                   <tr>
                                       <td>公交车:</td>
                                       <td>{$statuInfo.routes}</td>
                                   </tr>
                               </table>
                           </section>
                       </div>
                   </section>
          </div>
          </div>
       </div>
    </div>
</div>
{include file="footer.tpl"}