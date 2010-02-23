
	
	<!--Login Script Start-->
	<div id="login">
	<?php if (!(current_user_can('level_0'))){ ?>
	<h2>Admin Login</h2>
	<form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
	<input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" />
	<input type="password" name="pwd" id="pwd" size="20" />
	<input type="submit" name="submit" value="Send" class="button" />
	    <p>
	       <label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label>
	       <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
	    </p>
	</form>
	<a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">Recover password</a>
	<?php } else { ?>
	<h2>Logout</h2>
	<a href="<?php echo wp_logout_url(get_settings('home')); ?>">logout</a><br />
	<a href="/wp-admin">admin</a>
	<?php }?>
	</div>
	<!--Login Script End-->
	
<div id="footer"><br><?php bloginfo('name'); ?> was created by <a href="http://createstudios.org.uk">Create Studios</a>.

<?php wp_footer(); ?>

</div>