<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(); ?></title>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/404.css" type="text/css" media="screen" />
</head>

<body>
<div id="container">
  <div id="talker">
    <a href="http://www.budeyan.com/"><img src="<?php bloginfo('template_url'); ?>/images/404.jpg" alt="<?php _e('404 error', 'budeyan'); ?>" /></a>
  </div>
  <div id="notice">
    <h1><?php _e('Welcome to 404 error page!', 'budeyan'); ?></h1>
    <p><?php _e("Welcome to this customized error page. You've reached this page because you've clicked on a link that does not exist. This is probably our fault... but instead of showing you the basic '404 Error' page that is confusing and doesn't really explain anything, we've created this page to explain what went wrong.", 'budeyan'); ?></p>
    <p><?php _e("You can either (a) click on the 'back' button in your browser and try to navigate through our site in a different direction, or (b) click on the following link to go to homepage.", 'budeyan'); ?></p>
    <div class="back">
      <a href="<?php bloginfo('url'); ?>/"><?php _e('Back to homepage &raquo;', 'budeyan'); ?></a>
    </div>
      <div class="fixed"></div>
  </div>
  <div class="fixed"></div>
</div>
</body>
</html>
