<?php
$post = $wp_query->post;

if ( in_category('20') ) {
	include(TEMPLATEPATH.'/single-zapchasti.php');
} else if ( in_category('36') || in_category('34') || in_category('38') ) {
	include(TEMPLATEPATH.'/single-tal-seo-text.php');
} else if( in_category('43') ) {
	include(TEMPLATEPATH.'/single-tal-bolgariya.php');
} else if ( in_category('58') ) {
	include(TEMPLATEPATH.'/single-news.php');
} else if ( in_category('69') ) {
	include(TEMPLATEPATH.'/single-blog.php');
} else {
		include(TEMPLATEPATH.'/single-default.php');
}
?>