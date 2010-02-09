<div id="left">

<ul class="latest">
<?php wp_get_archives('type=postbypost&limit=9'); ?>
</ul>

<a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.jpg" alt="<?php bloginfo('name'); ?>" border="0" /></a>

<!--Login Script Start-->
<?php if (!(current_user_can('level_0'))){ ?>
<h2>Login</h2>
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
<!--Login Script End-->

<?php if (function_exists('blc_latest_comments')) { ?>

<ul class='latestactivity'>
<?php blc_latest_comments('5','4','false','<li>','</li>','false','10','#666666','#666666'); ?>
</ul>

<?php } ?> 



</div>