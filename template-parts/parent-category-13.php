<?php 
$rootCategory = getCurrentCatID(); 
$subCategories = [];
		?>
		<?php 
	$args = array('parent' => $rootCategory,'hide_empty' => 0);
	$categories = get_categories( $args );
	foreach($categories as $category) {
		array_push($subCategories, $category->term_id);
	}
	//print_r($subCategories);
?>
	<?php 
	$kat = '';
	$parent_term_id = $kat; // term id of parent term
	
	$args = array(
		'parent'         => $parent_term_id,
		// 'child_of'      => $parent_term_id, 
	); 
	
	$terms = get_terms($args);
	?>

	<div class="container stall_inner">
		<div class="row">
			<div class="col-xl-1 col-lg-0"></div>

			<div class="col-xl-10 col-lg-12">
				<div class="row">
					<div class="col-lg-12 breadcrumbs_container">
						<h1 class="page_title"><?php echo $title = get_term_meta( $rootCategory, 'mytxseo_seo_title', 1 ); ?></h1>
						<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
								<?php if(function_exists('bcn_display'))
								{
										bcn_display();
								}?>
						</div>
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
					<div class="seo-cat-gallery">
						<?php
							$args_sub = array( 'category' => $subCategories[1],'posts_per_page'=>-1, 
							'numberposts'=>-1 );
							$posts_sub = get_posts( $args_sub );
								foreach( $posts_sub as $post_sub ){
									//print_r($post_sub);
									$featured_img_url = get_the_post_thumbnail_url($post_sub->ID, 'full');
									?>
										<div class="seo-cat-gallery-item">
											<a href="<?php echo get_permalink($post_sub->ID); ?>"> <img src="<?php echo $featured_img_url; ?>" alt=""></a>
										</div>
									<?php ?>
										
									<?php 
								}
						?>
					</div>
					<div class="seo-current-cut-text">
						<p>
						<?php /*echo $posts_sub[0]->post_content */
							$category_id = get_queried_object();
							?>
						<?php $cat_seo_desc = get_term_meta( $category_id->term_id, 'mytxseo_cat_wysiwyg', 1 ); 
							echo apply_filters('the_content',$cat_seo_desc);
							?>
						</p>
					</div>
				</div>
				<div class="col-xl-1 col-lg-0"></div>
			</div>
		</div>
	</section>