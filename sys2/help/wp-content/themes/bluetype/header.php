<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script  type="Text/Javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/jquery-1.7.2.min.js"></script>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" mce_href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon">
<!--[if IE 6]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
<![endif]-->	
<script defer="true"  type="Text/Javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/MSIE.PNG.js"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <div id="wrapper">
		<div class="top-holder">
			<div id="header">
				<div class="holder">
                                   <!-- end logo -->
					<ul class="navigation">
                                    <?php
                                    if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
                                            wp_nav_menu( array( 'depth' => 4, 'sort_column' => 'menu_order', 'container' => 'ul', 'link_before' => '<span>', 'link_after' => '</span>', 'menu_id' => 'navigation', 'menu_class' => 'nav wrap', 'theme_location' => 'primary-menu' ) );
                                    } else {
                                    ?>
                                    <ul  class="navigation">
                                    <?php
                
				if ( get_option('woo_custom_nav_menu') == 'true' ) {
        			    if ( function_exists('woo_custom_navigation_output') )
						woo_custom_navigation_output('before_title=<span>&after_title=</span>&depth=4');
				} else { ?>
				<?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>
                                        <li class="<?php echo $highlight; ?> first"><a href="<?php bloginfo('url'); ?>"><span><?php _e('首页','woothemes'); ?></span></a></li>
				<?php wp_list_pages('sort_column=menu_order&depth=4&link_before=<span>&link_after=</span>&title_li=&exclude='.get_option('woo_nav_exclude')); ?>
				<?php } ?>
		             </ul>
                            <?php } ?>
                                                
					</ul><!-- end navigation -->				
                                </div><!-- end holder -->
			</div><!-- end header -->


	
