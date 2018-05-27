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
?>

<?php echo do_shortcode('[smartslider3 slider=2]'); ?>

<?php
	while ( have_posts() ) : the_post();
	// standart-template
	if( strpos($this_post[0]->name, 'текст') !== false){

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

<?php echo do_shortcode('[smartslider3 slider=2]'); ?>

							<div class="container stall_inner">
								<div class="row">
									<div class="col-xl-1 col-lg-0"></div>
										<div class="col-xl-10 col-lg-12">
											<div class="row">
												<div class="col-lg-12 breadcrumbs_container">
													<?php if( function_exists('dimox_breadcrumbs') ) dimox_breadcrumbs(); ?>
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
					<?php
						} else {
								the_content();
					?>
												<!-- таблица расчета параметров -->
												<div class="container">
														<div class="row">
																<div class="col-xl-1 col-lg-0"></div>
																<div class="col-xl-10 col-lg-12 col-12 goods_properties">
																<div class="breadcrumbs_container">
																	<?php if( function_exists('dimox_breadcrumbs') ) dimox_breadcrumbs(); ?>
																	<h1 class="page_title"><?php the_title(); ?></h1>
															</div>
															<?php if( have_rows('var') ) : ?>
																		<div class="properties_table" style="margin-top:10px;">
																				<p>Грузоподъемность:</p>
																				<ul>
																					<?php
																						$initActive = 0;
																						$setActive = 0;
																						while( have_rows('var') ): the_row();
																						$gryz = get_sub_field('gryz_id');
																						$dataVal = get_sub_field('gryz_val');
																						$numrows = count( get_field( 'var' ) );
																						
																						$c_width = 100 / $numrows;
																					?>
																					<li style="width:<?php echo $c_width ?>%;" class="gryz_id<?php if($initActive < 1){echo ' active_gryz';$initActive++;} ?>" data-toggler="<?php echo $dataVal; ?>"><?php echo $gryz; ?></li>
																						<?php endwhile; ?>
																				</ul>
																		</div>
																		<?php endif; ?>
																</div>
																<div class="col-xl-1 col-lg-0"></div>
														</div>
												</div>
												<!-- ./ таблица расчета параметров -->

												<!-- таблица расчета параметров -->
												<div class="container" style="margin-top:10px;">
														<div class="row">
																<div class="col-xl-1 col-lg-0"></div>
																<div class="col-xl-10 col-lg-12 goods_properties">
																<?php if( have_rows('variationss') ): ?>
																		<div class="properties_table">
																				<p>Пролет:</p>
																				<ul>
																					<?php 
																						$initActive = 0;
																						$setActive = 0;
																						while( have_rows('variationss') ): the_row();
																							$prolet = get_sub_field('text');
																							$dataVal = get_sub_field('value');
																							$numrows = count( get_field( 'variationss' ) );
																							$c_width = 100 / $numrows;?>
																						<li style="width:<?php echo $c_width ?>%;" class="prolet_id<?php if($initActive < 1){echo ' active_prolet';$initActive++;} ?>" data-toggler="<?php echo $dataVal; ?>"><?php echo $prolet; ?></li>
																					<?php endwhile; ?>
																				</ul>
																		</div>
																		<?php endif; ?>
																</div>
																<div class="col-xl-1 col-lg-0"></div>
														</div>
												</div>
												<!-- ./ таблица расчета параметров -->

												<!--request-->
												<div class="container request" style="margin-top:12px;">
														<div class="row">
																<div class="col-xl-1 col-lg-0"></div>
																<div class="col-xl-5 col-lg-6 col-12 image">
																<?php
																	$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
																	$image_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
																?>

																<!-- Sm-Gallery -->
																<?php if( have_rows('gallery_body') ): ?>
																	<div class="sm-galerry">
																		<?php while( have_rows('gallery_body') ): the_row(); ?>
																			<?php $image_temp = get_sub_field('small_gallery_item');?>
																			<span class="sm-gallery-item">  
																				<img src="<?php echo $image_temp['url']; ?>" alt="<?php if($image_temp['alt'] != ''){echo $image_temp['alt']; }else{echo $post->post_title; } ?>">
																			</span>
																		<?php endwhile; ?>
																	</div>
																<?php endif; ?>
																	<!-- ./Sm-Gallery -->

																<div class="images-cont">
													<!-- I -->
													<?php if( have_rows('art+price') ): ?>
														<?php while( have_rows('art+price') ): the_row(); ?>
															<?php $image_temp = get_sub_field('img'); ?>
															<?php $current_row_id = get_sub_field('id'); ?>
															<?php if($image_temp != ''){ ?>
															<a href="<?php echo $image_temp['url']; ?>" data-rel="lightbox" class="<?php the_sub_field('id'); ?>">  
																<img src="<?php echo $image_temp['url']; ?>" alt="<?php if($image_temp['alt'] != ''){echo $image_temp['alt']; }else{echo $post->post_title; } ?>">
															</a>
															<?php }else{ ?>
																<a href="<?php echo $featured_img_url; ?>" data-rel="lightbox" class="<?php the_sub_field('id'); ?>">  
																	<img src="<?php echo $featured_img_url; ?>" alt="<?php if($image_alt != ''){ echo $image_alt; } else { echo $post->post_title; } ?>">
																</a>
															<?php } ?>
														<?php endwhile; ?>
													<?php endif; ?>
													<!-- ./I -->
																</div>
																</div>
																<div class="col-xl-5 col-lg-6 col-12 button">
																		<ul>
																				<li>Арт.: <span class="articul">
																					<!-- A -->
																					<?php if( have_rows('art+price') ): ?>
																							<?php while( have_rows('art+price') ): the_row(); ?>
																					
																									<span class="<?php the_sub_field('id'); ?>"><?php the_sub_field('art'); ?></span>
																									
																							<?php endwhile; ?>
																					<?php endif; ?>
																					<!-- ./A -->
																				</span>
																				</li>
																				<li>Цена: <span class="price">
																					<!-- P -->
																					<?php if( have_rows('art+price') ): ?>
																							<?php while( have_rows('art+price') ): the_row(); ?>
																					
																									<span class="<?php the_sub_field('id'); ?>">
																										<?php $sub_field_price = get_sub_field('price'); 
																										
																										if($sub_field_price == "по запросу" || $sub_field_price == "договорная"){
																											?>
																											<span class="dogovor <?php the_sub_field('id'); ?>"><?php echo $sub_field_price; ?></span><?php
																										}else{
																											?><span class="<?php the_sub_field('id'); ?>"><?php echo $sub_field_price . ' p.';?></span><?php
																										}
																										?>
																									</span>
																									
																							<?php endwhile; ?>
																					<?php endif; ?>
																					<!-- ./P -->
																				</span>
																				</li>
																				<?php $cat__ = get_the_category(); $cat__ = $cat__[0]; ?>
																				<li>
																					<a href="<?php echo $zapros_link = get_term_meta( $cat__->term_id, 'mytxseo_forma', 1 ); ?>" class="zapros">Оставить заявку на оборудование</a>
																				</li>
																				<li>Доставка: транспортная компания <br>Самовывоз: Московская область, г. Краснознаменск</li>
																				<li><a href="/delivery" class="pricing">Подробнее о доставке и оплате</a></li>
																				<li><?php echo $garantiya = get_term_meta( $cat__->term_id, 'mytxseo_garantiya', 1 ); ?></li>
																		</ul>
																</div>
																<div class="col-xl-1 col-lg-0"></div>
														</div>
												</div>
												<!--request-->
												<div class="container" style="margin-top:40px;">
													<div class="row">
														<div class="col-xl-1 col-lg-0"></div>
														<div class="col-xl-10 col-lg-12">
														<ul class="nav nav-tabs" role="tablist">
						<?php 
							if(get_field('description'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link active" href="#description2" role="tab" data-toggle="tab">Описание</a>
								</li>
							<?php }
						?>

						<?php 
							if(get_field('parametrs'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#parametrs" role="tab" data-toggle="tab">Параметры</a>
								</li>
							<?php }
						?>

						<?php 
							if(get_field('gabarits'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#gabarits" role="tab" data-toggle="tab">Габариты</a>
								</li>
							<?php }
						?>

						<?php 
							if(get_field('certificates'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#certificates" role="tab" data-toggle="tab">Сертификаты</a>
								</li>
							<?php }
						?>

						<?php
						$term_parent__ = get_term_top_most_parent($cat__->term_id, 'category');
							if( $term_parent__->term_id == '10' || $term_parent__->term_id == '11' || $term_parent__->term_id == '12'){
								$s_name = 'ПАРАМЕТРЫ';
							}else{
								$s_name= 'Доп. опции';
							}
							if(get_field('additional_options'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#additional_options" role="tab" data-toggle="tab"><?php echo $s_name; ?></a>
								</li>
							<?php }
						?>

						<?php 
							if(get_field('benefits'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#benefits" role="tab" data-toggle="tab">преимущества</a>
								</li>
							<?php }
						?>

						<?php 
							if(get_field('gp_vilet-streli'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#gp_vilet-streli" role="tab" data-toggle="tab">Г/П И ВЫЛЕТ СТРЕЛЫ</a>
								</li>
							<?php }
						?>

						<?php 
							if(get_field('fastening_types'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#fastening_types" role="tab" data-toggle="tab">типы крепления</a>
								</li>
							<?php }
						?>

						<?php 
							if(get_field('prices'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#prices" role="tab" data-toggle="tab">цены</a>
								</li>
							<?php }
						?>

							<?php 
							if(get_field('japan-kito-additional-options_row'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#kito-options" role="tab" data-toggle="tab">Доп. опции</a>
								</li>
							<?php }
						?>

					</ul>
					
					<!-- Tab panes -->
					<div class="tab-content">

						<div role="tabpanel" class="tab-pane fade in active show" id="description2" aria-expanded="true">
							<h2>Описание</h2>
							<div class="opisaniya">
								<?php if( have_rows('art+price') ): ?>
									<?php while( have_rows('art+price') ): the_row(); ?>
											<?php $desc_temp = get_sub_field('описание');?>
											<?php if($desc_temp != ''){ ?>
												<div class="<?php the_sub_field('id'); ?>">
												<?php the_sub_field('описание'); ?>
												</div>
											<?php }else{ ?>
												<div class="<?php the_sub_field('id'); ?>">
												<?php echo get_field('description') ?>
												</div>
											<?php } ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</div><!-- opisaniya -->
						</div><!-- tab-pane -->

						<div role="tabpanel" class="tab-pane fade" id="parametrs">
							<h2>Параметры</h2>
							<table class="parameters__table">
								<?php if( have_rows('parametrs') ): ?>
									<?php while( have_rows('parametrs') ): the_row(); ?>
										<tr>
											<td><?php the_sub_field('name'); ?></td>
											<td><?php the_sub_field('value'); ?></td>
									<?php endwhile; ?>
								<?php endif; ?>
							</table>
						</div><!-- tab-pane -->

						<div role="tabpanel" class="tab-pane fade" id="gabarits">
							<h2>Габариты</h2>
							<div class="gabariti_var">
								<?php if( have_rows('art+price') ): ?>
									<?php while( have_rows('art+price') ): the_row(); ?>
											<?php $desc_temp = get_sub_field('габариты');?>
											<?php if($desc_temp != ''){ ?>
												<div class="<?php the_sub_field('id'); ?> item">
												<?php the_sub_field('габариты'); ?>
												</div>
											<?php }else{ ?>
												<div class="<?php the_sub_field('id'); ?> item">
												<?php if(get_field('gabarits')){ echo  get_field('gabarits') ;} ?>
												</div>
											<?php } ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</div><!-- gabariti_var -->
						</div><!-- tab-pane -->

						<div role="tabpanel" class="tab-pane fade" id="certificates">
							<h2>Сертификаты</h2>
							<?php if( get_field('certificates') ) { echo get_field('certificates'); } ?>
						</div><!-- tab-pane -->

						<div role="tabpanel" class="tab-pane fade" id="additional_options">
							<h2><?php echo $s_name; ?></h2>

							<div class="dop_opcii">
								<?php if( have_rows('art+price') ): ?>
									<?php while( have_rows('art+price') ): the_row(); ?>
											<?php $desc_temp = get_sub_field('доп-опции');?>
											<?php if($desc_temp != ''){ ?>
												<div class="<?php the_sub_field('id'); ?> item">
												<?php the_sub_field('доп-опции'); ?>
												</div>
											<?php }else{ ?>
												<div class="<?php the_sub_field('id'); ?> item">
												<?php if(get_field('additional_options')){ echo  get_field('additional_options') ;} ?>
												</div>
											<?php } ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</div><!-- dop_opcii -->
						</div><!-- tab-pane -->
						
						<div role="tabpanel" class="tab-pane fade" id="benefits">
							<h2>Преимущества</h2>
							<?php if(get_field('benefits')){ echo  get_field('benefits') ;} ?>
						</div><!-- tab-pane -->

						<div role="tabpanel" class="tab-pane fade" id="gp_vilet-streli">
							<h2>Грузоподъёмность и вылет стрелы</h2>
							<?php if( get_field('gp_vilet-streli') ){ echo get_field('gp_vilet-streli'); } ?>
						</div><!-- tab-pane -->
						
						<div role="tabpanel" class="tab-pane fade" id="fastening_types">
							<h2>Типы крепления основной несущей балки к концевым опорам:</h2>
							<?php if(get_field('fastening_types')){ echo  get_field('fastening_types') ;} ?>
						</div><!-- tab-pane -->

						<div role="tabpanel" class="tab-pane fade" id="prices">
							<h2>Цены</h2>
							<?php if( get_field('prices') ){ echo get_field('prices'); } ?>
						</div><!-- tab-pane -->

						<div role="tabpanel" class="tab-pane fade" id="kito-options">
							<h2>Доп. опции</h2>
							<ul>
							<?php if( have_rows('japan-kito-additional-options_row') ): ?>
								<?php while( have_rows('japan-kito-additional-options_row') ): the_row(); ?>
									<li><?php the_sub_field('japan-kito-additional-options_row_item'); ?></li>
								<?php endwhile; ?>
							<?php endif; ?>
							</ul>
						</div><!-- tab-pane -->

					</div><!-- tab-content -->
				</div>
				<div class="col-xl-1 col-lg-0"></div>
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