<?php get_header(); ?>
<?php
	$options = get_option('budeyan_options');
	if (function_exists('wp_list_comments')) {
		add_filter('get_comments_number', 'comment_count', 0);
	}
?>

<?php if (is_search()) : ?>
        <div class="archive-banner">
          <h2><?php printf( __('Keyword: &#8216;%1$s&#8217;', 'budeyan'), wp_specialchars($s, 1) ); ?></h2>
          <p><?php _e('Can not find what you want? Why not try another keyword?','budeyan'); ?></p>
      </div>
      <div class="archive-banner-bottom"></div>
<?php else : ?>
	<div class="archive-banner">
	<?php
		// If this is a category archive
		if (is_category()) {
			echo _e('Archive for Categories','budeyan');
			echo '<h2>'.single_cat_title('', false).'</h2>';
			echo category_description(); 
		// If this is a tag archive
		} elseif (is_tag()) { 
			echo _e('Archive for Tags','budeyan');
			echo '<h2>'.single_tag_title('', false).'</h2>';
			echo tag_description(); 
		// If this is a daily archive
		} elseif (is_day()) {
			echo '<h2>';
			printf( __('Archive for %1$s', 'budeyan'), get_the_time(__('F jS, Y', 'budeyan')) );
			echo '</h2>';
		// If this is a monthly archive
		} elseif (is_month()) {
			echo '<h2>';
			printf( __('Archive for %1$s', 'budeyan'), get_the_time(__('F, Y', 'budeyan')) );
			echo '</h2>';
		// If this is a yearly archive
		} elseif (is_year()) {
			echo '<h2>';
			printf( __('Archive for %1$s', 'budeyan'), get_the_time(__('Y', 'budeyan')) );
			echo '</h2>';
		// If this is an author archive
		} elseif (is_author()) { 
		    if (have_posts()) : while (have_posts()) : the_post();
			  if ($authorcount != 1) {
				echo get_avatar( get_the_author_email(), $size = '70'); 
				echo _e('<p>Displaying the most recent of ' , 'budeyan'); the_author_posts(); _e(' posts written by</p>' , 'budeyan');
				echo '<h2>';the_author();'</h2>';
				$authorcount = 1; } else {} 
				endwhile; 
			endif; 
		// If this is a paged archive
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			_e('Blog Archives', 'budeyan');
		}
		?></div>
    <div class="archive-banner-bottom"></div>
<?php endif; ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="info">
			<span class="date"><?php the_time(__('F jS, Y', 'budeyan')) ?></span>
			<?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?>
			<?php edit_post_link(__('Edit', 'budeyan'), '<span class="editpost">', '</span>'); ?>
			<span class="comments"><?php comments_popup_link(__('No Comments &#187;', 'budeyan'), __('1 Comment &#187;', 'budeyan'), __('% Comments &#187;', 'budeyan'), '', __('Comments Closed', 'budeyan') ); ?></span>
			<div class="fixed"></div>
		</div>
		<div class="content">
			<?php the_content(__('Read more...', 'budeyan')); ?>
			<div class="fixed"></div>
		</div>
          <div class="tags">
            <?php if ($options['categories']) : ?><span><strong><?php _e('Categories: ', 'budeyan'); ?></strong><?php the_category(', '); ?></span><?php endif; ?><?php if ($options['tags']) : ?><span><strong><?php _e('Tags: ', 'budeyan'); ?></strong><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?></span><?php endif; ?>
          </div>
	</div>
<?php endwhile; else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'budeyan'); ?>
	</div>
<?php endif; ?>

<div id="pagenavi">
	<?php if(function_exists('wp_pagenavi')) : ?>
		<?php wp_pagenavi() ?>
	<?php else : ?>
		<span class="newer"><?php previous_posts_link(__('Newer Entries', 'budeyan')); ?></span>
		<span class="older"><?php next_posts_link(__('Older Entries', 'budeyan')); ?></span>
	<?php endif; ?>
	<div class="fixed"></div>
</div>

<?php get_footer(); ?>
