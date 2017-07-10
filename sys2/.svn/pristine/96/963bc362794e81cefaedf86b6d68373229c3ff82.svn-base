<?php get_header(); ?>
<?php $options = get_option('budeyan_options'); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
        <div id="postpath">
          <a title="<?php _e('Go to homepage', 'budeyan'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'budeyan'); ?></a> &gt; <?php the_category(', '); ?> &gt; <?php the_title(); ?></div>
        <div class="post" id="post-<?php the_ID(); ?>">
          <h1><?php the_title(); ?></h1>
          <div class="info">
            <span class="date"><?php the_time(__('F jS, Y', 'budeyan')) ?></span> <?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?> <?php edit_post_link(__('Edit', 'budeyan'), '<span class="editpost">', '</span>'); ?> <?php if ($comments || comments_open()) : ?> <span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'budeyan'); ?></a></span><span class="comments"><a href="#comments"><?php _e('Go to comments', 'budeyan'); ?></a></span><?php endif; ?>
			
            <div class="fixed"></div>
          </div>
          <div class="content">
            <?php the_content(); ?>
            <div class="fixed"></div>
			<div class="google_ad2"><?php if($options['ad2_content']) {echo $options['ad2_content'];}else{?><script type="text/javascript"><!--
google_ad_client = "pub-7057979652817126";
/* 468x60, 创建于 09-4-1 */
google_ad_slot = "9002675646";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><?php } ?>
</div>
          </div>
          <div class="opentqq">
            <a href="javascript:void(0)" onclick="postToWb();" class="tmblog"><img src="http://v.t.qq.com/share/images/s/b32.png"></a><script type="text/javascript">
	function postToWb(){
		var _t = '<?php echo $description_title; ?>';
		var _url = '不得言博客';
		var _appkey = encodeURI("41b1eb6055a540d684f0a205c70df2e7");//你从腾讯获得的appkey
		var _pic = encodeURI('');//（例如：var _pic='图片url1|图片url2|图片url3....）
		var _site = 'http://www.budeyan.com';//你的网站地址
		var _u = 'http://v.t.qq.com/share/share.php?url='+_url+'&appkey='+_appkey+'&site='+_site+'&pic='+_pic+'&title='+_t;
		window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
	}
</script>
            <div class="fixed"></div>
          </div>
          <div class="tags">
            <?php if ($options['categories']) : ?><span><strong><?php _e('Categories: ', 'budeyan'); ?></strong><?php the_category(', '); ?></span><?php endif; ?><?php if ($options['tags']) : ?><span><strong><?php _e('Tags: ', 'budeyan'); ?></strong><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?></span><?php endif; ?>
          </div>
        </div>
        <?php include('templates/comments.php'); ?>

        <div id="postnavi">
          <span class="prev"><?php next_post_link('%link') ?></span>
          <span class="next"><?php previous_post_link('%link') ?></span>
          <div class="fixed"></div>
        </div>
<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'budeyan'); ?>
	</div>
<?php endif; ?>
<?php get_footer(); ?>
