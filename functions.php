<?php
wp_enqueue_script('jquery');
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
function theme_name_scripts() {
    //wp_enqueue_style( 'normalize-css', get_template_directory_uri() . '/css/normalize.css');
    //wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    //wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
}

add_theme_support( 'post-thumbnails' ); // для всех типов постов

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
       $src = remove_query_arg( 'ver', $src );
       return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2017.01.21
 * лицензия: MIT
*/
function dimox_breadcrumbs() {

    /* === ОПЦИИ === */
    $text['home'] = 'Главная'; // текст ссылки "Главная"
    $text['category'] = '%s'; // текст для страницы рубрики
    $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
    $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
    $text['author'] = 'Статьи автора %s'; // текст для страницы автора
    $text['404'] = 'Ошибка 404'; // текст для страницы 404
    $text['page'] = 'Страница %s'; // текст 'Страница N'
    $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'
  
    $wrap_before = '<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
    $wrap_after = '</ul><!-- .breadcrumbs -->'; // закрывающий тег обертки
    $sep = '›'; // разделитель между "крошками"
    $sep_before = '<span class="sep">'; // тег перед разделителем
    $sep_after = '</span>'; // тег после разделителя
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $before = '<li class="current">'; // тег перед текущей "крошкой"
    $after = '</li>'; // тег после текущей "крошки"
    /* === КОНЕЦ ОПЦИЙ === */
  
    global $post;
    $home_url = home_url('/');
    $link_before = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link_after = '</li>';
    $link_attr = ' itemprop="item"';
    $link_in_before = '<span itemprop="name">';
    $link_in_after = '</span>';
    $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
    $frontpage_id = get_option('page_on_front');
    $parent_id = ($post) ? $post->post_parent : '';
    $sep = '';
    $home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;
  
    if (is_home() || is_front_page()) {
  
      if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;
  
    } else {
  
      echo $wrap_before;
      if ($show_home_link) echo $home_link;
      
      if ( is_category() ) {
        $cat = get_category(get_query_var('cat'), false);
        if ($cat->parent != 0) {
          
          $cats = get_category_parents($cat->parent, TRUE, $sep);
          $parent_cat_array = get_cat_parents_array( $cat->parent, 'category' );
          $parent_cat_array = array_reverse($parent_cat_array);
          $resulted_cat_array = array();
          foreach ($parent_cat_array as $value) {
            if(!strpos($value->name, "-основ")){
              array_push($resulted_cat_array, $value);
            }
          }
          $cats_count = count($resulted_cat_array);
          $myLim = 1;
          $cats = '';
          foreach($resulted_cat_array as $value){
            $term_link = get_term_link( $value );
            $cats .= '<a href="'. $term_link .'">'. $value->name .'</a>';
            if($cats_count > $myLim){
              $cats .= ' <span class="sep"> › </span> ';
              $cats_count--;
            }
          }/*
          echo '<hr>';
          print_r($cats);
          echo '<hr>';
          print_r($resulted_cat_array);
          echo '<hr>';*/
          $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
          $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
          if ($show_home_link) echo $sep;
          echo $cats;
        }
        if ( get_query_var('paged') ) {
          $cat = $cat->cat_ID;
          echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
        } else {
          if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
        }
        
      } elseif ( is_search() ) {
        
        if (have_posts()) {
          if ($show_home_link && $show_current) echo $sep;
          if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
        } else {
          if ($show_home_link) echo $sep;
          echo $before . sprintf($text['search'], get_search_query()) . $after;
        }
        
      } elseif ( is_day() ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
        echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
        if ($show_current) echo $sep . $before . get_the_time('d') . $after;
  
      } elseif ( is_month() ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
        if ($show_current) echo $sep . $before . get_the_time('F') . $after;
  
      } elseif ( is_year() ) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . get_the_time('Y') . $after;
  
      } elseif ( is_single() && !is_attachment() ) {
        if ($show_home_link) echo $sep;
        if ( get_post_type() != 'post' ) {
          $post_type = get_post_type_object(get_post_type());
          $slug = $post_type->rewrite;
          printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
          if ($show_current) echo $sep . $before . get_the_title() . $after;
        } else {
          $cat = get_the_category(); $cat = $cat[0];
          //$cats = get_category_parents($cat, TRUE, $sep);
          
          /* Next Level hack */
          $parent_cat_array = get_cat_parents_array( $cat->term_id, 'category' );
          
          $parent_cat_array = array_reverse($parent_cat_array);
          $resulted_cat_array = array();
          foreach ($parent_cat_array as $value) {
            if(!strpos($value->name, "-основ") && !strpos($value->name, "-текст")){
              array_push($resulted_cat_array, $value);
            }
          }
          $cats_count = count($resulted_cat_array);
          $myLim = 1;
          $cats = '';
          foreach($resulted_cat_array as $value){
            $term_link = get_term_link( $value );
            $cats .= '<a href="'. $term_link .'">'. $value->name .'</a>';
            if($cats_count > $myLim){
              $cats .= ' <span class="sep"> › </span> ';
              $cats_count--;
            }
          }
          /* Dimox Hack show only top Parent */
          //$term_parent = get_term_top_most_parent($cat->term_id, 'category');
          //$cats = '<a href="'. get_term_link( $term_parent->term_id ) .'">' . $term_parent->name . '</a>';


          if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
          $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
          echo $cats;
          if ( get_query_var('cpage') ) {
            echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
          } else {
            if ($show_current) echo $sep . $before . get_the_title() . $after;
          }
        }
        //LAST
      // custom post type
      } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        if ( get_query_var('paged') ) {
          echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
        } else {
          if ($show_current) echo $sep . $before . $post_type->label . $after;
        }
        
      } elseif ( is_attachment() ) {
        if ($show_home_link) echo $sep;
        $parent = get_post($parent_id);
        $cat = get_the_category($parent->ID); $cat = $cat[0];
        if ($cat) {
          $cats = get_category_parents($cat, TRUE, $sep);
          $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
          echo $cats;
        }
        printf($link, get_permalink($parent), $parent->post_title);
        if ($show_current) echo $sep . $before . get_the_title() . $after;
        
      } elseif ( is_page() && !$parent_id ) {
        if ($show_current) echo $sep . $before . get_the_title() . $after;
        
      } elseif ( is_page() && $parent_id ) {
        if ($show_home_link) echo $sep;
        if ($parent_id != $frontpage_id) {
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            if ($parent_id != $frontpage_id) {
              $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
            }
            $parent_id = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) echo $sep;
          }
        }
        if ($show_current) echo $sep . $before . get_the_title() . $after;
        
      } elseif ( is_tag() ) {
        if ( get_query_var('paged') ) {
          $tag_id = get_queried_object_id();
          $tag = get_tag($tag_id);
          echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
        } else {
          if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
        }
      } elseif ( is_author() ) {
        global $author;
        $author = get_userdata($author);
        if ( get_query_var('paged') ) {
          if ($show_home_link) echo $sep;
          echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
        } else {
          if ($show_home_link && $show_current) echo $sep;
          if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
        }
  
      } elseif ( is_404() ) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . $text['404'] . $after;
  
      } elseif ( has_post_format() && !is_singular() ) {
        if ($show_home_link) echo $sep;
        echo get_post_format_string( get_post_format() );
      }
  
      echo $wrap_after;
  
    }
  } // end of dimox_breadcrumbs()
  
  //Расширение Рубрик
  /*
 * Бэкэнд для добавления настроек на страницу редактирования элементов таксономий
 * Взято из статьи: http://truemisha.ru/blog/wordpress/metadannyie-v-taksonomiyah.html
 * ver 1.2
 * Нужно PHP 5.3+
 */
