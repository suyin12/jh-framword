<?php /* Template Name: Archives */ ?>
<?php get_header(); ?>
<?php $options = get_option('budeyan_options'); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
        <div id="postpath">
          <a title="<?php _e('Go to homepage', 'budeyan'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'budeyan'); ?></a> &gt; <?php the_category(', '); ?> &gt; <?php the_title(); ?></div>
        <div class="post" id="post-<?php the_ID(); ?>">
          <h2><?php the_title(); ?></h2>
          <div class="info">
            <span class="date"><?php the_time(__('F jS, Y', 'budeyan')) ?></span> <?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?> <?php edit_post_link(__('Edit', 'budeyan'), '<span class="editpost">', '</span>'); ?> <?php if ($comments || comments_open()) : ?> <span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'budeyan'); ?></a></span><span class="comments"><a href="#comments"><?php _e('Go to comments', 'budeyan'); ?></a></span><?php endif; ?>
			
            <div class="fixed"></div>
          </div>
          <div class="content">
            <ul class="archives">
				 <?php
				 global $post;
				 $archives_post = get_posts('numberposts=-1');
				 foreach($archives_post as $post) :
				   setup_postdata($post);
				 ?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php endforeach;
				 wp_reset_query();?>
            </ul> 
            <div class="fixed"></div>
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
