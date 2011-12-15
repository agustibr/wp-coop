<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<fieldset class="clearfix">
		<input type="text" value="" name="s" id="s" class="span3" placeholder="<?php _e('Cerca', 'wp-coop'); ?> <?php bloginfo('name'); ?>"/>
		<button type="submit" id="searchsubmit" class="btn info">&nbsp;<span><?php _e('Cerca', 'wp-coop'); ?></span></button>
	</fieldset>
</form>
