<style>
	table {background:#000; text-align:center;margin:0.5em 0; border-collapse: unset!important;}
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
</style>
<?php
$post = $wp_query->post;

if ( in_category('20') ) {
		include(TEMPLATEPATH.'/single-zapchasti.php');
} else if ( in_category('40') ) {
		include(TEMPLATEPATH.'/single-upravlenie.php');
} else if ( in_category('36') || in_category('34') || in_category('38') ) {
	include(TEMPLATEPATH.'/single-tal-seo-text.php');
} else if( in_category('43') ) {
	include(TEMPLATEPATH.'/single-tal-bolgariya.php');
} else {
		include(TEMPLATEPATH.'/single-default.php');
}
?>