<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 */
get_header();

function getCurrentCatID(){
	global $wp_query;
	if( is_category() || is_single() ) {
		$cat_ID = get_query_var('cat');
	}
	return $cat_ID;
}

function category_has_parent($catid){
	$category = get_category($catid);
	if ( $category->category_parent > 0 ) {
		return true;
	}
	return false;
}

$this_post = get_the_category();



	while ( have_posts() ) : the_post();
		$rootCategory = $this_post[0]->parent;

		$subCategories = [];

		$args = array('parent' => $rootCategory);

		$categories = get_categories( $args );

		foreach($categories as $category) {
			array_push($subCategories, $category->term_id);
		}

		$kat = '';
		$parent_term_id = $kat; // term id of parent term

		$args = array(
			'parent' => $parent_term_id,
		);

		$terms = get_terms($args);
?>

							<div class="container stall_inner">
								<div class="row">
									<div class="col-xl-1 col-lg-0"></div>
										<div class="col-xl-10 col-lg-12">
											<div class="row">
												<div class="col-lg-12 breadcrumbs_container">
													<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
															<?php if(function_exists('bcn_display'))
															{
																	bcn_display();
															}?>
													</div>
													<h1 class="page_title"><?php the_title(); ?></h1>
												</div>
											</div>
										</div>
									<div class="col-xl-1 col-lg-0"></div>
								</div>
							</div>

							<!-- Second block -->

								<section class="cat-description">
									<div class="container">
										<div class="row">
											<div class="col-xl-1 col-lg-0"></div>
											<div class="col-xl-10 col-lg-12">
												<div class="seo-cat-gallery" id="info">
													<?php
														$args_sub = array(
															'category' => $subCategories[1],
															'posts_per_page'=>-1,
															'numberposts'=>-1
															);
														$posts_sub = get_posts( $args_sub );
															foreach( $posts_sub as $post_sub ){
																//print_r($post_sub);
																$featured_img_url = get_the_post_thumbnail_url( $post_sub->ID, 'full' );
																$image_alt = get_post_meta(get_post_thumbnail_id( $post_sub->ID), '_wp_attachment_image_alt', true );
															}
													?>
												</div>
												<div class="seo-current-cut-text">
													<?php
														$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
														$image_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
													?>
													<a href="<?php echo $featured_img_url ?>" data-rel="lightbox" class="seo-thumb">  
														<img src="<?php echo $featured_img_url ?>" alt="<?php 
																if($image_alt != ''){
																echo $image_alt;
															} else { echo $post->post_title; } 
															?>">
													</a>
													<?php the_content(); ?>
												</div>
											</div>
											<div class="col-xl-1 col-lg-0"></div>
										</div>
									</div>
									</section>
						<!-- AboveCat -->

		<!-- standart-template -->
		<?php endwhile; ?>
<?php
get_footer();
?>