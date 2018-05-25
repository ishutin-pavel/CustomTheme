<?php 

$rootCategory = getCurrentCatID(); 
print_r($rootCategory);
$anotherCategory = get_the_category_by_ID( $rootCategory );
print_r($anotherCategory);
$subCategories = [];
	$args = array('parent' => $rootCategory->category_parent);
	$categories = get_categories( $args );
	foreach($categories as $category) {
		array_push($subCategories, $category->term_id);
	}
	//print_r($subCategories);
?>
	<?php 
	$parent_term_id = $kat; // term id of parent term
	
	$args = array(
		'parent'         => $parent_term_id,
		// 'child_of'      => $parent_term_id, 
	); 
	
	$terms = get_terms($args);
	?>

<?php 
echo do_shortcode('[smartslider3 slider=2]');
?>
	<div class="container stall_inner">
	<div class="row">
		<div class="col-lg-1"></div>
			<div class="col-lg-10">
				<div class="row">
					<div class="col-lg-12 breadcrumbs_container">
						<h1 class="page_title"><?php echo $title = get_term_meta( $rootCategory, 'mytxseo_seo_title', 1 ); ?></h1>
						<div>
							<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
						</div>
					</div>
		<?php
			$args_main = array( 'category' => $subCategories[0], 'order'   => 'ASC','posts_per_page'=>-1, 
			'numberposts'=>-1  );
			$posts_main = get_posts( $args_main );
			//print_r($posts_main);
				foreach( $posts_main as $post_main ){
					$featured_img_url = get_the_post_thumbnail_url($post_main->ID, 'full'); 
					$post_meta = get_post_meta( $post_main->ID, 'short' );
					?>

					<!-- -->
										<div class="col-lg-12 card_item">
											<a href="#" class="link">
												<div>
													<img src="<?php echo $featured_img_url ?>" alt="">
												</div>
												<div>
													<ul>
														<li>
															
														<?php echo $post_main->post_title ?>
															
														</li>
														<li>
															
															<?php
																if(count($post_meta) == 1) {?>
																	<p><?php echo $post_meta[0]; ?></p>
																<?php }else{?>
																	<ul>
																<?php foreach( $post_meta as $meta_value ){	?>
																		<li>
																			<?php echo $meta_value ?>
																		</li>
																<?php } ?></ul><?php }?>
															</ul>
														</li>
													</ul>
												</div>
											</a>
										</div>
					<!-- -->

					<?php }
		?>

</div>
								</div>
							<div class="col-lg-1"></div>
						</div>
					</div>

<!-- Second block -->

    <section class="cat-description">
		<div class="container">
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
					<div class="seo-cat-gallery">
						<?php
							$args_sub = array( 'category' => $subCategories[1] );
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
                        <?php 
                            the_content();
                        ?>
						</p>
					</div>
				</div>
				<div class="col-lg-1"></div>
			</div>
		</div>
    </section>