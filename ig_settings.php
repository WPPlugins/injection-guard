
<div class="wrap ig_settings">

<div class="icon32" id="icon-options-general"><br></div><h2><span class="icon-large icon-settings"></span>&nbsp;Injection Guard - Settings</h2>
<hr />


<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">


<div class="welcome-panel hide" id="request_panel">
<a class="welcome-panel-close dismiss_link">Dismiss</a>
<img class="flower_img" src="<?php echo plugin_dir_url(__FILE__); ?>/img/kindness.png">

		<h2><span class="promo">Show some love!</span></h2>
		<p>Want to appreciate the effort behind this plugin?
        <ul><li><a href="http://wordpress.org/support/view/plugin-reviews/injection-guard" target="_blank">Rate this plugin 5 stars on WordPress.org</a></li></ul>	
</div>

<input type="hidden" name="ig_key" value="<?php echo $settings['ig_key']; ?>">
<div class="list_head">
<a class="ig_how_link">How it works?</a>
<p class="hide welcome-panel"><strong>How it works?</strong><br />It simply log all the unique query strings which are trying to penetrate your website through URLs, either good or bad. By default, neither it blocks any query nor allows. Once you observe the activity on your website and mark parameters as good or bad so it simply denies to blocked parameters. It's not the ultimate solution that you blocked some query parameter, but at least it can alarm you about malicious activity in process so you can take some security measures. In addition, you can <a href="plugin-install.php?tab=search&s=wp+mechanic" target="_blank" title="Click here to install WordPress Mechanic plugin and get $60 worth help for free">install</a> WordPress Mechanic plugin and can ask for a free diagnosis.<a class="ig_dismiss_link welcome-panel-close">Dismiss</a></p>
<div class="logs_area">

<span class="icon-list-alt"></span><strong>Logged Requests</strong>
</div>
<ul>

<?php if(!empty($ig_logs)): ?>
<?php foreach($ig_logs as $log_head=>$params): ?>
<?php $count_blacklisted = isset($ig_blacklisted[$log_head])?count($ig_blacklisted[$log_head]):0; ?>
	<li>
    	<span class="icon-flag"></span>
 
 		<?php echo $log_head.' ('.$count_blacklisted.'/'.count($params).')'; ?>
		<?php if(!empty($params)): ?>
        <ul>
        <?php foreach($params as $params=>$param): ?>
            <li>
            	<div class="ig_params">
                <span class="icon-question-sign"></span><?php echo $param; ?>
               	</div>
                
                <div class="ig_actions" data-uri="<?php echo $log_head; ?>" data-val="<?php echo $param; ?>">
                
                <?php 
				$blacklisted = (isset($ig_blacklisted[$log_head]) && in_array($param, $ig_blacklisted[$log_head]));
				
				?>
                <a title="Click to whitelist" data-type="whitelist" class="<?php echo $blacklisted?'':'hide'; ?>"><span class="icon-thumbs-up"></span></a>
                
                <a title="Click to blacklist" data-type="blacklist" class="<?php echo $blacklisted?'hide':''; ?>"><span class="icon-thumbs-down"></span></a>
                </div>
            </li>
        <?php endforeach; ?>        
        </ul>
        <?php endif; ?>         
    </li>
<?php endforeach; ?>  
<?php else: ?>
<li>There are no logged requests to show at the moment.</li>      
<?php endif; ?>    
</ul>
</div>



<p class="submit"><?php if(!empty($ig_logs)): ?><input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit"><?php endif; ?><a class="useful_link">Is it a useful plugin?</a></p></form>



</div>

<div class="wm_help">
<div class="wp_sep"></div>
<strong>Need help?</strong><br />

<a href="https://wordpress.org/plugins/wp-mechanic/" target="_blank" title="WordPress Mechanic"><img src="https://plugins.svn.wordpress.org/wp-mechanic/assets/icon-128x128.png" /></a>
<a href="plugin-install.php?tab=search&s=wp+mechanic" target="_blank" style="border-left:4px solid #eee; margin-left:60px;" title="Click here to install WordPress Mechanic plugin and get $60 worth help for free"><img src="https://plugins.svn.wordpress.org/wp-mechanic/assets/banner-772x250.png" width="60%" /></a>
<div class="wp_sep last"></div>
</div>
<script type="text/javascript" language="javascript">

jQuery(document).ready(function($) {

	jQuery('.dismiss_link').click(function(){
		jQuery(this).parent().slideUp();
		jQuery('.useful_link').fadeIn();
	});

	
	jQuery('.useful_link').click(function(){
		jQuery('.dismiss_link').parent().slideDown();
		jQuery(this).fadeOut();
	});	
	
	jQuery('.ig_how_link').click(function(){
		jQuery('.ig_dismiss_link').parent().slideDown();
		jQuery(this).fadeOut();
	});	
	
	jQuery('.ig_dismiss_link').click(function(){
		jQuery(this).parent().slideUp();
		jQuery('.ig_how_link').fadeIn();
	});	

	jQuery('.ig_actions a').die('click');
	jQuery('.ig_actions a').live('click', function(){
		var aClicked = jQuery(this);
		
		jQuery.post(ajaxurl, {action: 'ig_update','type':aClicked.attr('data-type'),'val':aClicked.parent().attr('data-val'), 'uri_index':aClicked.parent().attr('data-uri')}, function(response) {
			response = jQuery.parseJSON(response);
			
			if(response.status==true){
				
				aClicked.siblings().show();
				aClicked.hide();
			}
		});
	});

	//jQuery('.useful_link').click();


	// Find list items representing folders and
	// style them accordingly.  Also, turn them
	// into links that can expand/collapse the
	// tree leaf.
	$('.logs_area li > ul').each(function(i) {
		// Find this list's parent list item.
		var parent_li = $(this).parent('li');
	
		// Style the list item as folder.
		parent_li.addClass('folder');
	
		// Temporarily remove the list from the
		// parent list item, wrap the remaining
		// text in an anchor, then reattach it.
		var sub_ul = $(this).remove();
		parent_li.wrapInner('<a/>').find('a').click(function() {
			// Make the anchor toggle the leaf display.
	
		var options = {};
		sub_ul.toggle();// 'pulsate', options, 200 );
	
		});
		parent_li.append(sub_ul);
	});
	
	// Hide all lists except the outermost.
	$('.logs_area ul ul').hide();

});

</script>
<style type="text/css">
.update-nag,
#message {
    display: none;
}
[class^="icon-"], [class*=" icon-"] {
    margin-right: 6px;
}
#wpcontent, #wpfooter {
    background-color: #fff;
}
</style>