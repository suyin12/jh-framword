<?php get_header(); ?>
<div id="container">
	<div class="wrap background">
		
		<div id="content" class="left-col wrap">
		
		<?php if (have_posts()) : ?>
		<h2 class="arh"><?php _e('查询结果',woothemes); ?></h2>
		<?php while (have_posts()) : the_post(); ?>
		
		<!--- Post Starts -->
		
			<div class="post wrap">
			
				<div class="post-meta left-col">
					<h3 class="wrap"><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span><span class="day"><?php the_time('d'); ?></span></h3>
					<h4 class="author"><?php the_author_posts_link(); ?></h4>
					<h4 class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a></h4>
				</div>
				
				<div class="post-content right-col">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

					<?php
					if ( get_option('woo_content_archives') == "true" ) 
						the_content('[...]'); 
					else 
						the_excerpt(); 
					?>

				</div>
				
			</div>
			
			<!--- Post Ends -->
			
			<?php endwhile; ?>
			
			<div class="more_posts">
				<h2><?php next_posts_link(__('&laquo; Older Entries',woothemes)) ?> &nbsp; <?php previous_posts_link (__('Recent Entries &raquo;',woothemes)) ?></h2>
			</div>
			
			<?php else : ?>

			<h2 class="arh"><?php _e('Search results',woothemes); ?></h2>
			
			<div class="post wrap error">
				
				<div class="post-content right-col">
					<p><?php _e('No matches. Please try again, or use the navigation menus to find what you search for',woothemes); ?>.</p>
				</div>
				
			</div>

			<?php endif; ?>
			
		</div>
		
		<?php get_sidebar(); ?>
		
	</div>
	
</div>
	
<?php get_footer(); ?>