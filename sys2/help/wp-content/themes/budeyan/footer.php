	</div>
	<!-- main END -->
	<?php get_sidebar();?>
	<div class="fixed"></div>
</div>
<!-- content END -->

</div>
<!-- container END -->
</div>
<!-- wrap END -->
<?php $options = get_option('budeyan_options');?>
<div id="footer">
    <div id="foot_rss_feed">
      <a href="http://feed.feedsky.com/budeyan" title="feedsky订阅"><?php _e('Subscribe RSS', 'budeyan') ?></a>
    </div>
  <div class="footer_banner">
    <div id="footermenu">
      <ul>
        <li class="<?php if (is_home()) { echo "current_page_item"; } ?>"><a href="<?php echo get_settings('home'); ?>" title="不得言博客首页">首页</a></li>
        <?php wp_list_pages('sort_column=menu_order&title_li='); ?>
        <li><a href="#" title="Top">返回顶部</a></li>
      </ul>
    </div>
  </div>
  <div class="footer_list">
	<?php get_sidebar('footer'); ?>
  </div>
  <div id="copyright">
    <div class="wpr floatholder">
      <div style="float:right;">Designed by <a href="http://www.budeyan.com" title="<?php _e('budeyan blog','budeyan')?>"><?php _e('budeyan','budeyan')?></a>.</div>
      &copy; 2011 <?php if ($options['icp'] && $options['icp_num']){ echo $options['icp_num'];}?><strong> 
      </strong> <a href="http://www.wordpress.org" title="WordPress"  rel="nofollow">WordPress</a>.<a href="http://creativecommons.org/licenses/by-nc-sa/2.5/cn/"  rel="nofollow"><?php _e('This site is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 2.5 License.','budeyan') ?></a></div>
  </div>
</div>
<div class="analytics"<?php if ($options['display_analytics']) { echo ' style="display:none;"';}?>>
<?php
	wp_footer();
	if ($options['analytics']) {
		echo($options['analytics_content']);
	}
?>
</div>

</body>
</html>

