<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : ?>
   <div id="footerwrapper">
      <div id="footercontainer">
        <div id="footerblock-a">
<?php if (is_category()) {
			$title=single_cat_title('', false);
			$myposts = get_posts('numberposts=10&orderby=rand&category='.get_cat_ID(single_cat_title('', false)));
	} elseif (is_single() ) { 
		$category = get_the_category();
		$title=$category[0]->cat_name;
		$myposts = get_posts('numberposts=10&orderby=rand&category='.$category[0]->cat_ID);
	} elseif (is_tag()) {
		$title=single_tag_title('', false);
		$myposts = get_posts('numberposts=10&orderby=rand&tag='.single_tag_title('', false));
	} else { 
		$title=__('Rand Post', 'budeyan');
		$myposts = get_posts('numberposts=10&orderby=rand');
	}
	echo "<h3>" .$title. "</h3><ul>";
	foreach($myposts as $post) :
		setup_postdata($post);?><li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endforeach; ?>
          </ul>
        </div>
        <div id="footerblock-b">
          <h3 class="latestentries"><?php _e('Recent Comments') ?></h3><ul>
          <?php
			$comments = get_comments('status=approve&number=5&order=asc');
			foreach($comments as $comment) :
				$output =  '<li>' .get_comment_author().'说：<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . $comment->comment_content . '</a></li>';
			echo $output;
			endforeach;?></ul>
        </div>
        <div id="footerblock-c">
          <h3 class="populartopics"><?php _e('Calendar') ?></h3>
          <?php the_widget('WP_Widget_Calendar',''); ?>
        </div>
      </div>
    </div>
<?php endif; ?>

