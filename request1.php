<?php
/* Template Name: Zapros-1*/
get_header(); ?>

<?php 
echo do_shortcode('[smartslider3 slider=2]');
?>
<style>
    table {background:#000; text-align:center; border-spacing:1px; margin:0.5em 0;     border-collapse: unset!important;}
    sup {font-weight:700; font-size:0.8em;}
    textarea{ resize:none; margin: 0px; padding: 2px; width:100%; height:28px; font-size:1em; overflow:hidden;}
	.th td, .th th {background:#69f; color:#fff;}
	th {padding:0.125em 0.5em; background:#acf; font-weight:400; }
	td {padding:0.125em 0.5em; background:#cdf;}
	tr:not([class='th']) td {white-space:nowrap;}
	.spec {table-layout:fixed;}
	.spec td {color: #fff;background:#026eb6;padding:0.125em 0em; white-space:normal !important; cursor: pointer;}
	.spec td:hover {background:#ea1d24;}
	.spec .sel {background:#ea1d24;}
	.t10 {width:100%;}
	.t5 {width:50%;}
	.t3 {width:30%;}
	.pric td {padding:0;min-width:50px;}
	.pric th {min-width:50px;}
	.pric input {width:100%; height:100%; border:none; padding:0; margin:0; text-align:center;}
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	    -webkit-appearance: none;
	    margin: 0;
	}
	form{
		overflow: scroll;
	}
</style>
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