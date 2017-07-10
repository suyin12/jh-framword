<?php get_header(); ?>
<?php $options = get_option('budeyan_options'); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
        <div id="postpath">
          <a title="<?php _e('Go to homepage', 'budeyan'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'budeyan'); ?></a> &gt; <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &gt; <?php the_title(); ?></div>
        <div class="post" id="post-<?php the_ID(); ?>">
          <h1><?php the_title(); ?></h1>
          <div class="info">
            <span class="date"><?php the_time(__('F jS, Y', 'budeyan')) ?></span> <?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?> <?php edit_post_link(__('Edit', 'budeyan'), '<span class="editpost">', '</span>'); ?> <?php if ($comments || comments_open()) : ?> <span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'budeyan'); ?></a></span><span class="comments"><a href="#comments"><?php _e('Go to comments', 'budeyan'); ?></a></span><?php endif; ?>
			
            <div class="fixed"></div>
          </div>
          <div class="content">
            <p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
            <div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); ?></div>

            <div class="navigation">
              <div class="alignleft"><?php previous_image_link() ?></div>
              <div class="alignright"><?php next_image_link() ?></div>
            </div>
            <div class="fixed"></div>
<h4>亲，上图来源于下文。是否要了解详情？</h4>
<?php
query_posts('p=' . $post->post_parent);

if ( have_posts() ) : while ( have_posts() ) : the_post();
 $more = 0; 
 the_content('阅读全文'); ?></div>
          <div class="tags">
            <?php if ($options['categories']) : ?><span><strong><?php _e('Categories: ', 'budeyan'); ?></strong><?php the_category(', '); ?></span><?php endif; ?><?php if ($options['tags']) : ?><span><strong><?php _e('Tags: ', 'budeyan'); ?></strong><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?></span><?php endif; ?>
          </div>
<?php endwhile; else:
	_e('Sorry, no posts matched your criteria.', 'budeyan');
endif;
wp_reset_query();
?>
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
