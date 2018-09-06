<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="format-detection" content="telephone=no"/>
	
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>	

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php 
		$opt  = ' class="display-desc"';	
	?>
	
	<div id="wrapper"<?php if(wcct_get_options('display_description')){ echo $opt; } ?>>

		<?php if( wcct_get_options('display_description')): ?>
            <p class="szite-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>
		
		<header id="masthead" class="site-header" role="banner">

            <div class="l-inner">

                <div class="header-column">

            <div id="mobile-menu">

                <div class="snav">

                    <div class="search-box">
<!--                        <i class="fa fa-search"></i>-->
                        <?php get_search_form(); ?>
                        <div class="snav snav-sp">
                            <?php if(usces_is_membersystem_state()): ?>
                                <div class="membership">
                                    <i class="fa fa-user"></i>
                                    <ul class="cf">
                                        <?php if( usces_is_login() ): ?>
                                            <li><?php printf(__('Hello %s', 'usces'), usces_the_member_name('return')); ?></li>
                                            <li><?php usces_loginout(); ?></li>
                                            <li><a href="<?php echo USCES_MEMBER_URL; ?>"><?php _e('My page', 'welcart_basic') ?></a></li>
                                        <?php else: ?>
                                            <li><?php _e('guest', 'usces'); ?></li>
                                            <li><?php usces_loginout(); ?></li>
                                            <li><a href="<?php echo USCES_NEWMEMBER_URL; ?>"><?php _e('New Membership Registration','usces') ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

<!--                    --><?php
//                    $page_c	=	get_page_by_path('usces-cart');
//                    $page_m	=	get_page_by_path('usces-member');
//                    $pages	=	"{$page_c->ID},{$page_m->ID}";
//                    wp_nav_menu(array( 'theme_location' => 'header', 'exclude' => $pages , 'menu_class' => 'header-menu cf' ));
//                    ?>
<!--                    <ul class="header-contact">-->
<!--                        <li><a href="https://tayori.com/form/078ee5a1e0088817f71e52826b33aeaa32485dda" target="_blank">お問い合わせ</a></li>-->
<!--                    </ul>-->


<!--                    					--><?php //if(usces_is_membersystem_state()): ?>
<!--                    					<div class="membership">-->
<!--                    						<i class="fa fa-user"></i>-->
<!--                    						<ul class="cf">-->
<!--                    							--><?php //if( usces_is_login() ): ?>
<!--                    								<li>--><?php //printf(__('Hello %s', 'usces'), usces_the_member_name('return')); ?><!--</li>-->
<!--                    								<li>--><?php //usces_loginout(); ?><!--</li>-->
<!--                    								<li><a href="--><?php //echo USCES_MEMBER_URL; ?><!--">--><?php //_e('My page', 'welcart_basic') ?><!--</a></li>-->
<!--                    							--><?php //else: ?>
<!--                    								<li>--><?php //_e('guest', 'usces'); ?><!--</li>-->
<!--                    								<li>--><?php //usces_loginout(); ?><!--</li>-->
<!--                    								<li><a href="--><?php //echo USCES_NEWMEMBER_URL; ?><!--">--><?php //_e('New Membership Registration','usces') ?><!--</a></li>-->
<!--                    							--><?php //endif; ?>
<!--                    						</ul>-->
<!--                    					</div>-->
<!--                    					--><?php //endif; ?>

                </div><!-- .sub-nav -->


                <nav id="site-navigation" class="main-navigation" role="navigation">

                    <?php
                    $page_c	=	get_page_by_path('usces-cart');
                    $page_m	=	get_page_by_path('usces-member');
                    $pages	=	"{$page_c->ID},{$page_m->ID}";
                    wp_nav_menu( array( 'theme_location' => 'header', 'container_class' => 'nav-menu-open' , 'exclude' => $pages ,  'menu_class' => 'header-nav-container cf' ) );
                    ?>

                </nav><!-- #site-navigation -->

                <div class="snav-sidebar">
                    <section class="sidebar sidebar-item">
                        <h3 class="sidebar-title">お買い物検索</h3>
                        <ul class="sidebar-list">
                            <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/fashion"><img src="<?php echo get_template_directory_uri(); ?>/images/sidebar-fashion.png" alt=""><span>ファッション</span></a></li>
                        </ul>
                    </section>
                    <section class="sidebar sidebar-area">
                        <h3 class="sidebar-title">エリア検索</h3>
                        <ul class="sidebar-list">
