<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alco
 */

get_header();

?>

<div class="container stall_inner">
	<div class="row">
		<div class="col-xl-1 col-lg-1"></div>
			<div class="col-xl-10 col-lg-12">
				<div class="row">
					<div class="col-lg-12 breadcrumbs_container">
						<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
						<?php the_archive_title( '<h1 class="page_title">', '</h1>' ); ?>
					</div>
				</div>


		<?php if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'news' );

			endwhile; ?>

					<?php
					/** Bootstrap 4 pagination
					* 	for WordPress
					*/
						if ( function_exists('wp_bootstrap_pagination') )
						wp_bootstrap_pagination();
					
					?>

<?
		else :

			echo "<p>Нет записей</p>";

		endif;
		?>


		</div><!-- .col -->
	</div><!-- .row -->
</div><!-- .container -->
<?php
get_footer();
