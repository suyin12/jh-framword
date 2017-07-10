<?php
	$options = get_option('budeyan_options');

	if($options['feed'] && $options['feed_url']) {
		if (substr(strtoupper($options['feed_url']), 0, 7) == 'HTTP://') {
			$feed = $options['feed_url'];
		} else {
			$feed = 'http://' . $options['feed_url'];
		}
	} else {
		$feed = get_bloginfo('rss2_url');
	}
?>

<!-- sidebar START -->
<div id="sidebar">

<!-- sidebar north START -->
<div id="northsidebar" class="sidebar">
  <!-- feeds & blogger-->
  <div class="widget widget_feeds">
<?php if($options['showcase_caption'] && $options['showcase_content']) {echo $options['showcase_content'];}?>

    <div class="content">
      <a id="feedrss" title="<?php _e('Subscribe to this blog...', 'budeyan'); ?>" href="<?php echo $feed; ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'budeyan'); ?></a><?php if($options['feed_email'] && $options['feed_url_email']) : ?>
      <a rel="external nofollow" id="feedemail" title="<?php _e('Subscribe to this blog via email...', 'budeyan'); ?>" href="<?php echo $options['feed_url_email']; ?>"><?php _e('Email feed', 'budeyan'); ?></a><?php endif; if($options['twitter'] && $options['twitter_username']) : ?>

      <a id="followme" title="<?php _e('Follow me!', 'budeyan'); ?>" href="http://twitter.com/<?php echo $options['twitter_username']; ?>/"><?php _e('Twitter', 'budeyan'); ?></a><?php endif; if($options['t_qq'] && $options['t_qq_name']) : ?>

      <a id="t_qq" rel="external nofollow" title="<?php _e('t_qq', 'budeyan'); ?>" href="http://t.qq.com/<?php echo $options['t_qq_name']; ?>/"><?php _e('t_qq', 'budeyan'); ?></a><?php endif; ?>

      <div class="fixed"></div>
    </div>
  </div>
<?php
$isShowTimeInfo=1;
$isDisplayTitle=1;
$title =__('future posts','budeyan');;

if($posts = get_posts('post_status=future&order=asc')){
  echo '<div class="widget display_future_posts">';
  if ($isDisplayTitle=="1" && $title!="")	{ echo '<h3>' . $title . '</h3>'; }
    echo '<ul>';
    foreach($posts as $post) {
      setup_postdata($post);
      if ($post->post_title == '') {$post->post_title = sprintf(__('Post #%s'), $post->ID);}
      if ($isShowTimeInfo=="1") {
        echo '<li>' . get_the_title() . sprintf(__('( in future %s published )' ,'budeyan'), get_the_date('Fd H:i')).' </li>';
      } else {
        echo '<li>' . $post->post_title . '</li>';
      }
    }
    echo '</ul>';
  echo '</div>';
}
?>      

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('north_sidebar') ) : ?>
  <!-- posts -->
    <div class="widget">
      <h3><?php if (is_home()) {_e('Newest Post', 'budeyan');} else {_e('Rand Post', 'budeyan');}?></h3>
      <ul><?php if (is_single()) {$posts = get_posts('numberposts=10&orderby=rand');
				} elseif (is_category()) {$posts = get_posts('numberposts=10&orderby=rand&category='.get_cat_ID(single_cat_title('', false)));
				} else {$posts = get_posts('numberposts=10&orderby=post_date');}
				foreach($posts as $post) {
					setup_postdata($post);
						echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$post = $posts[0]; ?></ul>
    </div>

	<!-- google_ad -->
    <div class="google_ad">
      <?php if($options['ad1_title'])  {echo '<h3>' . $options['ad1_title'] . '</h3>'; }?>
	  <?php if($options['ad1_content']) {echo $options['ad1_content'];}else{?>
      <script type="text/javascript"><!--
        google_ad_client = "pub-7057979652817126";
        /* 300x250, 创建于 10-7-20 */
        google_ad_slot = "7914584069";
        google_ad_width = 300;
        google_ad_height = 250;
        //-->
      </script>
      <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script><?php } ?>
    </div>

	<!-- tag cloud -->
    <div id="tag_cloud" class="widget">
      <?php if(function_exists('st_tag_cloud')){st_tag_cloud();} else {wp_tag_cloud();}?>
    </div>

<?php endif; ?>
</div>
<!-- sidebar north END -->


<div id="centersidebar">
  <!-- sidebar west START -->
  <div id="westsidebar" class="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('west_sidebar') ) : ?>
    <div class="widget widget_categories">
      <h3><?php _e('Categories', 'budeyan');?></h3>
      <ul><?php wp_list_cats('sort_column=name&optioncount=0&depth=1'); ?></ul>
    </div>
    <div class="widget widget_links">
      <h3><?php _e('Blogroll', 'budeyan');?></h3>
      <ul><?php wp_list_bookmarks('title_li=&categorize=0');?></ul>
    </div>
<?php endif; ?>
  </div>
  <!-- sidebar west END -->

  <!-- sidebar east START -->
  <div id="eastsidebar" class="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('east_sidebar') ) : ?>
    <!-- categories -->
    <div class="widget widget_archive">
      <h3><?php _e('Blog Archives', 'budeyan');?></h3>
      <ul><?php wp_get_archives('type=monthly&limit=24'); ?>
      </ul>
    </div>
<?php endif; ?>
  </div>
  <!-- sidebar east END -->
  <div class="fixed"></div>
</div>

<!-- sidebar south START -->
<div id="southsidebar" class="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('south_sidebar') ) : ?>
  <!-- archives -->
  <?php the_widget('WP_Widget_Recent_Comments', 'number=15', $args); ?>
  <!-- meta -->
  <?php the_widget('WP_Widget_Meta'); ?>
<?php endif; ?>
</div>
<!-- sidebar south END -->

</div>
<!-- sidebar END -->
