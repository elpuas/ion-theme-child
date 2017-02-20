<?php
/**
 * @package Ion
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="apple-mobile-web-app-capable" content="yes">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action('appp_after_body'); ?>

<div id="body-container">

		<div id="menu-content" class="menu-content pane menu-animated">

			<header class="bar bar-header">

				<div class="buttons">

					<?php  do_action( 'appp_header_left' ); ?>

					<button id="nav-left-open" class="nav-left-btn button button-icon icon ion-navicon"></button>

				</div>
				<div class="logo-header">
				<img src="<?php bloginfo('stylesheet_directory');?>/assets/img/logo-large.png" class="logo-responsive" />
				</div>
				<div class="buttons cart-icon">

					<!-- Add Cart Icon -->
					<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

						$count = WC()->cart->cart_contents_count;
							?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
						if ( $count > 0 ) {
							?>
						<span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
					<?php
								}
						?></a>

					<?php } ?>

				</div>

			</header><!-- #masthead -->

			<div id="page" class="hfeed site">
				<?php do_action( 'appp_before' ); ?>

				<div id="main" <?php body_class( 'site-main' ); ?>>