class trueTaxonomyMetaBox {
  private $opt;
  private $prefix;

  function __construct( $option ) {
    $this->opt    = (object) $option;
    $this->prefix = $this->opt->id .'_'; // префикс настроек

    foreach( $this->opt->taxonomy as $taxonomy ){
      add_action( $taxonomy . '_edit_form_fields', array( &$this, 'fill'), 10, 2 ); // хук добавления полей
    }

    // установим таблицу в $wpdb, если её нет
    global $wpdb;
    if( ! isset( $wpdb->termmeta ) ) $wpdb->termmeta = $wpdb->prefix .'termmeta';

    add_action('edit_term', array( &$this, 'save'), 10, 1 ); // хук сохранения значений полей
  }

  function fill( $term, $taxonomy ){

    foreach( $this->opt->args as $param ){
      $def   = array('id'=>'', 'title'=>'', 'type'=>'', 'desc'=>'', 'std'=>'', 'args'=>array() );
      $param = (object) array_merge( $def, $param );

      $meta_key   = $this->prefix . $param->id;
      $meta_value = get_metadata('term', $term->term_id, $meta_key, true ) ?: $param->std;

      echo '<tr class ="form-field">';
        echo '<th scope="row"><label for="'. $meta_key .'">'. $param->title .'</label></th>';
        echo '<td>';

        // select
    if( $param->type == 'wp_editor' ){
      wp_editor( $meta_value, $meta_key, array(
      'wpautop' => 1,
      'media_buttons' => true,
      'textarea_name' => $meta_key, //нужно указывать!
      'textarea_rows' => 10,
      //'tabindex'      => null,
      //'editor_css'    => '',
      //'editor_class'  => '',
      'teeny'         => 0,
      'dfw'           => 0,
      'tinymce'       => 1,
      'quicktags'     => 1,
      //'drag_drop_upload' => false
      ) );
    }
    // select
        elseif( $param->type == 'select' ){
          echo '<select name="'. $meta_key .'" id="'. $meta_key .'">
              <option value="">...</option>';

              foreach( $param->args as $val => $name ){
                echo '<option value="'. $val .'" '. selected( $meta_value, $val, 0 ) .'>'. $name .'</option>';
              }
          echo '</select>';
          if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
        }
        // checkbox
        elseif( $param->type == 'checkbox' ){
          echo '
            <label>
              <input type="hidden" name="'. $meta_key .'" value="">
              <input name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" '. checked( $meta_value, 'on', 0) .'>
              '. $param->desc .'
            </label>
          ';
        }
        // textarea
        elseif( $param->type == 'textarea' ){
          echo '<textarea name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" value="'. $meta_value .'" class="large-text">'. esc_html( $meta_value ) .'</textarea>';                    
          if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
        }
        //wysiwyg
        /*elseif( $param->type == 'wysiwyg' ){
            $content = '';
            $editor_id = 'mycustomeditor';

            wp_editor( $content, $editor_id );                   
          if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
        }*/
        // text
        else{
          echo '<input name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" value="'. $meta_value .'" class="regular-text">';

          if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
        }
        echo '</td>';
      echo '</tr>';         
    }

  }

