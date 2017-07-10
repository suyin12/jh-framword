<?php get_header(); ?>
<?php
	$options = get_option('budeyan_options');
	if (function_exists('wp_list_comments')) {
		add_filter('get_comments_number', 'comment_count', 0);
	}
?>

<?php if ($options['notice'] && $options['notice_content']) : ?>
	<div class="post" id="notice">
		<div class="content">
			<?php echo($options['notice_content']); ?>
			<div class="fixed"></div>
		</div>
	</div>
<?php endif; ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
        <div class="post" id="post-<?php the_ID(); ?>">
          <h2><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
          <div class="info">
            <span class="date"><?php the_time(__('F jS, Y', 'budeyan')) ?></span><?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?><?php edit_post_link(__('Edit', 'budeyan'), '<span class="editpost">', '</span>'); ?><span class="comments"><?php comments_popup_link(__('No Comments &#187;', 'budeyan'), __('1 Comment &#187;', 'budeyan'), __('% Comments &#187;', 'budeyan'), '', __('Comments Closed', 'budeyan') ); ?></span>
          <div class="fixed"></div>
        </div>
        <div class="content"><?php the_content(__('Read more...', 'budeyan')); ?>
          <div class="fixed"></div>
        </div>
        <div class="tags"><?php if ($options['categories']) : ?><span><strong><?php _e('Categories: ', 'budeyan'); ?></strong><?php the_category(', '); ?></span><?php endif; ?><?php if ($options['tags']) : ?><span><strong><?php _e('Tags: ', 'budeyan'); ?></strong><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?></span><?php endif; ?>
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
