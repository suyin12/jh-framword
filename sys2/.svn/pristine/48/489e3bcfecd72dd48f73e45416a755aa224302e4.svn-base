<?php
/*
Template Name: qq-weibo-api
*/
?>

<?php
	get_header();
?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2>
			<?php the_title(); ?>
		</h2>
		<div class="info">
			<span class="date"><?php the_modified_time(__('F jS, Y', 'budeyan')); ?></span>
			<?php if ( $user_ID ) : ?><div class="act"><span class="addlink"><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/link-add.php"><?php _e('Add link', 'budeyan'); ?></a></span><span class="editlinks"><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/link-manager.php"><?php _e('Edit links', 'budeyan'); ?></a></span></div>
			<?php endif; ?>
			<?php if ($comments || comments_open()) : ?><span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'budeyan'); ?></a></span><span class="comments"><a href="#comments"><?php _e('Go to comments', 'budeyan'); ?></a></span>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
		<div class="content"><iframe frameborder="0" scrolling="no" src="http://v.t.qq.com/show/show.php?n=bdylovehll&w=520&h=802&fl=2&l=14&o=31&c=0&si=7748594bc946604971ea533644165fcf763cdf7e" width="520" height="802"></iframe>
		<div class="fixed"></div>
		</div>
	</div>

	<?php include('templates/comments.php'); ?>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'budeyan'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
