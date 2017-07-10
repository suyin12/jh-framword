<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
	global $budeyan_nosidebar;
	$options = get_option('budeyan_options');
	if (is_home()) {
		$home_menu = 'current_page_item';
	} else {
		$home_menu = 'page_item';
	}
	if($options['feed'] && $options['feed_url']) {
		if (substr(strtoupper($options['feed_url']), 0, 7) == 'HTTP://') {
			$feed = $options['feed_url'];
		} else {
			$feed = 'http://' . $options['feed_url'];
		}
	} else {
		$feed = get_bloginfo('rss2_url');
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'budeyan'); ?>" href="<?php echo $feed; ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all comments', 'budeyan'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<style type="text/css" media="screen">@import url(<?php bloginfo('stylesheet_url'); ?>);</style>
<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" type="text/css" media="screen" /><![endif]-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/menu.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/base.js"></script>
<?php wp_head(); ?>
</head>
<?php flush(); ?>
<body>
<?php include('templates/header.php'); ?>
<div id="wrap">
  <div id="container">
    <div id="content">
      <div id="main">