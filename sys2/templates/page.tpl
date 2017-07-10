      <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
      <div id="turn-page">
        {$lang.total_records} <span id="totalRecords">{$record_count}</span>
        {$lang.total_pages} <span id="totalPages">{$page_count}</span>
        {$lang.page_current} <span id="pageCurrent">{$filter.page}</span>
        {$lang.page_size} <input type='text' size='3' id='pageSize' value="{$filter.page_size}" onkeypress="return listTable.changePageSize(event)" />
        <span id="page-link">
          {literal}<a href="javascript:listTable.gotoPageFirst()">{/literal}{$lang.page_first}</a>
          {literal}<a href="javascript:listTable.gotoPagePrev()">{/literal}{$lang.page_prev}</a>
          {literal}<a href="javascript:listTable.gotoPageNext()">{/literal}{$lang.page_next}</a>
          {literal}<a href="javascript:listTable.gotoPageLast()">{/literal}{$lang.page_last}</a>
          <select id="gotoPage" >
            {create_pages count=$page_count page=$filter.page}
          </select>
        </span>
      </div>
