<?php
$post = $wp_query->post;

if ( in_category('58') ) {//Новости
	include(TEMPLATEPATH.'/single-news.php');
} else if ( in_category('69') ) {
	include(TEMPLATEPATH.'/single-blog.php');
} else {
	include(TEMPLATEPATH.'/single-default.php');
}
?>