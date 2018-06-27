<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 */
get_header(); 

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
?>
<?php 
$this_post = get_the_category();
//print_r($this_post);
//echo $this_post[0]->name;
?>
<style>
table {background:#000; text-align:center; border-spacing:1px; margin:0.5em 0; border-collapse: unset!important;}
sup {font-weight:700; font-size:0.8em;}
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
		@media(max-width: 768px){
	.col-lg-10{
					overflow: scroll;
		}
}
</style>


	<?php
		while ( have_posts() ) : the_post();?>
		<!-- standart-template -->
				<?php
				//print_r($this_post->name);
					if( strpos($this_post[0]->name, 'текст') !== false){?>
						<!-- AboveCat -->
						<?php 

							$rootCategory = $this_post[0]->parent; 
							$subCategories = [];
								$args = array('parent' => $rootCategory);
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

								<div class="container stall_inner">
								<div class="row">
									<div class="col-lg-1"></div>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-lg-12 breadcrumbs_container">
													<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
													<h1 class="page_title"><?php echo $title = get_term_meta( $rootCategory, 'mytxseo_seo_title', 1 ); ?></h1>
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
																		<a href="<?php echo get_permalink( $post_main->ID ); ?>" class="link">
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
												<div class="seo-cat-gallery" id="info">
													<?php
														$args_sub = array( 'category' => $subCategories[1],'posts_per_page'=>-1, 
														'numberposts'=>-1 );
														$posts_sub = get_posts( $args_sub );
															foreach( $posts_sub as $post_sub ){
																//print_r($post_sub);
																$featured_img_url = get_the_post_thumbnail_url($post_sub->ID, 'full');
																?>
																	<div class="seo-cat-gallery-item">
																		<a href="<?php echo get_permalink($post_sub->ID); ?>#info"> <img src="<?php echo $featured_img_url; ?>" alt=""></a>
																	</div>
																<?php ?>
																	
																<?php 
															}
													?>
												</div>
												<div class="seo-current-cut-text">
													<p>
													<?php the_post_thumbnail('full', array('class' => 'seo-thumb')); ?>
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
						<!-- AboveCat -->
					<?php }else{?>
						<!-- Details_template -->
						<?php
								/*
								* Include the post format-specific template for the content. If you want to
								* use this in a child theme, then include a file called content-___.php
								* (where ___ is the post format) and that will be used instead.
								*/?>

												<!-- таблица расчета параметров -->
												<div class="container">
														<div class="row">
																<div class="col-lg-1"></div>
																<div class="col-lg-10 col-12 goods_properties">
																<div class="breadcrumbs_container">
																<h1 class="page_title"><?php the_title(); ?></h1>
																	<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
															</div>

																</div>
																<div class="col-lg-1"></div>
														</div>
												</div>
												<!-- ./ таблица расчета параметров -->

										
												<div class="container">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
														<?php $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); ?>
																		<img src="<?php echo $featured_img_url ?>" alt="" style="float:left;width: calc(33.33% - 1em);">
																<?php the_content(); ?>
														</div>
														<div class="col-lg-1"></div>
													</div>
												</div>
						<!-- Details_template -->
					<?php }
				?>
		<!-- standart-template -->
		<?php endwhile; ?>
<?php
get_footer();
?>