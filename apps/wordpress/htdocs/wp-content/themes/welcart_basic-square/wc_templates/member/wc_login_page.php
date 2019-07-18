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

		<h1 class="member_page_title"><?php _e('Log-in for members', 'usces'); ?></h1>
				
		<div class="column">
		
		<?php if( have_posts() ) : usces_remove_filter(); ?>
	
			<article class="post" id="wc_<?php usces_page_name(); ?>">
	
				<div id="memberpages">
					<div class="whitebox">

            <div class="form_header">
              <input name="top" class="top" type="button" value="<?php _e('閉じる', 'usces'); ?>"
                     onclick="location.href='<?php echo home_url(); ?>'"/>
            </div>

            <div class="logo">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_black.svg" alt="rite">
            </div>
	
						<div class="header_explanation">
							<?php do_action( 'usces_action_login_page_header' ); ?>
						</div><!-- .header_explanation -->
	
						<div class="error_message"><?php usces_error_message(); ?></div>
	
						<div class="loginbox cf">
						
							<div class="member-box">
                <p class="title">ログイン</p>
								<form name="loginform" id="loginform" class="loginform" action="<?php echo apply_filters( 'usces_filter_login_form_action', USCES_MEMBER_URL ); ?>" method="post">
                  <div class="loginmail">
                    <input type="text" name="loginmail" id="loginmail" value="<?php esc_attr_e(usces_remembername('return')); ?>" size="20" placeholder="<?php _e('e-mail adress', 'usces'); ?>"/>
                  </div>
                  <div class="loginpass">
                    <input type="password" name="loginpass" id="loginpass" size="20" placeholder="<?php _e('password', 'usces'); ?>"/>
                  </div>
									<p class="forgetmenot">
										<label><input name="rememberme" type="checkbox" class="checkbox" id="rememberme" value="forever" /> <span class="checkbox-text"><?php _e('memorize login information', 'usces'); ?></span></label>
									</p>
									<div class="submit">
										<?php usces_login_button(); ?>
									</div>
									<?php do_action( 'usces_action_login_page_inform' ); ?>
								</form>
		
								<p id="nav">
									<a href="<?php usces_url('lostmemberpassword'); ?>" title="<?php _e('Did you forget your password?', 'usces'); ?>"><?php _e('Did you forget your password?', 'usces'); ?></a>
								</p>
							
							</div><!-- memebr-box -->
							
							<div class="new-entry">
								<p class="title"><?php _e('Customers who are not member registration' , 'welcart_basic'); ?></p>
								<p id="nav">
									<a class="button" href="<?php usces_url('newmember') . apply_filters( 'usces_filter_newmember_urlquery', NULL ); ?>" title="<?php _e('New enrollment for membership.', 'usces'); ?>"><?php _e('New enrollment for membership.', 'usces'); ?></a>
								</p>
							</div><!-- new-entry -->
						
						</div><!-- .loginbox -->
						
						<div class="footer_explanation">
							<?php do_action( 'usces_action_login_page_footer' ); ?>
						</div><!-- .footer_explanation -->
	
					</div><!-- .whitebox -->
				</div><!-- #memberpages -->
	
				<script type="text/javascript">
			<?php if( usces_is_login() ) : ?>
					setTimeout( function(){ try{
					d = document.getElementById('loginpass');
					d.value = '';
					d.focus();
					} catch(e){}
					}, 200);
			<?php else : ?>
					try{document.getElementById('loginmail').focus();}catch(e){}
			<?php endif; ?>
				</script>
	
			</article><!-- .post -->
	
		<?php else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	
		</div><!-- .column -->
	</div><!-- .column-wrap -->
	
	</div><!-- #content -->
</div><!-- #primary -->

<?php //get_footer(); ?>
