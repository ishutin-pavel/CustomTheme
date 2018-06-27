<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage CustomTheme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">
					<div class="col-xl-1 col-lg-0"></div>

					<div class="col-xl-10 col-lg-12 breadcrumbs_container">
							<h1 class="page_title">Ошибка 404!</h1>
							<div>
								<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
							</div>
					</div>

					<div class="col-xl-1 col-lg-0"></div>

					<div class="col-xl-1 col-lg-0"></div>

					<div class="col-xl-10 col-lg-12">
						<section class="error-404 not-found">
							<p style="font-size:50px;text-align:center;">Ошибка 404!</p>
							<p style="font-size:36px;text-align:center;"> Cтраница не найдена. </p>
							<p style="font-size:32px;text-align:center;">Такой страницы не существует.</p>
						</section><!-- .error-404 -->
					</div>

					<div class="col-xl-1 col-lg 0"></div>
				</div><!-- .row -->
			</div><!-- .container -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>