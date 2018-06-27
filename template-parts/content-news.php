<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alco
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('row catNews__item'); ?>>
		<div class="col-sm-6 col-md-4">
			<div class="catNews__img">
				<a href="<?php the_permalink(); ?>">
					<?php
						the_post_thumbnail( 'medium', array(
							'class' => "img-thumbnail",
						) );
					?>
				</a>
			</div>
		</div><!-- .col -->

		<div class="col-sm-6 col-md-8">
			<?php the_title( '<h2 class="catNews__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );?>

			<div class="catNews__desc">
				<?php the_excerpt(); ?>
				
				<div class="catNews__btn">
					<a class="btn btn-secondary" href="<?php the_permalink(); ?>" role="button">Подробнее</a>
				</div><!-- catNews__btn -->

			</div><!-- catNews__desc -->
		</div><!-- .col -->
</div><!-- .row -->