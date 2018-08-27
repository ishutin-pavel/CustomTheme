<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package alco
 */

get_header();

?>

<div class="container stall_inner">
	<div class="row">
		<div class="col-xl-1 col-lg-1"></div>
			<div class="col-xl-10 col-lg-12">
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
							<?php if(function_exists('bcn_display'))
							{
									bcn_display();
							}?>
					</div>

		<?php
		while ( have_posts() ) :
			the_post(); ?>

					<h1 class="page_title"><?php the_title(); ?></h1>
					<div class="entry-content">

						<?php
							the_post_thumbnail( 'medium', array(
								'class' => "img-thumbnail float-left",
							) );
							
							the_content();
						?>
					</div><!-- .entry-content -->

		<?php
		endwhile; // End of the loop.
		?>

		</div><!-- .col -->
	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();
