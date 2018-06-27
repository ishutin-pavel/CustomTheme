<?php get_header(); ?>
<?php
    function getCurrentCatID(){
		global $wp_query;
		if(is_category() || is_single()){
			$cat_ID = get_query_var('cat');
		}
		return $cat_ID;
	}
	function category_has_parent($catid){
		$category = get_category($catid);
		if ($category->category_parent > 0){
			return true;
		}
		return false;
	}

$rootCategory = getCurrentCatID();

?>

	<div class="container stall_inner">
	<div class="row">
		<div class="col-xl-1 col-lg-0"></div>
			<div class="col-xl-10 col-lg-12">
				<div class="row">
					<div class="col-lg-12 breadcrumbs_container">
						<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
						<h1 class="page_title"><?php echo $title = get_term_meta( $rootCategory, 'mytxseo_seo_title', 1 ); ?></h1>
					</div>

					<!-- Standart item template -->
		<?php
			$args_main = array( 'category' => 49, 'order'   => 'ASC','posts_per_page'=>-1, 
			'numberposts'=>-1  );
			$posts_main = get_posts( $args_main );
			//print_r($posts_main);
				foreach( $posts_main as $post_main ){
					$featured_img_url = get_the_post_thumbnail_url($post_main->ID, 'full'); 
					$post_meta = get_post_meta( $post_main->ID, 'short' );
					$linkTo = get_post_permalink( $post_main->ID ); 
					?>

					<!-- -->
										<div class="col-lg-12 card_item">
											<a href="<?php the_permalink( $post_main->ID ); ?>" class="link">
												<div>
													<img src="<?php echo $featured_img_url ?>" alt="">
												</div>
												<div>
													<ul class="main-ul">
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
					<!-- ./Standart item template -->
					
					
				</div>
				<div>
				<img class="textPic textPicB" src="/img/small/ruchnaja-cepnaja-tal.jpg" alt="Таль ручная цепная" onclick="ppicSwith(this)">
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

<!-- Second block -->
<?php get_footer();?>