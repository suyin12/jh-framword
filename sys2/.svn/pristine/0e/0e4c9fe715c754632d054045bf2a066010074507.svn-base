<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

// WooFramework
require_once ($functions_path . 'admin-init.php');			// Framework Init

// Theme specific functionality
require_once ($includes_path . 'theme-options.php'); 		// Options panel settings and custom settings
require_once ($includes_path . 'theme-functions.php'); 		// Custom theme functions
//require_once ($includes_path . 'theme-plugins.php');		// Theme specific plugins integrated in a theme
//require_once ($includes_path . 'theme-actions.php');		// Theme actions & user defined hooks
require_once ($includes_path . 'theme-comments.php'); 		// Custom comments/pingback loop
require_once ($includes_path . 'theme-js.php');				// Load javascript in wp_head
require_once ($includes_path . 'sidebar-init.php');			// Initialize widgetized areas
require_once ($includes_path . 'theme-widgets.php');		// Theme widgets
/*-----------------------------------------------------------------------------------*/
/* End WooThemes Functions - You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

/**汉化*/
function theme_init(){
	load_theme_textdomain('budeyan', get_template_directory() . '/lang');
}
add_action ('init', 'theme_init');
#文章显示字数
function dm_strimwidth($str ,$start , $width ,$trimmarker ){
 $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
 return $output.$trimmarker;
}
//获取父级ID
function get_topmost_parent($post_id){
  $parent_id = get_post($post_id)->post_parent;
  if($parent_id == 0){
    return $post_id;
  }else{
    return get_topmost_parent($parent_id);
  }
}
#添加HTML5支持
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');
// custom comments
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>    <li class="comment <?php if($comment->comment_author_email == get_the_author_email()) {echo 'admincomment';} else {echo 'regularcomment';} ?>" id="comment-<?php comment_ID() ?>">
      <div class="author">
        <div class="pic"><?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 32); } ?></div>
        <div class="name"><?php if (get_comment_author_url()) : ?><a id="commentauthor-<?php comment_ID() ?>" class="url" href="<?php comment_author_url() ?>" rel="external nofollow"><?php else : ?><span id="commentauthor-<?php comment_ID() ?>"><?php endif; ?><?php comment_author(); ?><?php if(get_comment_author_url()) : ?></a><?php else : ?></span><?php endif; ?>
        </div>
      </div>

      <div class="info">
        <div class="date"><?php printf( __('%1$s at %2$s', 'budeyan'), get_comment_time(__('F jS, Y', 'budeyan')), get_comment_time(__('H:i', 'budeyan')) ); ?> | <a href="#comment-<?php comment_ID() ?>"><?php printf('#%1$s', ++$commentcount); ?></a></div>
        <div class="act"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('回复', 'budeyan'); ?></a> | <a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'commentbody-<?php comment_ID() ?>', 'comment');"><?php _e('引用', 'budeyan'); ?></a><?php
					if (function_exists("qc_comment_edit_link")) {
					qc_comment_edit_link('', ' | ', '', __('Edit', 'budeyan'));
					}
					edit_comment_link(__('Advanced edit', 'budeyan'), ' | ', '');
				?></div>
        <div class="fixed"></div>
        <div class="content"><?php if ($comment->comment_approved == '0') : ?><p class="limit"><?php _e('等待审核', 'budeyan'); ?></p><?php endif; ?><div id="commentbody-<?php comment_ID() ?>"><?php comment_text();?></div></div>
      </div>
      <div class="fixed"></div>
<?php
}
?>