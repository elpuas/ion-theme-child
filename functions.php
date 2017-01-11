<?php

// Enqueue Ion parent theme CSS file

add_action( 'wp_enqueue_scripts', 'appp_ion_enqueue_styles' );
function appp_ion_enqueue_styles() {

	// parent theme css
	$version = AppPresser_Ion_Theme_Setup::VERSION . '.' . filemtime( get_template_directory() . '/style.css' );
    wp_enqueue_style( 'ion-style', get_template_directory_uri().'/style.css', null, $version );

    // child theme css
		wp_enqueue_style( 'appderma-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,700', false );
		wp_enqueue_style( 'ion-child-style', get_stylesheet_uri(), null, filemtime( get_stylesheet_directory() . '/style.css' ) );
		wp_enqueue_style( 'material-style', get_stylesheet_directory_uri() . '/assets/css/main.min.css' );
		}

		// Add Cart Header
		function my_header_add_to_cart_fragment( $fragments ) {

		  ob_start();
		  $count = WC()->cart->cart_contents_count;
		  ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
		  if ( $count > 0 ) {
		      ?>
		      <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
		      <?php
		  }
		      ?></a><?php

		  $fragments['a.cart-contents'] = ob_get_clean();

		  return $fragments;
		}
		add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );






		 ?>
