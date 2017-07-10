<?php 
get_header(); 
get_sidebar(); 
?>

<div id="container">

<?php while ( have_posts() ) : the_post() ?>

<h1 class="postitle"><?php the_title(); ?><hr /></h1>
<div class="content"><?php  the_content();  ?></div>
<div class="postinfo">Author: <span class="author"><?php  the_author(); ?></span> on <span class="date"><?php  the_date(); ?></span> <span class="edit"><?php edit_post_link(__('edit?')); ?></span>
<br>
Category: <span class="cat"> <?php the_category(', ') ; ?></span>
<br>
<span class="tags"><?php the_tags(); ?></span>
</div>

<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<div class="navigation">
<div class="alignleft"><?php next_post_link('Newer: %link') ?></div>
<div class="alignright"><?php previous_post_link('Older: %link') ?></div>
</div>

<div class="comments">
<?php if (comments_open()) comments_template(); ?>
</div>

<?php endwhile ?>

</div>

<?php get_footer(); ?>
