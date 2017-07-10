<td>
    客户经理<select name="mID">
        <option value="">--请选择--</option>

        {foreach from = $unitManager item = val} 
        {html_options	values=$val.mID output= $val.mName selected= $s_mID} {/foreach}

    </select>
</td>
<td>
    单位 <select name="unitID">
        <option value="">---------------请选择------------</option>

        {foreach from= $unitManager item= val key=k } 
            {foreach from= $val	item=u key= k} 
                {if $k eq "unit"}
                    {foreach from= $u item= m key= n}
                        {html_options values= $m.unitID output= $m.unitName|replace:"深圳市":""	selected=$s_unitID}
                    {/foreach}
                {/if} 
            {/foreach} 
        {/foreach}
    </select> 
</td>