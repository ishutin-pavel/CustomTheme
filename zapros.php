<?php
/* Template Name: Zapros*/
get_header(); ?>

<?php 
echo do_shortcode('[smartslider3 slider=2]');
?>

<div class="container">
    <div class="row">
		<div class="col-lg-1 col-md-1"></div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <?php
				// Start the Loop.
			while ( have_posts() ) :
                the_post();?>
                <div class="common-header"><?php the_title(); ?></div>
                <div class="col-lg-12 breadcrumbs_container">
                    <div>
                        <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                    </div>
                </div>
			<div id="page-container">
                <?php
				// Include the page content template.
				the_content();
				endwhile;
			?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1"></div>
    </div>
</div>
<?php get_footer(); ?>