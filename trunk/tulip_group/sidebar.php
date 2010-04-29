<div id="sidebar">

<h2>Latest Posts</h2>
<ul>	
<?php wp_get_archives('type=postbypost&limit=9'); ?>
</ul>

<h2>Categories</h2>
<ul>
<?php wp_list_cats('arguments'); ?>
</ul>
<h2>Archives</h2>
<ul>
<?php wp_get_archives('type=monthly&limit=12'); ?>
</ul>
<!--Login Script Start-->
<div id="login">
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
<h2>
<a href="<?php echo wp_logout_url(get_settings('home')); ?>">logout</a></h2><br />
<a href="/wp-admin">admin</a>
<?php }?>
</div>
<!--Login Script End-->
<!--><h2>Blogroll</h2>
<ul>
<?php get_links(); ?>
</ul>-->

</div>