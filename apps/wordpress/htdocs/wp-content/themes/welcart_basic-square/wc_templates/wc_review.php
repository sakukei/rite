<?php
/**
 * @package Welcart
 * @subpackage Welcart Bordeaux Theme
 */

if( !wcct_get_options( 'review' ) )
	return;

/* It does not display anything when you do not accept the comment. */
if ( comments_open() ) :
?>

<div id="wc_reviews" class="tab-box">
	
<?php 
if( usces_is_membersystem_state() ):
	/* Only when you are logged in Welcart, the comment form is displayed. */
	if ( usces_is_login() ) :
	
		$formargs = array(
			'id_form'           => 'reviewform',
			'id_submit'         => 'submit',
			'title_reply'       => '',
			'title_reply_to'    => '',
			'cancel_reply_link' => '',
			'label_submit'      => __( 'Submit a review' , 'welcart_basic_square' ),

			'comment_field' =>  '<p class="review-form-review"><label for="comment">' . __( 'Please post a review on this product.', 'welcart_basic_square' ) .
			'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
			'</textarea></p>',

			'must_log_in' => '',
			'logged_in_as' => '',
			'comment_notes_before' => '',
			'comment_notes_after' => '<p>' . __( 'Nickname will be published.' , 'welcart_basic_square' ) . '</p>',

			'fields' => array(
				'author' =>
				'<p class="comment-form-author">' .
				'<label for="author">' . __( 'Nickname', 'welcart_basic_square' ) . '</label> ' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30" /></p>'
			),
		);
		comment_form($formargs);
		
	else: // if not Welcart login()
?>

		<p class="nowc_reviews"><?php _e( 'When you log in you can post a review.', 'welcart_basic_square' ); ?></p>
		<p class="reviews_btn"><a href="<?php echo add_query_arg(array('login_ref' => urlencode((empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"])), USCES_MEMBER_URL); ?>"><?php _e( 'To login', 'welcart_basic_square' ); ?></a></p>

<?php
	endif; // end ! usces_is_login()
endif; // end ! usces_is_membersystem_state()

	/* If this product has review */
	if ( have_comments() ) :
		if ( 0 < get_comments_number() ) :
?>

	<h3 id="wc_reviews-title">

<?php
			$product_name = get_post_meta( $post->ID, '_itemName', true );
			printf( _n( 'One Review to %2$s', '%1$s Reviews to %2$s', get_comments_number(), 'welcart_basic_square' ),
			number_format_i18n( get_comments_number() ), '<span>' . esc_html($product_name) . '</span>' );
?>

	</h3>

<?php endif; ?>

	<ol class="wc_reviewlist cf">

<?php
		$listargs = array( 
			'type' => 'comment',
			'callback' => 'wc_review',
		);
		wp_list_comments( $listargs );
?>

	</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?> 
			<div id="review-paginate">
				<?php paginate_comments_links(); ?>
			</div><!-- #review-paginate -->
		<?php endif; ?>
	
<?php else : // or, if we don't have reviews ?>

	<p class="nowc_reviews"><?php _e( 'We hope that you will post a review.', 'welcart_basic_square' ); ?></p>

<?php
	endif; // end have_comments()
?>
	
</div><!-- #wc_reviews -->

<?php
endif; // end ! comments_open()

