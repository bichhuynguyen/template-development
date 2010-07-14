	<div id="fb-root"></div>
	<script>
	window.fbAsyncInit = function() {
	FB.init({appId: 'YOUR APP ID', status: true, cookie: true,
	xfbml: true});
	};
	(function() {
	var e = document.createElement('script'); e.async = true;
	e.src = document.location.protocol +
	'//connect.facebook.net/en_US/all.js';
	document.getElementById('fb-root').appendChild(e);
	}());
	</script>
	

	<small style="color: white;">Designed by <a style="color: #ddd; text-decoration: underline;" href="mailto:say@holapascal.com">Pascal Barry</a> - Developed by <a style="color: #ddd; text-decoration: underline;" href="http://mildfuzz.com">Mild Fuzz</a>
	</small>
	<div class="push"></div>
	</div><!--END WRAPPER-->
	<div id="footer">
		<img style="padding-bottom: 5px;"src="<?php echo get_bloginfo('template_url'); ?>/style/images/ace-lottery.jpg" width="85" height="40" alt="funded by Arts Council England" />
		<p class="copyright">&#169; Amphora Arts 2010</p>
		<?php wp_footer(); ?>
	</div>
	
	
</body>

</html>