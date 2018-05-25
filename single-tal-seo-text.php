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
              //$some_id = get_the_category_by_ID($rootCategory);
              //print_r($some_id);
              //$rootCategory = $some_id->parent;
              //print_r($this_post[0]);
              $subCategories = [];
                $args = array('parent' => $rootCategory);
                $categories = get_categories( $args );
                foreach($categories as $category) {
                  array_push($subCategories, $category->term_id);
                }
                //print_r($subCategories);
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
                          <p class="page_title"><?php echo $title = get_term_meta( $rootCategory, 'mytxseo_seo_title', 1 ); ?></p>
                          <div>
                            <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                          </div>
                        </div>
                          <?php
                            $args_main = array( 'category' => $subCategories[0], 'order'   => 'ASC','posts_per_page'=>-1, 
                            'numberposts'=>-1  );
                            /* Nested Catogories => whleelchair ... */
                            $categories = get_categories( array(
                                'orderby' => 'name',
                                'hide_empty' => false,
                                'parent'  => $subCategories[0]
                            ) );
                            /* ==================================== */
                            //$posts_main = get_posts( $args_main );
                            //print_r($posts_main);
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
                                                            <li>
                                                                
                                                            <?php echo $category->name ?>
                                                                
                                                            </li>
                                                            <li>
                                                            <?php echo category_description($category->term_id); ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                            <?php }
                  ?>

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
                              <h1 class="seo-header1"><?php the_title(); ?></h1>
                            <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                          <a href="<?php echo $featured_img_url ?>" data-rel="lightbox" class="seo-thumb">  
                                            <img src="<?php echo $featured_img_url ?>" alt="">
                                          </a>  
                          <?php /*the_post_thumbnail('full', array('class' => 'seo-thumb')); */?>
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
          <?php } ?>
    <!-- standart-template -->
    <?php endwhile; ?>

<?php
get_footer();
?>