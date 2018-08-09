<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function wp_nlm_admin_notice()
{
	add_thickbox();
	$sharelink_text_array_nlm = array
						(
						"I use Newsletter Manager wordpress plugin from @xyzscripts and you should too.",
						"Newsletter Manager wordpress plugin from @xyzscripts is awesome",
						"Thanks @xyzscripts for developing such a wonderful Newsletter Manager wordpress plugin",
						"I was looking for a Newsletter Manager and I found this. Thanks @xyzscripts",
						"Its very easy to use Newsletter Manager wordpress plugin from @xyzscripts",
						"I installed Newsletter Manager from @xyzscripts,it works flawlessly",
						"Newsletter Manager wordpress plugin that i use works terrific",
						"I am using Newsletter Manager wordpress plugin from @xyzscripts and I like it",
						"The Newsletter Manager plugin from @xyzscripts is simple and works fine",
						"I've been using this Newsletter Manager plugin for a while now and it is really good",
						"Newsletter Manager wordpress plugin is a fantastic plugin",
						"Newsletter Manager wordpress plugin is easy to use and works great. Thank you!",
						"Good and flexible  Newsletter Manager plugin especially for beginners",
						"The best Newsletter Manager wordpress plugin I have used ! THANKS @xyzscripts",
						);
$sharelink_text_nlm = array_rand($sharelink_text_array_nlm, 1);
$sharelink_text_nlm = $sharelink_text_array_nlm[$sharelink_text_nlm];

	
	echo '<div id="nlm_notice_td" class="error" style="margin-left: 2px;background: none repeat scroll 0pt 0pt infobackground; border: 1px solid inactivecaption; padding: 5px;line-height:16px;">
	<p>It looks like you have been enjoying using <a href="https://wordpress.org/plugins/newsletter-manager/" target="_blank"> Newsletter Manager </a> plugin from Xyzscripts for atleast 30 days.Would you consider supporting us with the continued development of the plugin using any of the below methods?</p>
	<p>
	<a href="https://wordpress.org/support/view/plugin-reviews/newsletter-manager" class="button" style="color:white;text-decoration:none;background-color:#25A6E1;margin-right:4px;" target="_blank">Rate it 5★\'s on wordpress</a>
	<a href="http://xyzscripts.com/wordpress-plugins/newsletter-manager/purchase" class="button" style="color:white;text-decoration:none;background-color:#25A6E1;margin-right:4px;" target="_blank">Purchase premium version</a>';
	if(get_option('xyz_credit_link')=="0")
		echo '<a class="button xyz_em_backlink" style="color:white;text-decoration:none;background-color:#25A6E1;margin-right:4px;" target="_blank">Enable Backlink</a>';
	
	echo '<a href="#TB_inline?width=250&height=75&inlineId=show_share_icons_nlm" class="button thickbox" style="color:white;text-decoration:none;background-color:#25A6E1;margin-right:4px;" target="_blank">Share on</a>
	
	<a href="admin.php?page=newsletter-manager-settings&nlm_notice=hide" class="button" style="color:white;text-decoration:none;background-color:#25A6E1;margin-right:4px;">Don\'t Show This Again</a>
	</p>
	
	<div id="show_share_icons_nlm" style="display: none;">
	<a class="button" style="background-color:#3b5998;color:white;margin-right:4px;margin-left:100px;margin-top: 25px;" href="http://www.facebook.com/sharer/sharer.php?u=https://wordpress.org/plugins/newsletter-manager/&text='.$sharelink_text_nlm.'" target="_blank">Facebook</a>
	<a class="button" style="background-color:#00aced;color:white;margin-right:4px;margin-left:20px;margin-top: 25px;" href="http://twitter.com/share?url=https://wordpress.org/plugins/newsletter-manager/&text='.$sharelink_text_nlm.'" target="_blank">Twitter</a>
	<a class="button" style="background-color:#007bb6;color:white;margin-right:4px;margin-left:20px;margin-top: 25px;" href="http://www.linkedin.com/shareArticle?mini=true&url=https://wordpress.org/plugins/newsletter-manager/" target="_blank">LinkedIn</a>
	<a class="button" style="background-color:#dd4b39;color:white;margin-right:4px;margin-left:20px;margin-top: 25px;" href="https://plus.google.com/share?&hl=en&url=https://wordpress.org/plugins/newsletter-manager/" target="_blank">Google+</a>
	</div>
	
	
	
	</div>';
	
	
}
$nlm_installed_date = get_option('nlm_installed_date');
if ($nlm_installed_date=="") {
	$nlm_installed_date = time();
}

if($nlm_installed_date < ( time() - (30*24*60*60)))
{
	if (get_option('xyz_nlm_dnt_shw_notice') != "hide")
	{
		add_action('admin_notices', 'wp_nlm_admin_notice');
	}
}
?>
