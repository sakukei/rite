
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
                <ul>
                    <li class="page-item footer-about"><a href="http://company.rite.co.jp/" target="_blank">会社概要</a></li>
                </ul>
				<?php
					$page_c	=	get_page_by_path('usces-cart');
					$page_m	=	get_page_by_path('usces-member');
					$pages	=	"{$page_c->ID},{$page_m->ID}";
					wp_nav_menu(array( 'theme_location' => 'footer', 'exclude' => $pages , 'menu_class' => 'footer-menu cf' ));
				?>
                <ul>
                    <li class="page-item footer-contact"><a href="https://tayori.com/form/8efb7c3fbcb6b6d6cf6ab92d35f8bb1b7d053978" target="_blank">お問い合わせ</a></li>
                </ul>
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
            <script>
                jQuery(function($) {
                    // 関連商品にclass追加
                    $('.assistance_item').find('ul').addClass('slider');
                    // 関連商品の文言変更
                    $('.assistance_item').find('h3').html('関連おすすめ商品');
                    //　slickスライダーの設定
                    $('.slider').not('.slick-initialized').slick({
                        autoplay: true,
                        autoplaySpeed: 3000,
                        speed: 800,
                        dots: false,
                        arrows: false,
                        slidesToShow: 3,
                        touchMove: false,
                        responsive: [
                            {
                                breakpoint: 768, //767px以下のサイズに適用
                                settings: {
                                    slidesToShow: 1,
                                    speed: 400,
                                }
                            }
                        ]
                    });
                });
            </script>
	</body>
</html>
