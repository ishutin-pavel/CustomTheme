<?php
/**
 * The Template for displaying all single posts
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
<style>
@media(max-width: 768px){
  .col-lg-10{
          overflow: scroll;
    }
}
</style>
<?php 
$this_post = get_the_category();
//print_r($this_post);
//echo $this_post[0]->name;
?>

<?php 
echo do_shortcode('[smartslider3 slider=2]');
?>

  <?php
	  while ( have_posts() ) : the_post();?>
    <!-- standart-template -->
        <?php
        //print_r($this_post->name);
          if( strpos($this_post[0]->name, 'текст') !== false){?>
            <!-- AboveCat -->
            <?php 

              $rootCategory = $this_post[0]->parent; 
              $subCategories = [];
                $args = array('parent' => $rootCategory);
                $categories = get_categories( $args );
                foreach($categories as $category) {
                  array_push($subCategories, $category->term_id);
                }
                //print_r($subCategories);
              ?>
                <?php 
                $kat = '';
                $parent_term_id = $kat; // term id of parent term
                
                $args = array(
                  'parent'         => $parent_term_id,
                  // 'child_of'      => $parent_term_id, 
                ); 
                
                $terms = get_terms($args);
                ?>

              <?php 
              echo do_shortcode('[smartslider3 slider=2]');
              ?>
                <div class="container stall_inner">
                <div class="row">
                  <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-12 breadcrumbs_container">
                          <h1 class="page_title"><?php echo $title = get_term_meta( $rootCategory, 'mytxseo_seo_title', 1 ); ?></h1>
                          <div>
                            <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                          </div>
                        </div>
                 

              </div>
                              </div>
                            <div class="col-lg-1"></div>
                          </div>
                        </div>

              <!-- Second block -->

                  <section class="cat-description">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-1"></div>
                      <div class="col-lg-10">
                        <div class="seo-cat-gallery" id="info">
                          <?php
                            $args_sub = array( 'category' => $subCategories[1],'posts_per_page'=>-1, 
                            'numberposts'=>-1 );
                            $posts_sub = get_posts( $args_sub );
                              foreach( $posts_sub as $post_sub ){
                                //print_r($post_sub);
                                $featured_img_url = get_the_post_thumbnail_url($post_sub->ID, 'full');
                                ?>
                                  <div class="seo-cat-gallery-item">
                                    <a href="<?php echo get_permalink($post_sub->ID); ?>#info"> <img src="<?php echo $featured_img_url; ?>" alt=""></a>
                                  </div>
                                <?php ?>
                                  
                                <?php 
                              }
                          ?>
                        </div>
                        <div class="seo-current-cut-text">
                         
                          <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                          <a href="<?php echo $featured_img_url ?>" data-rel="lightbox" class="seo-thumb">  
                                            <img src="<?php echo $featured_img_url ?>" alt="">
                                          </a>  
                                      <?php 
                                          the_content();
                                      ?>
                          
                        </div>
                      </div>
                      <div class="col-lg-1"></div>
                    </div>
                  </div>
                  </section>
            <!-- AboveCat -->
          <?php }else{?>
          <?php }
        ?>
    <!-- standart-template -->
<?php /* the_post_thumbnail( 'full' ); */ ?>
    <?php endwhile; ?>
<?php
get_footer();
?>