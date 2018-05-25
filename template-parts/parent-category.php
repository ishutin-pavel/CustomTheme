<?php
	$rootCategory = getCurrentCatID();
	$subCategories = [];

	$args = array('parent' => $rootCategory,'hide_empty' => 0);
	$categories = get_categories( $args );

	foreach($categories as $category) {
		array_push($subCategories, $category->term_id);
	}

	$kat = '';
	$parent_term_id = $kat; // term id of parent term
	
	$args = array(
		'parent'         => $parent_term_id,
	);

	$terms = get_terms($args);
?>

<?php echo do_shortcode('[smartslider3 slider=2]');?>

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
		if( $rootCategory != 10 && $rootCategory != 11 && $rootCategory != 12 && $rootCategory != 14) {
			$args_main = array( 'category' => $rootCategory, 'order'   => 'ASC', 'posts_per_page'=>-1, 'numberposts'=>-1 );
			$posts_main = get_posts( $args_main );
			foreach( $posts_main as $post_main ) {
				$featured_img_url = get_the_post_thumbnail_url($post_main->ID, 'full'); 
				$image_alt = get_post_meta(get_post_thumbnail_id($post_main->ID), '_wp_attachment_image_alt', true);
				$post_meta = get_post_meta( $post_main->ID, 'short' );
				$linkTo = get_post_permalink( $post_main->ID );
		?>

					<div class="col-lg-12 card_item">
						<a href="<?php the_permalink( $post_main->ID ); ?>" class="link">
							<div class="card__img-wrap">
								<img src="<?php echo $featured_img_url ?>" alt="<?php 
												if($image_alt != '') {
												echo $image_alt;
											} else {
												echo $post_main->post_title;
											}
										?>">
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
					<?php } }
							?>
					<!-- ./Standart item template -->
					
					<!-- Tals item template -->

<?php
	if($rootCategory == 10){
		$categories = get_categories( array(
			'orderby' => 'name',
			'hide_empty' => false,
			'parent'  => 37
		) );
		//print_r($categories);
		$tal_categories = [];
		foreach($categories as $category) {
			$category_link = get_category_link( $category->term_id );
			?>
			<div class="col-lg-12 card_item">
							<a href="<?php echo $category_link; ?>" class="link">
								<div>
									<img src="<?php echo z_taxonomy_image_url($category->term_id, 'full'); ?>" alt="">
								</div>
								<div>
									<ul class="main-ul">
										<li> <?php echo $category->name ?> </li>
										<li> <?php echo category_description($category->term_id); ?> </li>
									</ul>
								</div>
							</a>
						</div>
		<?php }
	}
?>

<?php
if($rootCategory == 11){
	$categories = get_categories( array(
		'orderby' => 'id',
		'hide_empty' => false,
		'parent'  => 39
	) );
	//print_r($categories);
	$tal_categories = [];
	foreach($categories as $category) {
		$category_link = get_category_link( $category->term_id );
		?>
		<div class="col-lg-12 card_item">
						<a href="<?php echo $category_link; ?>" class="link">
							<div class="card__img-wrap">
								<img src="<?php echo z_taxonomy_image_url($category->term_id, 'full'); ?>" alt="">
							</div>
							<div>
								<ul class="main-ul">
									<li><?php echo $category->name ?></li>
									<li> <?php echo category_description($category->term_id); ?> </li>
								</ul>
							</div>
						</a>
					</div>
	<?php }
}
?>

<?php
	if($rootCategory == 12){
		$categories = get_categories( array(
			'orderby' => 'name',
			'hide_empty' => false,
			'parent'  => 35
		) );
		//print_r($categories);
		$tal_categories = [];
		foreach($categories as $category) {
			$category_link = get_category_link( $category->term_id );
			?>
			<div class="col-lg-12 card_item">
							<a href="<?php echo $category_link; ?>" class="link">
								<div class="card__img-wrap">
									<img src="<?php echo z_taxonomy_image_url($category->term_id, 'full'); ?>" alt="">
								</div>
								<div>
									<ul class="main-ul">
										<li><?php echo $category->name ?></li>
										<li><?php echo category_description($category->term_id); ?></li>
									</ul>
								</div>
							</a>
						</div>
		<?php }
	}
?>

