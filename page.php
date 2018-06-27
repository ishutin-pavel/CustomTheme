<?php get_header(); ?>

<div class="container">
	<div class="row">

		<div class="col-xl-1 col-lg-0 col-md-0"></div>

		<div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="menu-holder">
			<?php wp_nav_menu( array('menu' => 'page-menu' )); ?>
			</div>
			<div id="page-container">
				<?php
					// Start the Loop.
					while ( have_posts() ) :
					the_post();
					// Include the page content template.
					the_content();
				endwhile;
				?>
			</div>
		</div><!-- .col -->

		<div class="col-xl-1 col-lg-0 col-md-0"></div>

	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>