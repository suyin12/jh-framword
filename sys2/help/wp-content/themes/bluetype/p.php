<?php get_header(); ?>
<div id="container">
<div class="wrap backgroundWiki">
		
		<div id="contentWiKi" >

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <!--- Post Starts -->

                <div class="post wrap page">

                    <div class="post-meta left-col">
                        <h3 class="wrap"><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span><span class="day"><?php the_time('d'); ?></span></h3>
                        <h4 class="author"><?php the_author_posts_link(); ?></h4>
                        <h4 class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a></h4>
                    </div>

                    <div class="post-contentWiki right-col">
                        <div id="postpath">
                            <a title="<?php _e('回到首页', woothemes); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', woothemes); ?></a> &gt; <?php the_category(', '); ?> &gt; <?php the_title(); ?></div>
                        <div  class="postContent"  id="post-<?php the_ID(); ?>">
                            <h2 class="title"><?php the_title(); ?></h2>
                            <div class="infoContent">
                                <span class="date"><?php the_time(__('F jS, Y', woothemes)) ?></span> <?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?> <?php edit_post_link(__('编辑', woothemes), '<span class="editpost">', '</span>'); ?> <?php if ($comments || comments_open()) : ?> <span class="addcomment"><a href="#respond"><?php _e('发表评论', woothemes); ?></a></span><span class="comments"><a href="#comments"><?php _e('查看', woothemes); ?></a></span><?php endif; ?>
                                <div class="fixed"></div>
                            </div>
                            <div class="content">
                                <?php the_content(); ?>
                                <div class="fixed"></div>                                
                            </div>                            
                            <div class="tags">
                                <?php if ($options['categories']) : ?><span><strong><?php _e('分类: ', woothemes); ?></strong><?php the_category(', '); ?></span><?php endif; ?><?php if ($options['tags']) : ?><span><strong><?php _e('标签: ', woothemes); ?></strong><?php the_tags('<ul><li>', '</li><li>', '</li></ul>'); ?></span><?php endif; ?>
                            </div>
                        </div>
                        <?php comments_template(); ?>
                    </div>
                <?php endwhile;
            else: ?>
                <p><?php _e('Sorry, no posts matched your criteria', woothemes); ?>.</p>
<?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>