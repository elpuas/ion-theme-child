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

		function woo_products_by_tags_shortcode( $atts, $content = null ) {

			// Get attribuets
					extract( shortcode_atts( array(
					'per_page' 		=> '12',
					'columns' 		=> '4',
					'orderby'   	=> 'title',
					'order'     	=> 'desc',
					'category'		=> '',
					'tags'          => '',
							), $atts ) );

			ob_start();

			// Define Query Arguments
			$args = array(
					'post_type'				=> 'product',
					'post_status' 			=> 'publish',
					'ignore_sticky_posts'	=> 1,
					'orderby' 				=> $ordering_args['orderby'],
					'order' 				=> $ordering_args['order'],
					'posts_per_page' 		=> $per_page,
					'product_tag'           => $tags,
				'tax_query' 			=> array(
						array(
							'taxonomy' 		=> 'product_cat',
							'terms' 		=> array( esc_attr( $category ) ),
							'field' 		=> 'slug',
							'operator' 		=> $operator

						))
				);

		ob_start();

				$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

				$woocommerce_loop['columns'] = $columns;

				if ( $products->have_posts() ) : ?>

					<?php woocommerce_product_loop_start(); ?>

						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>

				<?php endif;

				woocommerce_reset_loop();
				wp_reset_postdata();

				return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
			}

		add_shortcode("woo_products_by_tags", "woo_products_by_tags_shortcode");

		// Toolset Types
		
		 ?>
