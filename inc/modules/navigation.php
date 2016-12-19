<?php
/**
 * Header Navigation
 *
 * This is the template for all registered menus
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! function_exists( 'kids_education_navigation' ) ) :
	/**
	 * Add primary menu
	 *
	 * @since  Kids Education 1.0
	 *
	 */
	function kids_education_navigation() {
	?>
		<header id="masthead" class="site-header fixed-header is-sticky">
			<div class="container">

				<?php if( has_nav_menu( 'left-header-menu' ) ):
		
						$left_menu_args = array( 
							'theme_location' => 'left-header-menu', 
							'menu_id'        => 'primary-menu', 
							'menu_class'     => 'menu nav-menu',
							'container'      => 'nav',
							'container_id' 	 => 'site-navigation',
							'container_class' => 'main-navigation left-menu',
						);
						wp_nav_menu( $left_menu_args );
				
        			endif;
        		?>

        		<div class="site-branding">
          		<?php if ( has_custom_logo() ) : ?>
							<div class="site-logo">
            		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_custom_logo(); ?></a>
          		</div>
          		<?php endif; ?>
          			<div id="site-header">
          			<?php
						if ( is_front_page() || is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
						?>
					</div>
        		</div><!-- .site-branding -->

        		<?php if( has_nav_menu( 'right-header-menu' ) ):

	        			$right_menu_args = array( 
							'theme_location' => 'right-header-menu', 
							'menu_class'     => 'menu nav-menu',
							'container'      => 'nav',
							'container_class' => 'main-navigation right-menu',
						);
						wp_nav_menu( $right_menu_args );
        			endif;
        		?>

			</div><!-- .container -->
		</header><!--.site-header-->

		<!-- Left Mobile Menu -->
	    <nav id="sidr-left-top" class="mobile-menu sidr left">
	      	<div class="site-branding text-center">
	          	<?php if ( has_custom_logo() ) : ?>
								<div class="site-logo">
	            		<?php echo get_custom_logo(); ?>
	          		</div>
	          	<?php endif; ?>
	          	<div id="mobile-site-header">
	          	<?php
	          		if( !empty( bloginfo( 'name' ) ) ) :
						if ( is_front_page() || is_home() ){ ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php } else { ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
							}
					endif;
						
					if( !empty( get_bloginfo( 'description', 'display' ) ) ):
						$site_description = get_bloginfo( 'description', 'display' );?>
					 		<p class="site-description"><?php echo esc_html( $site_description ); ?></p>
				<?php
					endif;
				?>           
	        	</div><!-- .site-header -->
	      	</div><!-- .site-branding -->

		    <?php 
		      	if( has_nav_menu( 'left-header-menu' ) ):
			      	$mobile_left_menu = array(
						'theme_location'  => 'left-header-menu', 
						'menu_class'      => 'menu nav-menu',
						'container'       => false,
					);
					wp_nav_menu( $mobile_left_menu );
				endif;
		    ?>
	    </nav>
	    <?php if( has_nav_menu( 'left-header-menu' ) ) : ?>
	    <a id="sidr-left-top-button" class="menu-button left" href="#sidr-left-top"><i class="fa fa-bars"></i></a>
	    <?php endif; ?>

	    <!-- Right Mobile Menu -->
	    <nav id="sidr-right-top" class="mobile-menu sidr right">
	      	<div class="site-branding text-center">
	          	<?php if ( has_custom_logo() ) : ?>
								<div class="site-logo">
	            		<?php echo get_custom_logo(); ?>
	          		</div>
	          	<?php endif; ?>
	          	<div id="mobile-site-header">
	          	<?php
	          		if( !empty( bloginfo( 'name' ) ) ) :
						if ( is_front_page() || is_home() ){ ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php } else { ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
							}
					endif;
						
					if( !empty( get_bloginfo( 'description', 'display' ) ) ):
						$site_description = get_bloginfo( 'description', 'display' );?>
					 		<p class="site-description"><?php echo esc_html( $site_description ); ?></p>
				<?php
					endif;
				?>           
	        	</div><!-- .site-header -->
	      	</div><!-- .site-branding -->

		    <?php 
		      	if( has_nav_menu( 'right-header-menu' ) ):
			      	$mobile_right_menu = array(
						'theme_location'  => 'right-header-menu', 
						'menu_class'      => 'menu nav-menu',
						'container'       => false,
					);
					wp_nav_menu( $mobile_right_menu );
				endif;
		    ?>
	    </nav>
	    <?php if( has_nav_menu( 'right-header-menu' ) ) : ?>
	    <a id="sidr-right-top-button" class="menu-button right" href="#sidr-right-top"><i class="fa fa-bars"></i></a>
	    <?php endif;
	}
endif;
add_action( 'kids_education_header_action', 'kids_education_navigation', 10 );
