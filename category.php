<?php
$other_page = 25;
get_header();

function getCurrentCatID(){
	global $wp_query;
	if( is_category() || is_single() ) {
		$cat_ID = get_query_var('cat');
	}
	return $cat_ID;
}

function category_has_parent($catid) {
	$category = get_category($catid);
	if ( $category->category_parent > 0 ) {
		return true;
		}
		return false;
}

get_template_part( 'template-parts/parent-category' ); 

get_footer();