<?
if (get_post_type() == "wiki"):
    include(TEMPLATEPATH . '/wiki.php');
elseif (get_post_type() == "post"):
    include(TEMPLATEPATH . '/p.php');
else:
    ?>

    <?php get_header(); ?>
<div id="container">
    <div class="wrap background">

        <div id="content" class="left-col wrap">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

                    <!--- Post Starts -->

                    <div class="post wrap page">
                        <?php if (is_sticky()) : ?>
                            <div class="post-meta left-col">
                                <h3 class="wrap"><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span><span class="day"><?php the_time('d'); ?></span></h3>
                                <h4 class="author"><?php the_author_posts_link(); ?></h4>
                                <h4 class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a></h4>
                            </div>
                            <div class="post-content right-col ">
                                <h2 class="sticky-h2"><a href="<?php the_permalink() ?>">[置顶]<?php the_title(); ?></a></h2>
                                <blockquote>  <?php echo mb_strimwidth(strip_tags($post->post_content), 0, 200, '<a href="' . get_permalink() . '">......[阅读全文]</a>'); ?></blockquote>
                            </div>
                        <?php else : ?>
                            <div class="post-meta left-col">
                                <h3 class="wrap"><span class="month"><?php the_time('M'); ?><span class="year"><?php the_time('Y'); ?></span></span><span class="day"><?php the_time('d'); ?></span></h3>
                                <h4 class="author"><?php the_author_posts_link(); ?></h4>
                                <h4 class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a></h4>
                            </div>

                            <div class="post-content right-col">
                                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                <?php the_content(''); ?>

                                <?php comments_template(); ?>
                            <?php endif;
                        endwhile;
                    else: ?>

                        <p><?php _e('Sorry, no posts matched your criteria', woothemes); ?>.</p>

    <?php endif; ?>

                </div>

            </div>

            <!--- Post Ends -->

        </div>

    <?php get_sidebar(); ?>

    </div>

    </div>

    <?php
    get_footer();
endif;
?>