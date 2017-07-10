<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p><?php _e('This post is password protected. Enter the password to view comments.',woothemes); ?><p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'comment';
?>

<!-- You can start editing here. -->

<?php if ($comments) : ?>

<h3 id="comments"><?php comments_number(__('No Comments',woothemes), __('One Comment',woothemes), __('% Comments',woothemes) );?></h3>


<?php foreach ($comments as $comment) : ?>

<div class="comments_wrap wrap" id="comment-<?php comment_ID() ?>">
<div class="left">
<?php if (function_exists('gravatar')) { ?>
<img src="<?php gravatar('X', '35'); ?>" alt="<?php //_e('Gravatar'); ?>" />
<?php } ?>
</div>
<div class="right">
<h4><b><?php comment_author_link() ?></b>&nbsp; on <?php comment_time('F jS, Y') ?> <?php edit_comment_link(__('Edit comment',woothemes), '<span class="pedit">', '</span>'); ?></h4>
<?php comment_text() ?>
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.',woothemes); ?></em></p>
<?php endif; ?>
</div>
</div>



	<?php /* Changes every other comment to a different class */
		if ('comment' == $oddcomment) $oddcomment = 'alt';
		else $oddcomment = 'comment';
	?>

	<?php endforeach; /* end for each comment */ ?>


 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<!--<p class="nocomments">Comments are closed.</p>-->

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>


<h3 class="lc"><?php _e('Leave a Comment',woothemes); ?></h3>


<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<h2><?php _e('You must be',woothemes); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in',woothemes); ?></a> <?php _e('to post a comment.',woothemes); ?></h2>
<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<div>
<?php if ( $user_ID ) : ?>
<p class="lc_logged"><?php _e('Logged in as',woothemes); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Logout &raquo;',woothemes); ?></a></p>
<?php else : ?>


<label for="author"><?php _e('Username',woothemes); ?> <?php if ($req) echo  __('(required)',woothemes); ?> :<br />
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="27" tabindex="1" /></label> 



<label for="email"><?php _e('Email',woothemes); ?> <?php if ($req) echo  __('(required)',woothemes); ?> :<br />
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="27" tabindex="2" /></label> 



<label for="url"><?php _e('Web Site',woothemes); ?> :<br />
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="27" tabindex="3" /></label> 


<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->


<label for="comment"><?php _e('Comment',woothemes); ?> :<br /></label> 
<textarea name="comment" id="comment" cols="50" rows="8" tabindex="4"></textarea>



<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit',woothemes); ?>" class="sb" />



<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

<?php do_action('comment_form', $post->ID); ?>
</div>
</form>


<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

