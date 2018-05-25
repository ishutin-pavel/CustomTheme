<?php
/*Template Name: Try-page */
?>
<?php get_header(); ?>
<h1>LOOOOOH</h1>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <?php
				// Start the Loop.
			while ( have_posts() ) :
				the_post();
				// Include the page content template.
				the_content();
				endwhile;
			?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