<!--                            <li><a href="--><?php //get_stylesheet_directory_uri(); ?><!--/tag/thailand"><img src="--><?php //echo get_template_directory_uri(); ?><!--/images/sidebar-thailand.png" alt="">タイ</a></li>-->
<!--                            <li><a href="--><?php //get_stylesheet_directory_uri(); ?><!--/tag/vietnam"><img src="--><?php //echo get_template_directory_uri(); ?><!--/images/sidebar-vietnam.png" alt="">ベトナム</a></li>-->
<!--                            <li><a href="--><?php //get_stylesheet_directory_uri(); ?><!--/tag/hongkong"><img src="--><?php //echo get_template_directory_uri(); ?><!--/images/sidebar-hongkong.png" alt="">香港</a></li>-->
<!--                            <li><a href="--><?php //get_stylesheet_directory_uri(); ?><!--/tag/taiwan"><img src="--><?php //echo get_template_directory_uri(); ?><!--/images/sidebar-taiwan.png" alt="">台湾</a></li>-->
                            <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/korea"><img src="<?php echo get_template_directory_uri(); ?>/images/sidebar-korea.png" alt="">韓国</a></li>
                            <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/bali"><img src="<?php echo get_template_directory_uri(); ?>/images/sidebar-bali.png" alt=""><span>バリ</span></a></li>
                        </ul>
                    </section>
                    <section class="sidebar sidebar-contributor">
                        <h3 class="sidebar-title">たびびと検索</h3>
                        <ul class="sidebar-list">
                            <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/ayasuke_0516/"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_hasegawa_aya.jpeg" alt=""><span>長谷川あや</span></a></li>
                            <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/hitostagram12"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_yoshino_hitomi.jpeg" alt=""><span>良野仁美</span></a></li>
                        </ul>
                    </section>
                </div>

            </div><!-- #mobile-menu -->

                    <div class="header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/header-logo.png" alt="rite"></a></div>



			<?php if(! welcart_basic_is_cart_page()): ?>

            <div class="header-link-block">

                <div class="header-menber-wrap">

                    <div class="snav">
                        <?php if(usces_is_membersystem_state()): ?>
                            <div class="membership">
                                <i class="fa fa-user"></i>
                                <ul class="cf">
                                    <?php if( usces_is_login() ): ?>
                                        <li><?php printf(__('Hello %s', 'usces'), usces_the_member_name('return')); ?></li>
                                        <li><?php usces_loginout(); ?></li>
                                        <li><a href="<?php echo USCES_MEMBER_URL; ?>"><?php _e('My page', 'welcart_basic') ?></a></li>
                                    <?php else: ?>
                                        <li><?php _e('guest', 'usces'); ?></li>
                                        <li><?php usces_loginout(); ?></li>
                                        <li><a href="<?php echo USCES_NEWMEMBER_URL; ?>"><?php _e('New Membership Registration','usces') ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="header-link-wrap">
                        <p class="header-link"><a href="https://tayori.com/form/078ee5a1e0088817f71e52826b33aeaa32485dda" target="_blank">お問い合わせ</a></p>
                    </div>

                </div>

                <div class="incart-btn">
                    <?php if(! defined( 'WCEX_WIDGET_CART' ) ): ?>
                        <a href="<?php echo USCES_CART_URL; ?>" class="header-incart-btn">
                            <span class="incart-btn-text">カートを見る</span>
                        <i class="fa fa-shopping-cart"></i><span class="total-quant" id="widgetcart-total-quant"><?php usces_totalquantity_in_cart(); ?></span>
                        </a>
                    <?php else: ?>
                        <i class="fa fa-shopping-cart widget-cart"></i><span class="total-quant" id="widgetcart-total-quant"><?php usces_totalquantity_in_cart(); ?></span>

                        <div class="view-cart">
                            <ul class="wcex_widgetcart_body ucart_widget_body"><li>
                                <?php if( usces_is_login() && usces_is_membersystem_point() ): ?>
                                <div id="wgct_point">
                                <span class="wgct_point_label"><?php _e('Your member points', 'widgetcart'); ?></span> : <span class="wgct_point"><?php usces_memberinfo( 'point' ); ?></span>pt
                                </div>
                                <?php endif; ?>
                                <div id="wgct_row">
                                <?php echo widgetcart_get_cart_row(); ?>
                                </div>
                            </li></ul>
                        </div><!-- .view-cart -->
                        <div id="wgct_alert"></div>


                    <?php endif; ?>
                </div>

            </div>


			<div class="menu-bar">
				<a class="menu-trigger">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>


			
			<?php endif; ?>

                </div>

            </div>
				
	
		</header><!-- #masthead -->


		<?php
			
			if( is_front_page() || is_home() || is_archive() || is_category() || is_search() || is_404() ) {
				
				$class = 'two-column';
					
			}elseif( welcart_basic_is_cart_page() ){
				
				$class = 'two-column cart-page';
			
			}elseif( welcart_basic_is_member_page() ) {
				
				$class = 'two-column member-page';
				
			}elseif( welcart_search_page() ) {
			
				$class = 'two-column search-page';
			
			}else {
				
				$class = 'three-column';
				
			};
		?>

		<div id="main" class="cf <?php echo $class;?>">
            <div class="l-inner">
<!--                <div class="contents-column">-->