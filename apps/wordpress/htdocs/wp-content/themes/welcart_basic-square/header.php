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
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>
		
		<header id="masthead" class="site-header" role="banner">

			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php 
					$logo = wcct_get_options('logo');
					if( empty($logo)): ?>
						<?php bloginfo( 'name' ); ?>
					<?php else: ?>
						<img src="<?php wcct_options('logo'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php endif; ?>	
				</a>
			</<?php echo $heading_tag; ?>>

			<?php if(! welcart_basic_is_cart_page()): ?>
			
			<div class="incart-btn">
				<?php if(! defined( 'WCEX_WIDGET_CART' ) ): ?>
					<a href="<?php echo USCES_CART_URL; ?>"><i class="fa fa-shopping-cart"></i><span class="total-quant" id="widgetcart-total-quant"><?php usces_totalquantity_in_cart(); ?></span></a>
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


			<div class="menu-bar">
				<a class="menu-trigger">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>

			<div id="mobile-menu">
			
				<div class="snav">
				
					<div class="search-box">
						<i class="fa fa-search"></i>
						<?php get_search_form(); ?>
					</div>
		
		
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
				
				</div><!-- .sub-nav -->


			<nav id="site-navigation" class="main-navigation" role="navigation">
	
				<?php 
					$page_c	=	get_page_by_path('usces-cart');
					$page_m	=	get_page_by_path('usces-member');
					$pages	=	"{$page_c->ID},{$page_m->ID}";
					wp_nav_menu( array( 'theme_location' => 'header', 'container_class' => 'nav-menu-open' , 'exclude' => $pages ,  'menu_class' => 'header-nav-container cf' ) );
				?>

			</nav><!-- #site-navigation -->
			
			</div><!-- #mobile-menu -->
			
			<?php endif; ?>
				
	
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
		