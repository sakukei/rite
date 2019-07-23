<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header();
?>
<div id="primary" class="site-content">
	<div id="content" role="main">
	
	
		<div class="column-wrap">

			<h1 class="member_page_title"><?php _e('The new password acquisition', 'usces'); ?></h1>
					
			<div class="column">
			
			<?php if( have_posts() ) : usces_remove_filter(); ?>
		
				<article class="post" id="wc_<?php usces_page_name(); ?>">
		
					<div id="memberpages">
						<div class="whitebox">
		
							<div class="header_explanation">
								<?php do_action( 'usces_action_newpass_page_header' ); ?>
							</div><!-- .header_explanation -->
		
							<div class="error_message"><?php usces_error_message(); ?></div>
		
							<div class="loginbox">
								<form name="loginform" id="loginform" action="<?php usces_url('member'); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
									<table>
										<tr>
										<th><label><?php _e('e-mail adress', 'usces'); ?></label></th>
										<td><input type="text" name="loginmail" id="loginmail" class="loginmail" value="" size="20" /></td>
										</tr>
									</table>
									<div class="submit">
										<input type="submit" name="lostpassword" id="member_login" value="<?php _e('Obtain new password', 'usces'); ?>" />
									</div>
									<?php do_action( 'usces_action_newpass_page_inform' ); ?>
								</form>
		
								<div><?php _e('Change your password by following the instruction in this mail.', 'usces'); ?></div>
		
								<?php if( !usces_is_login() ) : ?>
								<p id="nav">
									<a href="<?php usces_url('login'); ?>" title="<?php _e('Log-in', 'usces'); ?>"><?php _e('Log-in', 'usces'); ?></a>
								</p>
								<?php endif; ?>
							</div><!-- .loginbox -->
		
							<div class="footer_explanation">
								<?php do_action( 'usces_action_newpass_page_footer' ); ?>
							</div><!-- .footer_explanation -->
		
						</div><!-- .whitebox -->
					</div><!-- #memberpages -->
		
					<script type="text/javascript">
						try{document.getElementById('loginmail').focus();}catch(e){}
					</script>
		
				</article><!-- .post -->
		
			<?php else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			
			</div><!-- .column -->
		</div><!-- .column-wrap -->

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
