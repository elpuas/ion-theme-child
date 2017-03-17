<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Ion
 */
?>

				</div><!-- #main -->

			</div><!-- #page -->

			<div id="footer-menu">

				<?php

				$footer_menu_classes = 'tabs tabs-icon-top';

				$footer_menu_classes = apply_filters( 'appp_footer_menu_classes', $footer_menu_classes );

				$navargs = array(
					'menu_class'      => 'footer-menu ' . $footer_menu_classes,
					'theme_location' => 'footer-menu',
					'link_before' => '<div class="tab-item">',
					'link_after' => '</div>'
				);
				if( has_nav_menu( 'footer-menu' ) )
					wp_nav_menu( $navargs);
				?>
			</div>

		</div><!-- .menu-content. Left menu should be below. -->

		<div class="menu menu-left menu-layer">
			<div class="bar bar-header">
				<div class="brand-logo"><img src="<?php bloginfo('stylesheet_directory');?>/assets/img/logo-menu-left.png" /></div>
			</div>
      <div style="clear: both;width:100%"> &nbsp;</div>
			<div class="scroll-content ionic-scroll has-header">

				<div class="scroll">

				<?php appp_left_panel_before(); // Hook for search, user profile, and cart items ?>

				<div style="clear: both;width:100%; height:5px;"> &nbsp;</div>

				<?php
					$navargs = array(
						'menu_class'      => 'list',
						'theme_location' => 'primary-menu'
					);
					if( has_nav_menu( 'primary-menu' ) )
						wp_nav_menu( $navargs );
					?>

				<?php if( is_user_logged_in() ) : ?>
					<div class="item log-out-button"><a class="button button-block button-primary no-ajax" href="<?php echo wp_logout_url( apply_filters( 'appp_logout_redirect', home_url() ) ); ?>" title="<?php _e( 'Sign Out', 'appp_ion' ); ?>"><?php _e( 'Sign Out', 'appp_ion' ); ?></a></div>
				<?php else: ?>
					<div class="item log-out-button"><a class="button button-block button-primary no-ajax io-modal-open" href="#loginModal" title="<?php _e( 'Sign In', 'appp_ion' ); ?>"><?php _e( 'Sign In', 'appp_ion' ); ?></a></div>
				<?php endif; ?>

				</div><!-- .scroll -->

			</div><!-- .scroll-content -->

		</div><!-- .menu-left -->

</div><!-- #body-container -->
<div id="modal-fototipo" class="io-modal modal-fototipos">
    <div class="toolbar site-header">
			  <h3>Fototipos</h3>
        <i class="io-modal-close ion-close-circled alignright"></i>
    </div>
    <div class="modal-content">
      <ul>
				<li class="fototype-li fototype-one">Tipo 1 <i class="fototype-graph fototype-skin-one"></i></li>
				<li class="fototype-li fototype-two">Tipo 2 <i class="fototype-graph fototype-skin-two"></i></li>
				<li class="fototype-li fototype-three">Tipo 3 <i class="fototype-graph fototype-skin-three"></i></li>
				<li class="fototype-li fototype-four">Tipo 4 <i class="fototype-graph fototype-skin-four"></i></li>
				<li class="fototype-li fototype-five">Tipo 5 <i class="fototype-graph fototype-skin-five"></i></li>
				<li class="fototype-li fototype-six">Tipo 6 <i class="fototype-graph fototype-skin-six"></i></li>
			</ul>
		</div>
</div>
<?php wp_footer(); ?>

</body>
</html>
