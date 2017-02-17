<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Ion
 */

get_header(); ?>

<div id="content" class="site-content" role="main">
	<div class="row responsive-sm">
	<div class="col">
<h3>Resultado de la Busqueda</h3>

<?php if ( have_posts() ) : ?>

	<ul class="list">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', apptheme_get_list_type() ); ?>

	<?php endwhile; ?>

	</ul>

	<?php appp_content_nav( 'nav-below' ); ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'search' ); ?>

<?php endif; ?>
</div>
</div>
</div><!-- #content -->

<?php get_footer(); ?>
