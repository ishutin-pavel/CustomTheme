<?php
/*
* Template Name: Glavnaya
*/
?>
<?php get_header(); ?>
<?php

$args = array(
	'parent' => 0,
	'hide_empty' => 0,
	'exclude' => '1,57,58,69', // ID рубрики, которые нужно исключить
	'number' => '0',
	'orderby' => 'id',
	'order' => 'DESC',//DESC
	'pad_counts' => true
);
$catlist = get_terms('category',$args);
$catlist = array_reverse($catlist);
?>

<div class="container title_of_page">
		<div class="row">
				<div class="col-xl-1 col-lg-0"></div>
				<div class="col-xl-10 col-lg-12">
						<div class="col-lg-12 breadcrumbs_container">
								<h1 class="page_title">Подъемные краны от кранового завода Атлант</h1>
						</div>
				</div>
				<div class="col-xl-1 col-lg-0"></div>
		</div>
</div>

<div class="container-fluid stall">
		<div class="row">
				
		<?php foreach ($catlist as $cat) : ?>
			<div class="col-xl-3 col-lg-4 col-sm-6 col-6 whole_cart">
						<a href="<?php echo get_term_link($cat->slug, 'category'); ?>" class="cart">
								<ul>
										<li style="background-image:url(<?php echo z_taxonomy_image_url($cat->term_id, 'full'); ?>);"></li>
										<li><h3><?php echo $cat->name; ?></h3></li>
										<li><p><?php echo $cat->description; ?></p></li>
								</ul>
						</a>
				</div>
	<?php endforeach; ?>

		</div>
</div>
<div class="container">
		<div class="row">
				<div class="col-lg-12">
				<?php
						the_content();
				?>
				</div>
		</div>
</div>

<?php get_footer(); ?>