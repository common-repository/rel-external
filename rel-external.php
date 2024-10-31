<?php
/*
Plugin Name: rel="external" in a New Window
Plugin URI: http://pleer.co.uk/wordpress/plugins/rel-external/
Description: Opens a new window with rel="external" without having to use target="_blank" or target="_new".
Version: 1.2.1
Author: Alex Moss
Author URI: http://alex-moss.co.uk/
Contributors: pleer

Copyright (C) 2010-2010, Alex Moss
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Alex Moss or pleer nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/

$plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );

function rel_external() {
	global $plugin_url; ?>
<!-- rel="external" in a New Window: http://pleer.co.uk/wordpress/plugins/rel-external/ -->
<?php
	if (get_option('relexternal_inline') == 'on') {
		if (get_option('relexternal_fulljq') == 'on') { ?><script type="text/javascript">jQuery(function(){jQuery('a[rel*=external]').click(function(){window.open(this.href);return false;});});</script><?php } else { ?><script type="text/javascript">$(function(){$('a[rel*=external]').click(function(){window.open(this.href);return false;});});</script><?php }
	} else {
		if (get_option('relexternal_fulljq') == 'on') {	echo "<script type=\"text/javascript\" src=\"".$plugin_url."/relexternal.js\"></script>"; } else { echo "<script type=\"text/javascript\" src=\"".$plugin_url."/rel-external.js\"></script>"; }
	}
}
add_action('wp_head', 'rel_external');


add_action('admin_menu', 'show_relexternal_options');
function show_relexternal_options() {
    add_options_page('rel="external"', 'rel="external"', 9, 'relexternal', 'relexternal_options');
	add_option('relexternal_inline', 'off');
	add_option('relexternal_fulljq', 'off');
}

function relexternal_options() { ?>
<style type="text/css">
div.headerWrap { background-color:#e4f2fds; width:200px}
#options h3 { padding:7px; padding-top:10px; margin:0px; cursor:auto }
#options label { width: 300px; float: left; margin-left: 10px; }
#options input { float: left; margin-left:10px}
#options p { clear: both; padding-bottom:10px; }
#options .postbox { margin:0px 0px 10px 0px; padding:0px; }
</style>
<div class="wrap">
<form method="post" action="options.php" id="options">
<?php wp_nonce_field('update-options') ?>
<h2>rel="external" Options</h2>

<div class="postbox">
<h3 class="hndle">Resources</h3>
	<div style="text-decoration:none; padding:10px">
		<div style="width:180px; text-align:center; float:right; font-size:10px; font-weight:bold">
			<a href="http://pleer.co.uk/go/rel-external-paypal/">
			<img src="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" style="padding-bottom:10px" /></a>
		</div>

	<a href="http://pleer.co.uk/wordpress/plugins/rel-external/" style="text-decoration:none" target="_blank">Plugin Homepage</a> <small>- More information on this plugin</small><br /><br />

	<a href="http://pleer.co.uk/wordpress/plugins/" style="text-decoration:none" target="_blank">WordPress Plugins</a> <small>- I have developed other plugins including a <a href="http://pleer.co.uk/wordpress/plugins/wp-twitter-feed/" style="text-decoration:none" target="_blank">Twitter Feed</a>, <a href="http://pleer.co.uk/wordpress/plugins/facebook-comments/" style="text-decoration:none" target="_blank">Facebook Comments</a> and <a href="http://pleer.co.uk/wordpress/plugins/rss-feed-reader/" style="text-decoration:none" target="_blank">RSS Feed Reader</a>!</small><br /><br />


</div>
</div>


<div class="postbox">
<h3 class="hndle">Setup</h3>
	<div style="text-decoration:none; padding:10px">

		<p>
			<?php
				if (get_option('relexternal_inline') == 'on') {echo '<input type="checkbox" name="relexternal_inline" checked="yes" />';}
				else {echo '<input type="checkbox" name="relexternal_inline" />';}
			?>
			<label>Generate JS code inline</label><small>you can enable this option if you want the JS to be called inline rather than via an external JS file</small>
		</p>
		<p>
			<?php
				if (get_option('relexternal_fulljq') == 'on') {echo '<input type="checkbox" name="relexternal_fulljq" checked="yes" />';}
				else {echo '<input type="checkbox" name="relexternal_fulljq" />';}
			?>
			<label>Use <strong>jQuery</strong> instead of <strong>$</strong></label><small>if the plugin doesn't work, try ticking this box to revert to calls to jQuery instead of $.</small>
		</p>

</div></div>


</div>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="relexternal_inline,relexternal_fulljq" />
	<div style="clear:both;padding-top:0px;"></div>
	<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options') ?>" /></p>
<div style="clear:both;padding-top:20px;"></div>
</form>
</div>

<?php }

// Add settings link on plugin page
function rel_link($links) {
  $settings_link = '<a href="options-general.php?page=relexternal">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'rel_link' );