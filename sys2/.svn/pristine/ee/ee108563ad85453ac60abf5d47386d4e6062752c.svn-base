<div id="header">
  <div id="logo">
    <div id="head_rss_feed">
      <a href="<?php bloginfo('rss2_url'); ?>" title="RSS订阅">RSS订阅</a>
    </div>
    <h2><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h2>
    <div class="description"><?php bloginfo('description'); ?></div>
  </div>
  <div id="navigation">
    <div id="menubar">
      <ul id="menus" class="menus"><?php if (is_home()) {$home_menu_class = 'current_page_item';} else {$home_menu_class = 'page_item';}?><li class="<?php echo($home_menu_class); ?>"><a title="<?php _e('Home', 'default'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'default'); ?></a></li><?php wp_list_categories('depth=2&title_li=0&orderby=name&show_count=0'); ?></ul>
    </div>

      <div id="searchbox">
       <form action="<?php bloginfo('home'); ?>" method="get">
          <div class="content">
            <input type="text" class="textfield" name="s" size="24" value="<?php echo wp_specialchars($s, 1); ?>" />
            <input type="submit" class="button" value="" />
          </div>
<script type="text/javascript">
//<![CDATA[
	var searchbox = MGJS.$("searchbox");
	var searchtxt = MGJS.getElementsByClassName("textfield", "input", searchbox)[0];
	var searchbtn = MGJS.getElementsByClassName("button", "input", searchbox)[0];
	var tiptext = "请输入关键字...";
	if(searchtxt.value == "" || searchtxt.value == tiptext) {
		searchtxt.className += " searchtip";
		searchtxt.value = tiptext;
	}
	searchtxt.onfocus = function(e) {
		if(searchtxt.value == tiptext) {
			searchtxt.value = "";
			searchtxt.className = searchtxt.className.replace(" searchtip", "");
		}
	}
	searchtxt.onblur = function(e) {
		if(searchtxt.value == "") {
			searchtxt.className += " searchtip";
			searchtxt.value = tiptext;
		}
	}
	searchbtn.onclick = function(e) {
		if(searchtxt.value == "" || searchtxt.value == tiptext) {
			return false;
		}
	}
//]]>
</script>
        </form>
      </div>
  </div>
</div>
