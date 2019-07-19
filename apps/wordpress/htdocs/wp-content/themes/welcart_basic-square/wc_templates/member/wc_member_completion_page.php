<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header();
?>

<div id="primary" class="site-content member">
	<div id="content" role="main">

		<div class="column-wrap">

			<h1 class="member_page_title"><?php _e('Completion', 'usces'); ?></h1>

			<div class="column">
			
			<?php if( have_posts() ) : usces_remove_filter(); ?>
		
				<article class="post" id="wc_<?php usces_page_name(); ?>">
		
					<div id="memberpages">

            <div class="logo">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_black.svg" alt="rite">
            </div>
		
						<div class="header_explanation">
							<?php do_action( 'usces_action_membercompletion_page_header' ); ?>
						</div><!-- .header_explanation -->
		
						<?php $member_compmode = usces_page_name('return'); ?>
						<div class="completion-text">
							<?php if( 'newcompletion' == $member_compmode ) : ?>
								<p><?php _e('Thank you in new membership.', 'usces'); ?></p>

							<?php elseif( 'editcompletion' == $member_compmode ) : ?>
								<p><?php _e('Membership information has been updated.', 'usces'); ?></p>
			
							<?php elseif( 'lostcompletion' == $member_compmode ) : ?>
								<p class="sent-text"><?php _e('I transmitted an email.', 'usces'); ?></p>
								<p><?php _e('Change your password by following the instruction in this mail.', 'usces'); ?></p>
			
							<?php elseif( 'changepasscompletion' == $member_compmode ) : ?>
								<p><?php _e('Password has been changed.', 'usces'); ?></p>
			
							<?php endif; ?>
						</div>
		
						<div class="footer_explanation">
							<?php do_action( 'usces_action_membercompletion_page_footer' ); ?>
						</div><!-- .footer_explanation -->
		
						<p><a href="<?php usces_url('member'); ?>" class=" class="completion-btn""><?php _e('to vist membership information page', 'usces'); ?></a></p>
		
						<div class="send">
							<a href="<?php echo home_url(); ?>" class="back_to_top_button completion-btn"><?php _e('Back to the top page.', 'usces'); ?></a>
						</div>
					</div><!-- #memberpages -->
		
				</article><!-- .post -->
		
			<?php else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			
			</div><!-- .column -->
		</div><!-- .column-wrap -->

	</div><!-- #content -->
</div><!-- #primary -->

<?php //get_footer(); ?>
