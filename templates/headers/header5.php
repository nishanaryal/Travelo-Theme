<?php
/**
 * Header 5
 */
global $trav_options, $logo_url, $my_account_page;
?>
<header id="header" class="navbar-static-top style5">
	<a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
		Mobile Menu Toggle
	</a>
	<div class="container">
		<h1 class="logo navbar-brand">
			<a href="<?php echo esc_url( home_url() ); ?>">
				<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo('name'); ?>" />
			</a>
		</h1>

		<?php if ( has_nav_menu( 'header-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'nav', 'container_id' => 'main-menu', 'menu_class' => 'menu', 'walker'=>new Trav_Walker_Nav_Menu ) ); 
			} else { ?>
				<nav id="main-menu" class="menu-my-menu-container">
					<ul class="menu">
						<li class="menu-item"><a href="<?php echo esc_url( home_url() ); ?>"><?php _e('Home', "trav"); ?></a></li>
						<li class="menu-item"><a href="<?php echo esc_url( admin_url('nav-menus.php') ); ?>"><?php _e('Configure', "trav"); ?></a></li>
					</ul>
				</nav>
		<?php } ?>
	</div>