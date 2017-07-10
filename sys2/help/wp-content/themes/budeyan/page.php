<?php get_header(); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
            <div class="post" id="post-<?php the_ID(); ?>">
              <h1><?php the_title(); ?></h1>
                <div class="info">
                  <span class="date"><?php the_modified_time(__('F jS, Y', 'budeyan')); ?></span>
			<?php edit_post_link(__('Edit', 'budeyan'), '<span class="editpost">', '</span>'); ?>
			<?php if ($comments || comments_open()) : ?>
                  <span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'budeyan'); ?></a></span>
                  <span class="comments"><a href="#comments"><?php _e('Go to comments', 'budeyan'); ?></a></span>
			<?php endif; ?>
                <div class="fixed"></div>
              </div>
              <div class="content">
			<?php the_content(); ?>
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
