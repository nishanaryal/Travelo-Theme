<?php
/**
 * Header 1
 */
global $trav_options, $logo_url;
?>
<header id="header" class="navbar-static-top style1">
	<div class="hidden-mobile container">
		<?php if ( ! empty ( $trav_options['phone_no'] ) ) { ?>
			<address class="contact-details">
				<span class="contact-phone"><i class="soap-icon-phone circle"></i> <?php echo esc_html( $trav_options['phone_no'] ) ?></span>
			</address>
		<?php } ?>
		<ul class="social-icons style2 clearfix">
			<?php
				$social_links = array( 'twitter', 'googleplus', 'facebook', 'linkedin', 'youtube', 'pinterest', 'vimeo', 'skype', 'instagram', 'dribble', 'flickr', 'tumblr', 'behance' );
				foreach ( $social_links as $key ) {
					if ( isset( $trav_options[$key] ) && ! empty( $trav_options[$key] ) ) {
						echo '<li class="' . esc_attr( $key ) . '"><a title="' . esc_attr( $key ) . '" href="' . esc_url( $trav_options[$key] ) . '" data-toggle="tooltip" target="_blank"><i class="soap-icon-' . esc_attr( $key ) . '"></i></a></li>';
					}
				}
			?>
		</ul>
	</div>

	<div class="container">
		<h1 class="logo navbar-brand">
			<a href="<?php echo esc_url( home_url() ); ?>">
				<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo('name'); ?>" />
			</a>
		</h1>
	</div>
	<a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
		Mobile Menu Toggle
	</a>

	<div id="main-menu">
		<?php if ( has_nav_menu( 'header-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'nav', 'container_class' => 'container', 'menu_class' => 'menu', 'walker'=>new Trav_Walker_Nav_Menu ) ); 
			} else { ?>
				<nav class="menu-my-menu-container container">
					<ul class="menu">
						<li class="menu-item"><a href="<?php echo esc_url( home_url() ); ?>"><?php _e('Home', "trav"); ?></a></li>
						<li class="menu-item"><a href="<?php echo esc_url( admin_url('nav-menus.php') ); ?>"><?php _e('Configure', "trav"); ?></a></li>
					</ul>
				</nav>
		<?php } ?>
	</div>