<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments and the comment form.
 *
 * @package Brando
 */

/*
 * If the current post is protected by a password and the visitor has not yet entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php // Start Comments Area. ?>
<?php if ( have_comments() ) : ?>
	<div id="comments" class="comments-area">
		<?php // Start Check for comment navigation. ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'brando' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'brando' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'brando' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; ?>
		<?php // End Check for comment navigation. ?>

		<?php // If comments are closed and there are comments, let's leave a little note, shall we? ?>
		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'brando' ); ?></p>
		<?php endif; ?>

		<h5 class="widget-title no-margin"><?php  esc_html_e( 'Blog Comments', 'brando' ); ?></h5>
		<?php // Start Comment List. ?>
		<div class="comment-list margin-five-bottom">
			<?php   wp_list_comments( array(
						'style'      => 'div',
						'short_ping' => true,
						'avatar_size'=> 100,
						'callback' => 'brando_theme_comment'
					) );
				?>
		</div>
		<div class="bg-fast-yellow separator-line-thick-full no-margin-lr md-margin-eight-all md-no-margin-lr"></div>
		<?php // End Comment List. ?>

	
</div>
<?php endif; ?>
	    <!-- post comment form -->
            <div id="addcomment" class="col-md-12 col-sm-12 col-xs-12 no-padding-lr">
              	<span class="text-extra-large text-uppercase alt-font dark-gray-text display-block margin-six-bottom font-weight-600">	
              		<?php esc_html_e( 'Leave a Comment', 'brando' ); ?> 
              	</span>
                <div class="blog-comment-form">
                    <?php $comment_args = array(
                    'fields' => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<input id="author" name="author" type="text" class="big-input alt-font" onfocus="return inputfocus(this.id);" placeholder="'.esc_html__( '* Your Name','brando').'" value="' .esc_attr( $commenter['comment_author'] ) . '" size="30" />' ,
                    'email'  => '<input id="email" name="email" class="big-input alt-font" type="text" onfocus="return inputfocus(this.id);" placeholder="'.esc_html__( '* Your Email','brando').'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required/>' ,
                     )),
                    'comment_field' => '<textarea id="comment" class="big-input alt-font" name="comment" onfocus="return inputfocus(this.id);" placeholder="'.esc_html__( 'Your Message','brando').'" aria-required="true"></textarea>',
                    'comment_notes_after' => '<span class="margin-two-bottom required">'.esc_html__( '*Please complete all fields correctly','brando').'</span>',
                    'comment_notes_before' => '',
                    'id_form'           => 'commentform',
                    'id_submit'         => 'submit',
                    'class_submit'      => 'highlight-button-dark btn btn-medium comment-button',
                    'title_reply'       => esc_html__( '', 'brando' ),
                    'title_reply_to'    => esc_html__( 'post Leave a Reply to %s', 'brando' ),
                    'cancel_reply_link' => esc_html__( 'Cancel Reply', 'brando' ),
                    'label_submit'      => esc_html__( 'send message', 'brando' ),
                    );
	                comment_form($comment_args); ?>
                </div>
            </div>
                        <!-- end post comment form -->
<?php // End Comments Area. ?>