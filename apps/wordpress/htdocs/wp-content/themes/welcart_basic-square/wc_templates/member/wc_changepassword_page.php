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

			<h1 class="member_page_title"><?php _e('Change password', 'usces'); ?></h1>

			<div class="column">
			<?php if( have_posts() ) : usces_remove_filter(); ?>
		
				<article class="post" id="wc_<?php usces_page_name(); ?>">
		
					<div id="memberpages">
		
						<div class="header_explanation">
							<?php do_action( 'usces_action_changepass_page_header' ); ?>
						</div><!-- .header_explanation -->
		
						<div class="error_message"><?php usces_error_message(); ?></div>
		
						<div class="loginbox">
							<form name="loginform" id="loginform" action="<?php usces_url('member'); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
								<table>
									<tr>	
										<th><label><?php _e('password', 'usces'); ?></label></th>
										<td><input type="password" name="loginpass1" id="loginpass1" class="loginpass" value="" size="20" /></td>
									</tr>
									<tr>
										<th><label><?php _e('Password (confirm)', 'usces'); ?></label></th>
										<td><input type="password" name="loginpass2" id="loginpass2" class="loginpass" value="" size="20" /></td>
									</tr>
								</table>
								<div class="submit">
									<input type="submit" name="changepassword" id="member_login" value="<?php _e('Register', 'usces'); ?>" />
								</div>
								<?php do_action( 'usces_action_changepass_page_inform' ); ?>
							</form>
						</div>
		
						<div class="footer_explanation">
							<?php do_action( 'usces_action_changepass_page_footer' ); ?>
						</div><!-- .footer_explanation -->
		
					</div><!-- #memberpages -->
		
					<script type="text/javascript">
						try{document.getElementById('loginpass1').focus();}catch(e){}
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
