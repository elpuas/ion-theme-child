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
		wp_enqueue_script( 'app-scripts', get_stylesheet_directory_uri() . '/assets/js/app-scripts.js', array(), '1.0.0', true );
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

     // Add Tag Shortcodes - Author Remi Corson

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


// Remove Billing Postal Code

add_filter( 'woocommerce_checkout_fields' , 'appderma_override_checkout_fields' );

function appderma_override_checkout_fields( $fields ) {
     unset($fields['billing']['billing_postcode']);

     return $fields;
}

// Add a Custom field Billing ID

add_filter( 'woocommerce_checkout_fields' , 'appderma_add_checkout_fields' );

function appderma_add_checkout_fields( $fields ) {
     $fields['billing']['billing_id'] = array(
        'label'     => __('DNI/RUC', 'woocommerce'),
        'placeholder'   => _x('DNI/RUC', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'clear'     => true
     );

     return $fields;
}

/**
 * Display field value on the order edit page
 */

add_action( 'woocommerce_admin_order_data_after_shipping_address', 'appderma_checkout_field_display_admin_order_meta', 10, 1 );

function appderma_checkout_field_display_admin_order_meta($order){
    echo '<p>'.__('DNI o RUC').': ' . get_post_meta( $order->id, '_billing_id', true ) . '</p>';
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'appderma_checkout_field_update_order_meta' );

function appderma_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_id'] ) ) {
        update_post_meta( $order_id, 'DNI/RUC', sanitize_text_field( $_POST['billing_id'] ) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'appderma_dni_checkout_field_display_admin_order_meta', 10, 1 );

function appderma_dni_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('DNI/RUC').':</strong> ' . get_post_meta( $order->id, 'DNI/RUC', true ) . '</p>';
}

// Change Order Comments
add_filter( 'woocommerce_checkout_fields' , 'appderma_order_comments_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function appderma_order_comments_checkout_fields( $fields ) {
     $fields['order']['order_comments']['placeholder'] = 'A que Hora te gustaria la entrega';
     return $fields;
}

// Add Custom Field to Order Email

add_filter('woocommerce_email_order_meta_keys', 'appderma_order_meta_keys');

function appderma_order_meta_keys( $keys ) {
     $keys[] = 'DNI/RUC'; // This will look for a custom field called 'DNI/RUC' and add it to emails
     return $keys;
}

		 ?>
