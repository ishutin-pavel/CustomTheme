<?php
wp_enqueue_script('jquery');
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
function theme_name_scripts() {
  wp_enqueue_script( 'jquery_2_1_1', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array('jquery'), '2.1.1', true );

  wp_enqueue_script( 'tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', array('jquery'), '1.4.0', true );

  wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array('jquery'), '4.0.0', true );

  /*
  * Подключаем "слайдер"
  */
  //Кранбалка 60, 53, 90
  //Кран мостовой 116, 851
  if ( is_single( array( 53, 60, 90, 116, 788, 851, 1008, 1104, 1110, 1133, 2242, 2247, 2250, 2253, 2271, 2274, 2283, 2291, 2364 ) ) ) {
    wp_enqueue_script( 'productSlider_1', get_template_directory_uri() . '/js/productSlider_1.js', array('jquery'), '0.0.1', true );
  } else {
    wp_enqueue_script( 'productSlider_2', get_template_directory_uri() . '/js/productSlider_2.js', array('jquery'), '0.0.1', true );
  }

  wp_enqueue_script( 'lazysizes', get_template_directory_uri() . '/js/lazysizes.min.js', array('jquery'), '4.1.6', true );

  wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '0.0.1', true );

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

//Замена концовки обрезанной статьи с [...] на ...
function new_excerpt_more( $more ) {
return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 *  Bootstrap Pagination for WordPress
 */
if( file_exists( get_template_directory() . '/inc/wp_bootstrap_pagination.php' )){
  require_once get_template_directory() . '/inc/wp_bootstrap_pagination.php';
}

//Убрать слово "Category:" из заголовка
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});