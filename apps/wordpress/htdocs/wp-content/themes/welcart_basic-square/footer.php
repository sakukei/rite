
            </div><!-- .contents-column -->
        </div><!-- .l-inner -->
    </div><!-- #main -->

		<?php if(! wp_is_mobile()): ?>
		
			<div id="toTop" class="wrap fixed"><a href="#masthead"><i class="fa fa-angle-up"></i></a></div>
		
		<?php endif; ?>
		
		
		<footer id="colophon" role="contentinfo">

            <div class="l-inner">

                <div class="footer-column">
		
			<nav id="site-info" class="footer-navigation cf">
				<?php
					$page_c	=	get_page_by_path('usces-cart');
					$page_m	=	get_page_by_path('usces-member');
					$pages	=	"{$page_c->ID},{$page_m->ID}";
					wp_nav_menu(array( 'theme_location' => 'footer', 'exclude' => $pages , 'menu_class' => 'footer-menu cf' )); 
				?>
			</nav>

			<?php if( wcct_get_options( 'facebook_button' ) || wcct_get_options( 'twitter_button' ) || wcct_get_options( 'instagram_button' ) ): ?>
			<div class="sns-wrapper">
			<ul class="sns cf">
			
				<?php if(wcct_get_options('facebook_button')): ?>
				<li class="fb"><a target="_blank" href="https://www.facebook.com/<?php wcct_options('facebook_id'); ?>" rel="nofollow"><i class="fa fa-facebook-square"></i></a></li>
				<?php endif; ?>
	
				<?php if(wcct_get_options('twitter_button')): ?>
				<li class="twitter"><a target="_blank" href="https://twitter.com/<?php wcct_options('twitter_id'); ?>" rel="nofollow"><i class="fa fa-twitter-square"></i></a></li>
				<?php endif; ?>
	
				<?php if(wcct_get_options('instagram_button')): ?>
				<li class="insta"><a target="_blank" href="https://www.instagram.com/<?php wcct_options('instagram_id'); ?>" rel="nofollow"><i class="fa fa-instagram"></i></a></li>
				<?php endif; ?>
	
			</ul><!-- sns -->
                <p class="copyright"><?php usces_copyright(); ?></p>
			</div><!-- sns-wrapper -->
			<?php endif; ?>
			


                </div>

            </div>
		
		</footer><!-- #colophon -->

	</div><!-- wrapper -->

		
	<?php wp_footer(); ?>
	</body>
</html>
