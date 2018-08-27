<?php
/**
 * Template Name: Таль Болгария
 * Template Post Type: post
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
.container .goods_properties .polispast ul
{
		display:none;
		
}
.container .goods_properties .polispast ul:nth-child(2){
		display:flex;
		justify-content: center;
}
</style>

	<?php
		while ( have_posts() ) : the_post();?>
		<!-- standart-template -->
				
						<!-- Details_template -->
						<?php
								/*
								* Include the post format-specific template for the content. If you want to
								* use this in a child theme, then include a file called content-___.php
								* (where ___ is the post format) and that will be used instead.
								*/?>
												<?php the_content(); ?>
												<!-- таблица расчета параметров -->
												<div class="container">
														<div class="row">
																<div class="col-xl-1 col-lg-0"></div>
																<div class="col-xl-10 col-lg-12 col-12 goods_properties">
																<div class="breadcrumbs_container">
																	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
																			<?php if(function_exists('bcn_display'))
																			{
																					bcn_display();
																			}?>
																	</div>
																	<h1 class="page_title"><?php the_title(); ?></h1>
																</div>
															<?php if( have_rows('bolg-variation') ): ?>
																		<div class="properties_table" style="margin-top:10px;">
																				<p>
																						Тип:
																				</p>
																				<ul>
																					
																						<?php 
																							$initActive = 0;
																							$setActive = 0;
																							while( have_rows('bolg-variation') ): the_row(); 
																							$gryz = get_sub_field('bolg-variation_num');
																							$dataVal = get_sub_field('bolg-variation_num');
																							$numrows = count( get_field( 'bolg-variation' ) );
																							
																							$c_width = 100 / $numrows;


																							?>
																							<li style="width:<?php echo $c_width ?>%;" class="gryz_id_e<?php if($initActive < 1){echo ' active_gryz';$initActive++;} ?>" data-toggler="<?php echo $dataVal; ?>"><?php echo $gryz; ?></li>
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
																<?php if( have_rows('bolg-variation') ): ?>
																		<div class="properties_table  polispast">
																				<p>
																						Полиспаст:
																				</p>
																				
																				
																					<?php 
																					$initActive = 0;
																					$setActive = 0;
																					while( have_rows('bolg-variation') ): the_row(); 
																					$dataVal = get_sub_field('bolg-variation_num');
																						?>
																						<ul class="<?php echo $dataVal; ?>">
																						
																					<?php
																					$numrows = count( get_sub_field( 'bolg-variation__item' ) );
																					while( have_rows('bolg-variation__item') ): the_row();

																						$bolg_variation__item__num = get_sub_field('bolg-variation__item__num');
																						$dataVal =  get_sub_field('bolg-variation__item__num');
																						$dataVal = str_replace(" ","_",$dataVal);
																						$dataVal = str_replace("/","_",$dataVal);
																						$dataVal = str_replace("(","_",$dataVal);
																						$dataVal = str_replace(")","_",$dataVal);
																									
																							$c_width = 100 / $numrows;?>
																						<li style="width:<?php echo $c_width ?>%;" class="prolet_id_e<?php if($initActive < 1){echo ' active_prolet';$initActive++;} ?>" data-toggler="<?php echo $dataVal; ?>"><?php echo $bolg_variation__item__num; ?></li>

																						<?php endwhile; ?>
																						</ul>
																					<?php endwhile; ?>
																				
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
																<?php $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); ?>
																<div class="images-cont">
																					<!-- I -->
																					<?php if( have_rows('bolg-variation') ): ?>
																							<?php while( have_rows('bolg-variation') ): the_row(); ?>
																							<?php $current_row_id = get_sub_field('bolg-variation_num'); ?>
																							<?php while( have_rows('bolg-variation__item') ): the_row(); ?>
																									<?php $image_temp = get_sub_field('bolg-variation__item__img');?>
																									<?php $current_row_id_2 = get_sub_field('bolg-variation__item__num'); 
																									$current_row_id_2 = str_replace(" ","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("/","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("(","_",$current_row_id_2);
																									$current_row_id_2 = str_replace(")","_",$current_row_id_2);
																									?>
																								 
																									<?php if($image_temp != ''){ ?>
																									<a href="<?php echo $image_temp['url']; ?>" data-rel="lightbox" class="<?php echo $current_row_id . $current_row_id_2; ?>">  
																										<img src="<?php echo $image_temp['url']; ?>" alt="<?php echo $image['alt']; ?>">
																									</a>  
																									<?php }else{ ?>
																										<a href="<?php echo $featured_img_url ?>" data-rel="lightbox" class="<?php echo $current_row_id .$current_row_id_2; ?>">  
																											<img src="<?php echo $featured_img_url ?>" alt="">
																										</a> 
																									<?php } ?>
																									<?php endwhile; ?>
																							<?php endwhile; ?>
																					<?php endif; ?>
																					<!-- ./I -->

																					<!--<a href="<?php echo $featured_img_url ?>" data-rel="lightbox" >  
																						<img src="<?php echo $featured_img_url ?>" alt="">
																					</a>-->  
																</div>
																</div>
																<div class="col-xl-5 col-lg-6 col-12 button">
																		<ul>
																				<li>Арт.: <span class="articul">
																					<!-- A -->
																					<?php if( have_rows('bolg-variation') ): ?>
																							<?php while( have_rows('bolg-variation') ): the_row(); ?>
																							<?php $current_row_id = get_sub_field('bolg-variation_num'); ?>
																								<?php while( have_rows('bolg-variation__item') ): the_row(); ?>
																								<?php $current_row_id_2 = get_sub_field('bolg-variation__item__num'); 
																									$current_row_id_2 = str_replace(" ","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("/","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("(","_",$current_row_id_2);
																									$current_row_id_2 = str_replace(")","_",$current_row_id_2);
																									?>
																									<span class="<?php echo $current_row_id . $current_row_id_2; ?>"><?php the_sub_field('bolg-variation__item__art'); ?></span>
																									<?php endwhile; ?>
																							<?php endwhile; ?>
																					<?php endif; ?>
																					<!-- ./A -->
																				</span>
																				</li>
																				<li>Цена: <span class="price">
																					<!-- P -->
																					<?php if( have_rows('bolg-variation') ): ?>
																							<?php while( have_rows('bolg-variation') ): the_row(); ?>
																							<?php $current_row_id = get_sub_field('bolg-variation_num'); ?>
																								<?php while( have_rows('bolg-variation__item') ): the_row(); ?>
																								<?php $current_row_id_2 = get_sub_field('bolg-variation__item__num'); 
																									$current_row_id_2 = str_replace(" ","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("/","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("(","_",$current_row_id_2);
																									$current_row_id_2 = str_replace(")","_",$current_row_id_2);
																									?>
																									<span class="<?php echo $current_row_id . $current_row_id_2; ?>">
																										<?php $sub_field_price = get_sub_field('bolg-variation__item_price'); 
																										
																										if($sub_field_price == "по запросу" || $sub_field_price == "договорная"){
																											?>
																											<span class="dogovor <?php echo $current_row_id . $current_row_id_2; ?>"><?php echo $sub_field_price; ?></span><?php
																										}else{
																											?><span class="<?php echo $current_row_id .$current_row_id_2; ?>"><?php echo $sub_field_price . ' p.';?></span><?php
																										}
																										?>
																									</span>
																									
																							<?php endwhile; ?>
																							<?php endwhile; ?>
																					<?php endif; ?>
																					<!-- ./P -->
																				</span>
																				</li>
																				<?php $cat__ = get_the_category(); $cat__ = $cat__[0]; ?>
																				<li><a href="<?php echo $zapros_link = get_term_meta( $cat__->term_id, 'mytxseo_forma', 1 ); ?>" class="zapros">Оставить онлайн запрос на кран</a></li>
																				<li>Доставка: транспортная компания <br>
												Самовывоз: Московская область, г. Краснознаменск</li>
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
							/*if( $term_parent__->term_id == '10' || $term_parent__->term_id == '11' || $term_parent__->term_id == '12'){
								$s_name = 'ПАРАМЕТРЫ';
							}else{
								$s_name= 'Доп. опции';
							}*/
							if(get_field('additional_options'))
							{ ?>
								<li class="nav-item">
									<a class="nav-link" href="#additional_options" role="tab" data-toggle="tab"><?php/* echo $s_name;*/ ?> Доп. опции</a>
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
					</ul>
					
					<!-- Tab panes -->
					<div class="tab-content">

						<div role="tabpanel" class="tab-pane fade in active show" id="description2" aria-expanded="true">
							<h2>Описание</h2> 
							<div class="opisaniya">
								<!-- D -->
															<?php $check = true; ?>
																						<?php if( have_rows('art+price') ): ?>
																							<?php while( have_rows('art+price') ): the_row(); $check = false;?>
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
																						<?php if($check): ?>
																						<?php if(get_field('description')): ?>
																							<div>
																										<?php echo  get_field('description');  ?>     
																										</div> 
																							<?php endif; ?>
																							<?php endif; ?>
																						<!-- ./D -->
							</div>
							
						</div>

						<div role="tabpanel" class="tab-pane fade" id="parametrs"><?php  
							/* Display styled parametrs */?>
											<div class="parameters_table">
													<h2>
													ПАРАМЕТРЫ
							</h2>
													<ul>
													<?php if( have_rows('parametrs') ): ?>
													<?php while( have_rows('parametrs') ): the_row(); ?>
										<li><?php the_sub_field('name'); ?></li>
										<li><?php the_sub_field('value'); ?></li>
								<?php endwhile; ?>
													<?php endif; ?>
													</ul>
											</div>

							<?php /* ./ Display styled parametrs */
					?></div>

						<div role="tabpanel" class="tab-pane fade" id="gabarits">
							<h2>Габариты</h2>
							<div class="gabariti_var">
								<!-- G -->
																						<?php if( have_rows('bolg-variation') ): ?>
																							<?php while( have_rows('bolg-variation') ): the_row(); ?>
																							<?php $current_row_id = get_sub_field('bolg-variation_num'); ?>
																								<?php while( have_rows('bolg-variation__item') ): the_row(); ?>

																								<?php $current_row_id_2 = get_sub_field('bolg-variation__item__num'); 
																									$current_row_id_2 = str_replace(" ","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("/","_",$current_row_id_2);
																									$current_row_id_2 = str_replace("(","_",$current_row_id_2);
																									$current_row_id_2 = str_replace(")","_",$current_row_id_2);
																									?>
																									<?php $desc_temp = get_sub_field('bolg-variation__item_gabarits');?>
																									<?php if($desc_temp != ''){ ?>
																										<div class="<?php echo $current_row_id .$current_row_id_2; ?> item">
																										<?php the_sub_field('bolg-variation__item_gabarits'); ?>
																										</div>
																									<?php }else{ ?>
																										<div class="<?php echo $current_row_id .$current_row_id_2; ?> item">
																										<?php if(get_field('gabarits')){ echo  get_field('gabarits') ;} ?>    
																										</div>                                 
																									<?php } ?>

																									<?php endwhile; ?>
																							<?php endwhile; ?>
																						<?php endif; ?>
																						<!-- ./G -->
							</div>

							
						</div>

						<div role="tabpanel" class="tab-pane fade" id="certificates"><h2>Сертификаты</h2><?php if(get_field('certificates')){ echo  get_field('certificates') ;} ?></div>

						<div role="tabpanel" class="tab-pane fade" id="additional_options">
						<h2><?php /*echo $s_name;*/ ?>Доп. опции</h2>

						<?php if(get_field('additional_options')){ echo  get_field('additional_options') ;} ?>
						</div>
						
						<div role="tabpanel" class="tab-pane fade" id="benefits">
							<h2>Преимущества</h2>
							<?php if(get_field('benefits')){ echo  get_field('benefits') ;} ?>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="gp_vilet-streli"><h2>ГРУЗОПОДЪЁМНОСТЬ И ВЫЛЕТ СТРЕЛЫ</h2><?php if(get_field('gp_vilet-streli')){ echo  get_field('gp_vilet-streli') ;} ?></div>
						<div role="tabpanel" class="tab-pane fade" id="fastening_types"><h2>ТИПЫ КРЕПЛЕНИЯ ОСНОВНОЙ НЕСУЩЕЙ БАЛКИ К КОНЦЕВЫМ ОПОРАМ:</h2><?php if(get_field('fastening_types')){ echo  get_field('fastening_types') ;} ?></div>
						<div role="tabpanel" class="tab-pane fade" id="prices"><h2>Цены</h2><?php if(get_field('prices')){ echo  get_field('prices') ;} ?></div>
					</div>
														</div>
														<div class="col-xl-1 col-lg-0"></div>
													</div>
												</div>
						<!-- Details_template -->
		<!-- standart-template -->
		<?php endwhile; ?>
<?php
get_footer();
?>