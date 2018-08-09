<?php
/**
 * The template for displaying share buttons.
 *
 * @package Brando
 */
?>
<?php

// [brando_single_post_share] Shortcode.
if ( ! function_exists( 'brando_single_post_share_shortcode' ) ) :
	function brando_single_post_share_shortcode() {
		global $post;

		if(!$post) 
			return false;
		
	    $output = $border_bottom = '';
	    $brando_enable_social_icons = brando_option('brando_enable_social_icons');
		$brando_enable_facebook = (brando_option('brando_enable_facebook_sharing') == 1 ) ? brando_option('brando_enable_facebook_sharing') : '';
		$brando_enable_twitter = (brando_option('brando_enable_twitter_sharing') == 1 ) ? brando_option('brando_enable_twitter_sharing') : '';
		$brando_enable_google_plus = (brando_option('brando_enable_google_plus_sharing') == 1 ) ? brando_option('brando_enable_google_plus_sharing') : '';
		$brando_enable_linkedin = (brando_option('brando_enable_linkedin_sharing') == 1 ) ? brando_option('brando_enable_linkedin_sharing') : '';
		$brando_enable_pinterest = (brando_option('brando_enable_pinterest_sharing') == 1 ) ? brando_option('brando_enable_pinterest_sharing') : '';
		$brando_enable_delicious = (brando_option('brando_enable_delicious_sharing') == 1 ) ? brando_option('brando_enable_delicious_sharing') : '';
		$brando_enable_livejournal = (brando_option('brando_enable_livejournal_sharing') == 1 ) ? brando_option('brando_enable_livejournal_sharing') : '';
		$brando_enable_reddit = (brando_option('brando_enable_reddit_sharing') == 1 ) ? brando_option('brando_enable_reddit_sharing') : '';
		$brando_enable_stumbleupon = (brando_option('brando_enable_stumbleupon_sharing') == 1 ) ? brando_option('brando_enable_stumbleupon_sharing') : '';
		$brando_enable_digg = (brando_option('brando_enable_digg_sharing') == 1 ) ? brando_option('brando_enable_digg_sharing') : '';
		$brando_enable_tumblr = (brando_option('brando_enable_tumblr_sharing') == 1 ) ? brando_option('brando_enable_tumblr_sharing') : '';
		
		$permalink = get_permalink();
		$featuredimage =  wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		$featured_image = $featuredimage['0'];
		$post_title = rawurlencode(get_the_title($post->ID));
		
		ob_start();
		?>
		<div class="text-center col-md-12 col-sm-12 col-xs-12 no-padding-lr">
			<?php if($brando_enable_facebook == 1) { ?>
	            <a class="margin-two-lr" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo esc_attr($post_title); ?>"><i class="fa fa-facebook dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_twitter == 1) { ?>
	            <a class="margin-two-lr" href="https://twitter.com/share?url=<?php echo esc_url($permalink); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php echo esc_attr($post_title); ?>"><i class="fa fa-twitter dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_google_plus == 1) { ?>
	            <a class="margin-two-lr" href="//plus.google.com/share?url=<?php echo esc_url($permalink); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" title="<?php echo esc_attr($post_title); ?>"><i class="fa fa-google-plus dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_linkedin == 1) { ?>
				<a class="margin-two-lr" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo esc_attr($post_title); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" title="<?php echo $post_title; ?>"><i class="fa fa-linkedin dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_pinterest == 1) { ?>
				<a class="margin-two-lr" href="https://www.pinterest.com/pin/create/button/?url=<?php echo esc_url($permalink); ?>&amp;media=<?php echo $featured_image; ?>&amp;description=<?php echo get_the_excerpt() ?>" data-pin-custom="true"><i class="fa fa-pinterest dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_delicious == 1) { ?>.
				<a class="margin-two-lr" href="http://del.icio.us/post?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo esc_attr($post_title); ?>" data-pin-custom="true"><i class="fa fa-delicious dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_livejournal == 1) { ?>
				<a class="margin-two-lr" href="http://www.livejournal.com/update.bml?subject=<?php echo esc_attr($post_title); ?>&amp;event=<?php echo esc_url($permalink); ?>" data-pin-custom="true"><i class="el-icon-livejournal dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_reddit == 1) { ?>
				<a class="margin-two-lr" href="http://reddit.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo esc_attr($post_title); ?>" data-pin-custom="true"><i class="fa fa-reddit dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_stumbleupon == 1) { ?>
				<a class="margin-two-lr" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo esc_attr($post_title); ?>" data-pin-custom="true"><i class="fa fa-stumbleupon dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_digg == 1) { ?>
				<a class="margin-two-lr" href="http://www.digg.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo esc_attr($post_title); ?>" data-pin-custom="true"><i class="fa fa-digg dark-gray-text title-medium"></i></a>
			<?php } ?>
			<?php if($brando_enable_tumblr == 1) { ?>
				<a class="margin-two-lr" href="http://www.tumblr.com/share/link?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo esc_attr($post_title); ?>" data-pin-custom="true"><i class="fa fa-tumblr dark-gray-text title-medium"></i></a>
			<?php } ?>

			<div class="bg-fast-yellow separator-line-thick-full no-margin-lr md-margin-eight-all md-no-margin-lr"></div>
	    </div>
	    <?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
endif;
add_shortcode('brando_single_post_share','brando_single_post_share_shortcode');
?>