<?php
	if( $rootCategory == 14 ) {
		$categories = get_categories( array(
			'orderby' => 'name',
			'hide_empty' => false,
			'include' => '55,56,60',
			'parent'  => 14
		) );
		//print_r($categories);
		$tal_categories = [];
		foreach( $categories as $category ) {
			$category_link = get_category_link( $category->term_id );
?>
<div class="col-lg-12 card_item">
	<a href="<?php echo $category_link; ?>" class="link">
		<div class="card__img-wrap">
			<img src="<?php echo z_taxonomy_image_url($category->term_id, 'full'); ?>" alt="">
		</div>
		<div>
			<ul class="main-ul">
				<li><?php echo $category->name ?></li>
				<li><?php echo category_description($category->term_id); ?></li>
			</ul>
		</div>
	</a>
</div>
		<?php }
	}
?>


					<!-- ./Tals item template -->
					
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
				<div class="seo-current-cut-text">
					<?php
						$category_id = get_queried_object();
						$cat_seo_desc = get_term_meta( $category_id->term_id, 'mytxseo_cat_wysiwyg', 1 );
						echo apply_filters('the_content',$cat_seo_desc);
					?>
				</div>
			</div><!-- .col -->

			<div class="col-xl-1 col-lg-0"></div>

		</div><!-- .row -->
	</div><!-- .container -->
</section>

<script>
	(function ($) {
		'use strict';

		$('body').find('.carousel-slider').each(function () {
				var _this = $(this);
				var autoWidth = _this.data('auto-width');
				var stagePadding = parseInt(_this.data('stage-padding'));
				stagePadding = stagePadding > 0 ? stagePadding : 0;

				if (jQuery().owlCarousel) {
						_this.owlCarousel({
								stagePadding: stagePadding,
								nav: _this.data('nav'),
								dots: _this.data('dots'),
								margin: _this.data('margin'),
								loop: _this.data('loop'),
								autoplay: _this.data('autoplay'),
								autoplayTimeout: _this.data('autoplay-timeout'),
								autoplaySpeed: _this.data('autoplay-speed'),
								autoplayHoverPause: _this.data('autoplay-hover-pause'),
								slideBy: _this.data('slide-by'),
								lazyLoad: _this.data('lazy-load'),
								autoWidth: autoWidth,
								navText: [
										'<svg class="carousel-slider-nav-icon" viewBox="0 0 20 20"><path d="M14 5l-5 5 5 5-1 2-7-7 7-7z"></path></use></svg>',
										'<svg class="carousel-slider-nav-icon" viewBox="0 0 20 20"><path d="M6 15l5-5-5-5 1-2 7 7-7 7z"></path></svg>'
								],
								responsive: {
										320: {items: _this.data('colums-mobile')},
										600: {items: _this.data('colums-small-tablet')},
										768: {items: _this.data('colums-tablet')},
										993: {items: _this.data('colums-small-desktop')},
										1200: {items: _this.data('colums-desktop')},
										1921: {items: _this.data('colums')}
								}
						});

						if ('hero-banner-slider' === _this.data('slide-type')) {
								var animation = _this.data('animation');
								if (animation.length) {
										_this.on('change.owl.carousel', function () {
												var sliderContent = _this.find('.carousel-slider-hero__cell__content');
												sliderContent.removeClass('animated' + ' ' + animation).hide();
										});
										_this.on('changed.owl.carousel', function (e) {
												setTimeout(function () {
														var current = $(e.target).find('.carousel-slider-hero__cell__content').eq(e.item.index);
														current.show().addClass('animated' + ' ' + animation);
												}, _this.data('autoplay-speed'));
										});
								}
						}
				}

				if (jQuery().magnificPopup) {
						if (_this.data('slide-type') === 'product-carousel') {
								$(this).find('.magnific-popup').magnificPopup({
										type: 'ajax'
								});
						} else if ('video-carousel' === _this.data('slide-type')) {
								$(this).find('.magnific-popup').magnificPopup({
										type: 'iframe'
								});
						} else {
								$(this).find('.magnific-popup').magnificPopup({
										type: 'image',
										gallery: {
												enabled: true
										},
										zoom: {
												enabled: true,
												duration: 300,
												easing: 'ease-in-out'
										}
								});
						}
				}
		});
})(jQuery);
</script>