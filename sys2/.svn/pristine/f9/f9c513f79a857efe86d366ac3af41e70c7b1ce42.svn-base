<?php get_header(); ?>
<div id="container">
<div class="wrap background">

    <div id="content" class="left-col wrap">

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>

                <!--- Post Starts -->

                <?php if (is_sticky()) : ?>
                    <div class="post wrap">
                        <div class="post-meta left-col">
                            <h3 class="wrap"><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span><span class="day"><?php the_time('d'); ?></span></h3>
                            <h4 class="author"><?php the_author_posts_link(); ?></h4>
                            <h4 class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a></h4>
                        </div>
                        <div class="post-content right-col ">
                            <h2 class="sticky-h2"><a href="<?php the_permalink() ?>">[置顶]<?php the_title(); ?></a></h2>
                            <blockquote>  <?php echo mb_strimwidth(strip_tags($post->post_content), 0, 200, '<a href="' . get_permalink() . '">......[阅读全文]</a>'); ?></blockquote>
                        </div>
                    </div>
                <?php endif;
            endwhile; ?>
            <?php while (have_posts()) : the_post(); ?>
        <?php if (!is_sticky()) : ?>
                    <div class="post wrap">
                        <div class="post-meta left-col">
                            <h3 class="wrap"><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span><span class="day"><?php the_time('d'); ?></span></h3>
                            <h4 class="author"><?php the_author_posts_link(); ?></h4>
                            <h4 class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a></h4>
                        </div>

                        <div class="post-content right-col">
                            <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

                                <?php woo_get_image('image', get_option('woo_thumb_width'), get_option('woo_thumb_height'), 'thumb alignleft'); ?>
                                <?php
                                if (get_option('woo_content_home') == "true")
                                    the_content('[...]');
                                else
                                    the_excerpt();
                                ?>
                        </div>
                    </div>
                <?php endif; ?>
    <?php endwhile; ?>

            <!--- Post Ends -->

            <div id="pagenavi" class="right-col">
                <?php if (function_exists('wp_pagenavi')) : ?>
                    <?php wp_pagenavi() ?>
    <?php else : ?>
                    <span class="newer"><?php previous_posts_link(__('Newer Entries', 'budeyan')); ?></span>
                    <span class="older"><?php next_posts_link(__('Older Entries', 'budeyan')); ?></span>
    <?php endif; ?>
                <div class="fixed"></div>
            </div>

<?php endif; ?>

    </div>

<?php get_sidebar(); ?>

</div>

</div>

<?php get_footer(); ?>