  function save( $term_id ){
    foreach( $this->opt->args as $field ){
      $meta_key = $this->prefix . $field['id'];
      if( ! isset($_POST[ $meta_key ]) ) continue;

      if( $meta_value = trim($_POST[ $meta_key ]) ){
        update_metadata('term', $term_id, $meta_key, $meta_value, '');
      }
      else {
        delete_metadata('term', $term_id, $meta_key, '', false );
      }
    }
  }

}// Конец расширения рубрик
add_action('init', 'register_additional_term_fields');
function register_additional_term_fields(){ 
  new trueTaxonomyMetaBox( array(
    'id'       => 'mytxseo', // id играет роль префикса названий полей
    'taxonomy' => array('category','post_tag'), // названия таксономий, для которых нужно добавить ниже перечисленные поля
    'args'     => array(
      array(
        'id'    => 'seo_title', // атрибуты name и id без префикса, получится "txseo_seo_title"
        'title' => 'SEO Заголовок',
        'type'  => 'text',
        'desc'  => 'Укажите альтернативное название термина для SEO.',
        'std'   => '', // по умолчанию
      ),
      array(
        'id'    => 'myseo_description',
        'title' => 'SEO Описание',
        'type'  => 'text',
        'desc'  => 'meta тег description.',
        'std'   => '', // по умолчанию
      ),
      array(
        'id'    => 'garantiya',
        'title' => 'Срок гарантии',
        'type'  => 'text',
        'desc'  => 'срок гарантии',
        'std'   => '', // по умолчанию
      ),
      array(
        'id'    => 'forma',
        'title' => 'Ссылка на онлайн заявку',
        'type'  => 'text',
        'desc'  => 'Ссылка на онлайн заявку',
        'std'   => '', // по умолчанию
      ),
      array(
        'id' => 'cat_wysiwyg',
        'title' => 'Category description!',
        'type' => 'wp_editor',
        'desc' => 'description',
        'options' => array()
      )
    )
  ) );
}

// determine the topmost parent of a term
function get_term_top_most_parent($term_id, $taxonomy) {
  // start from the current term
  $parent = get_term_by('id', $term_id, $taxonomy);
  // climb up the hierarchy until we reach a term with parent = '0'
  while ($parent->parent != '0') {
     $term_id = $parent->parent;

     $parent = get_term_by('id', $term_id, $taxonomy);
  }
  return $parent;
}

// build parent categories array
function get_cat_parents_array($term_id, $taxonomy) {

  $result_array = array();
  
  // start from the current term
  $parent = get_term_by('id', $term_id, $taxonomy);
  array_push($result_array, $parent);
  // climb up the hierarchy until we reach a term with parent = '0'
  while ($parent->parent != '0') {
     $term_id = $parent->parent;

     $parent = get_term_by('id', $term_id, $taxonomy);
     array_push($result_array, $parent);
  }
  return $result_array;
}

function my_cyr_to_lat_table($ctl_table) {
  $ctl_table['ц'] = 'c';
  $ctl_table['я'] = 'ja';
  return $ctl_table;
}
add_filter('ctl_table', 'my_cyr_to_lat_table');