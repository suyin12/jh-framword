<?php
	define( 'NO_HEADER_TEXT', true );
	define( 'HEADER_TEXTCOLOR', '' );
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'budeyan_header_image_width', 1336) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'budeyan_header_image_height', 200) );
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
	add_custom_image_header( 'budeyan_header_style', 'budeyan_admin_header_style' );

	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			'description' => __( 'Berries', 'budeyan' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			'description' => __( 'Cherry Blossoms', 'budeyan' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			'description' => __( 'Concave', 'budeyan' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			'description' => __( 'Fern', 'budeyan' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			'description' => __( 'Forest Floor', 'budeyan' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			'description' => __( 'Inkwell', 'budeyan' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			'description' => __( 'Path', 'budeyan' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			'description' => __( 'Sunset', 'budeyan' )
		)
	) );

if ( ! function_exists( 'budeyan_admin_header_style' ) ) :
function budeyan_admin_header_style() {
?>
<style type="text/css">
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
</style>
<?php
}
endif;

if ( ! function_exists( 'budeyan_header_style' ) ) :
function budeyan_header_style() {
?>
<style type="text/css">#header {background:url(<?php header_image(); ?>) 50% 0;height:200px;}</style>
<?php
}
endif;

if ( ! function_exists( 'budeyan_header_style' ) ) :
function budeyan_header_style() {
?>
<style type="text/css">#wrap {background:url(<?php header_image(); ?>) 50% 0;height:200px;}</style>
<?php
}
endif;

add_custom_background();


class budeyanOptions {

	function getOptions() {
		$options = get_option('budeyan_options');
		if (!is_array($options)) {
			$options['icp'] = false;
			$options['icp_num'] = '';
			$options['menu_type'] = 'pages';
			$options['author'] = true;
			$options['categories'] = true;
			$options['tags'] = true;
			$options['t_qq'] = false;
			$options['t_qq_name'] = '';
			$options['twitter'] = false;
			$options['twitter_username'] = '';
			$options['showcase_caption'] = false;
			$options['showcase_content'] = '';
			$options['notice'] = false;
			$options['notice_content'] = '';
			$options['display_analytics'] = true;
			$options['analytics'] = false;
			$options['ad1_title'] = '';
			$options['ad1_content'] = '';
			$options['ad2_content'] = '';
			update_option('budeyan_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['budeyan_save'])) {
			$options = budeyanOptions::getOptions();

			// icp
			if ($_POST['icp']) {
				$options['icp'] = (bool)true;
			} else {
				$options['icp'] = (bool)false;
			}
			$options['icp_num'] = stripslashes($_POST['icp_num']);

			// menu
			$options['menu_type'] = stripslashes($_POST['menu_type']);

			// qq
			if ($_POST['t_qq']) {
				$options['t_qq'] = (bool)true;
			} else {
				$options['t_qq'] = (bool)false;
			}
			$options['t_qq_name'] = stripslashes($_POST['t_qq_name']);

			// twitter
			if ($_POST['twitter']) {
				$options['twitter'] = (bool)true;
			} else {
				$options['twitter'] = (bool)false;
			}
			$options['twitter_username'] = stripslashes($_POST['twitter_username']);

			// posts
			if ($_POST['author']) {
				$options['author'] = (bool)true;
			} else {
				$options['author'] = (bool)false;
			}
			if ($_POST['categories']) {
				$options['categories'] = (bool)true;
			} else {
				$options['categories'] = (bool)false;
			}
			if (!$_POST['tags']) {
				$options['tags'] = (bool)false;
			} else {
				$options['tags'] = (bool)true;
			}

			// showcase
			if ($_POST['showcase_caption']) {
				$options['showcase_caption'] = (bool)true;
			} else {
				$options['showcase_caption'] = (bool)false;
			}
			$options['showcase_content'] = stripslashes($_POST['showcase_content']);

			// notice
			if ($_POST['notice']) {
				$options['notice'] = (bool)true;
			} else {
				$options['notice'] = (bool)false;
			}
			$options['notice_content'] = stripslashes($_POST['notice_content']);

			// analytics
			if ($_POST['analytics']) {
				$options['analytics'] = (bool)true;
			} else {
				$options['analytics'] = (bool)false;
			}

			if ($_POST['display_analytics']) {
				$options['display_analytics'] = (bool)true;
			} else {
				$options['display_analytics'] = (bool)false;
			}
			$options['analytics_content'] = stripslashes($_POST['analytics_content']);

			// ad1
			$options['ad1_title'] = stripslashes($_POST['ad1_title']);
			$options['ad1_content'] = stripslashes($_POST['ad1_content']);


			// ad2

			$options['ad2_content'] = stripslashes($_POST['ad2_content']);

			update_option('budeyan_options', $options);

		} else {
			budeyanOptions::getOptions();
		}

		add_theme_page(__('Current Theme Options', 'budeyan'), __('Current Theme Options', 'budeyan'), 'edit_themes', basename(__FILE__), array('budeyanOptions', 'display'));
	}

	function display() {
		$options = budeyanOptions::getOptions();
?>

<form action="#" method="post" enctype="multipart/form-data" name="budeyan_form" id="budeyan_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'budeyan'); ?></h2>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('icp', 'budeyan'); ?></th>
					<td>
						<label>
							<input name="icp" type="checkbox" value="checkbox" <?php if($options['icp']) echo "checked='checked'"; ?> />
							 <?php _e('Add icp number.', 'budeyan'); ?>
						</label>
						<br />
						 <?php _e('icp_num:', 'budeyan'); ?>
						 <input type="text" name="icp_num" id="icp_num" class="code" size="40" value="<?php echo($options['icp_num']); ?>">
					</td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Menubar', 'budeyan'); ?></th>
					<td>
						<label style="margin-right:20px;">
							<input name="menu_type" type="radio" value="pages" <?php if($options['menu_type'] != 'categories') echo "checked='checked'"; ?> />
							 <?php _e('Show pages as menu.', 'budeyan'); ?>
						</label>
						<label>
							<input name="menu_type" type="radio" value="categories" <?php if($options['menu_type'] == 'categories') echo "checked='checked'"; ?> />
							 <?php _e('Show categories as menu.', 'budeyan'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Posts Options', 'budeyan'); ?></th>
					<td>
						<label style="margin-right:20px;">
							<input name="author" type="checkbox" value="checkbox" <?php if($options['author']) echo "checked='checked'"; ?> />
							 <?php _e('Show author on posts.', 'budeyan'); ?>
						</label>
						<label style="margin-right:20px;">
							<input name="categories" type="checkbox" value="checkbox" <?php if($options['categories']) echo "checked='checked'"; ?> />
							 <?php _e('Show categories on posts.', 'budeyan'); ?>
						</label>
						<label>
							<input name="tags" type="checkbox" value="checkbox" <?php if($options['tags']) echo "checked='checked'"; ?> />
							 <?php _e('Show tags on posts.', 'budeyan'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('t_qq', 'budeyan'); ?></th>
					<td>
						<label>
							<input name="t_qq" type="checkbox" value="checkbox" <?php if($options['t_qq']) echo "checked='checked'"; ?> />
							 <?php _e('Add QQ button.', 'budeyan'); ?> <a href="http://t.qq.com/bdylovehll/" onclick="window.open(this.href);return false;"><?php _e('Follow Budeyan','budeyan') ?></a>
						</label>
						<br />
						 <?php _e('t_qq_name:', 'budeyan'); ?>
						 <input type="text" name="t_qq_name" id="t_qq_name" class="code" size="40" value="<?php echo($options['t_qq_name']); ?>">
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Twitter', 'budeyan'); ?></th>
					<td>
						<label>
							<input name="twitter" type="checkbox" value="checkbox" <?php if($options['twitter']) echo "checked='checked'"; ?> />
							 <?php _e('Add Twitter button.', 'budeyan'); ?> <a href="http://twitter.com/budeyan/" onclick="window.open(this.href);return false;"><?php _e('Follow Budeyan','budeyan') ?></a>
						</label>
						<br />
						 <?php _e('Twitter username:', 'budeyan'); ?>
						 <input type="text" name="twitter_username" id="twitter_username" class="code" size="40" value="<?php echo($options['twitter_username']); ?>">
					</td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Notice', 'budeyan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'budeyan'); ?></small>
					</th>
					<td>
						<label>
							<input name="notice" type="checkbox" value="checkbox" <?php if($options['notice']) echo "checked='checked'"; ?> />
							 <?php _e('This notice bar display at the top of homepage.', 'budeyan'); ?>
						</label>
						<br />
						<label>
							<textarea name="notice_content" id="notice_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['notice_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Showcase', 'budeyan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'budeyan'); ?></small>
					</th>
					<td>
						
						<br/>
						<label>
							<input name="showcase_caption" type="checkbox" value="checkbox" <?php if($options['showcase_caption']) echo "checked='checked'"; ?> />
							<?php _e('Displayed in the sidebar at the top.', 'budeyan'); ?>
						</label>
						<label>
							<textarea name="showcase_content" id="showcase_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['showcase_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Web Analytics', 'budeyan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'budeyan'); ?></small>
					</th>
					<td>
						<label>
							<input name="analytics" type="checkbox" value="checkbox" <?php if($options['analytics']) echo "checked='checked'"; ?> />
							 <?php _e('Add web analytics code to your site.', 'budeyan'); ?></label>

						<label>
							  	<input name="display_analytics" type="checkbox" value="checkbox" <?php if($options['display_analytics']) echo "checked='checked'"; ?> />
							 <?php _e('div display or not', 'budeyan'); ?></label>
						<label>
							<textarea name="analytics_content" cols="50" rows="10" id="analytics_content" class="code" style="width:98%;font-size:12px;"><?php echo($options['analytics_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>



		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('ad1', 'budeyan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Displayed ad in the sidebar', 'budeyan'); ?></small>
					</th>
					<td>
						<label>
						 <?php _e('ad1_title:', 'budeyan'); ?>
						<input type="text" name="ad1_title" id="ad1_title" class="code" size="40" value="<?php echo($options['ad1_title']); ?>">
						</label>
						<label>
							<textarea name="ad1_content" id="ad1_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['ad1_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('ad2', 'budeyan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('Displayed ad in single page', 'budeyan'); ?></small>
					</th>
					<td>
						<label>
							<textarea name="ad2_content" id="ad2_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['ad2_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		
		<p class="submit">
			<input class="button-primary" type="submit" name="budeyan_save" value="<?php _e('Save Changes', 'budeyan'); ?>" />
		</p>
	</div>
</form>


<?php
	}
}
// register functions
add_action('admin_menu', array('budeyanOptions', 'add'));

/** l10n */
function theme_init(){
	load_theme_textdomain('budeyan', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

/** widgets */
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'north_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'south_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'west_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'east_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'footer',
		'before_widget' => '<div class="widget-wrap"><div class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}

/** Comments */
if (function_exists('wp_list_comments')) {
	// comment count
	function comment_count( $commentcount ) {
		global $id;
		$_comments = get_comments('status=approve&post_id=' . $id);
		$comments_by_type = &separate_comments($_comments);
		return count($comments_by_type['comment']);
	}
}

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
        <div class="act"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('Reply', 'budeyan'); ?></a> | <a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'commentbody-<?php comment_ID() ?>', 'comment');"><?php _e('Quote', 'budeyan'); ?></a><?php
					if (function_exists("qc_comment_edit_link")) {
					qc_comment_edit_link('', ' | ', '', __('Edit', 'budeyan'));
					}
					edit_comment_link(__('Advanced edit', 'budeyan'), ' | ', '');
				?></div>
        <div class="fixed"></div>
        <div class="content"><?php if ($comment->comment_approved == '0') : ?><p><small><?php _e('Your comment is awaiting moderation.', 'budeyan'); ?></small></p><?php endif; ?><div id="commentbody-<?php comment_ID() ?>"><?php comment_text();?></div></div>
      </div>
      <div class="fixed"></div>
<?php
}
?>
