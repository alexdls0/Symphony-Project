<?php


//Custom fields
require_once 'templates/customfields.php';
//add_action( 'show_user_profile', 'add_custom_fields' );
//add_action( 'edit_user_profile', 'add_custom_fields' );

add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );

add_theme_support('post-formats', array('image', 'gallery', 'audio', 'video', 'link', 'quote'));

    //SOPORTES DEL TEMA
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    
function encolar_scripts() {
    
    wp_register_script('JQuery', get_template_directory_uri() . '/js/jquery.min.js', array(), false, false);
    wp_enqueue_script('JQuery');
    
    wp_register_script('JQuery-ui', get_template_directory_uri() . '/js/jquery-ui.js', array(), false, true);
    wp_enqueue_script('JQuery-ui');
    
    wp_register_script('Isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), false, true);
    wp_enqueue_script('Isotope');
    
    wp_register_script('MagnificP', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jQuery'), false, true);
    wp_enqueue_script('MagnificP');
    
    wp_register_script('Tether', get_template_directory_uri() . '/js/tether.min.js', array(), false, true);
    wp_enqueue_script('Tether');
    
    wp_register_script('Bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('Bootstrap');
    
    wp_register_script('Carrousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, true);
    wp_enqueue_script('Carrousel');
    
    wp_register_script('Appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, true);
    wp_enqueue_script('Appear');

    wp_register_script('ConuntTo', get_template_directory_uri() . '/js/jquery.countTo.js', array(), false, true);
    wp_enqueue_script('ConuntTo');
    
    wp_register_script('Cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
    wp_enqueue_script('Cookie');
    
    wp_register_script('Custom', get_template_directory_uri() . '/js/custom.js', array(), false, true);
    wp_enqueue_script('Custom');
    
    wp_register_script('masonry', get_template_directory_uri().'/js/masonry.pkgd.js', array('jquery'), false, true);
    wp_enqueue_script('masonry');
    
    wp_register_script('mprueba', get_template_directory_uri().'/js/pruebamasonry.js', array('jquery'), false, true);
    wp_enqueue_script('mprueba');
    
    // Required files to run background videos
    if ( is_page_template('lanzamientos.php' ) || 
        is_singular( 'upcoming' ) || 
        is_404() 
    ) {
        wp_register_script( 'YTPlayer', get_template_directory_uri(). '/js/jquery.mb.YTPlayer.src.js', array(), false, false );
        wp_enqueue_script( 'YTPlayer' );
        
        wp_register_style('YTPlayerCSS', get_template_directory_uri(). '/css/jquery.mb.YTPlayer.min.css', array(), null );
        wp_enqueue_style( 'YTPlayerCSS' );
    }
    
    if ( is_singular() ) {
        wp_register_script( 'paroller', get_template_directory_uri() . '/js/jquery.paroller.min.js', array(), null, false );
        wp_enqueue_script( 'paroller' );
    }
    
    if ( get_post_format() === 'gallery' ) {
        wp_register_script( 'slick', get_template_directory_uri() . '/js/slick.js', array(), null, false );
        wp_enqueue_script( 'slick' );
        wp_register_style('slickcss', get_template_directory_uri(). '/css/slick.css', array(), null );
        wp_enqueue_style( 'slickcss' );
    }
    
}
add_action('wp_enqueue_scripts', 'encolar_scripts');


function load_gallery_template( $template ) {
    if ( is_single() && get_post_format() === 'gallery' ) {
        $post_format_template = locate_template( 'single-' . get_post_format() . '.php' );
        if ( $post_format_template ) {
            $template = $post_format_template;
        }
    }
 
    return $template;
}   
add_filter( 'template_include', 'load_gallery_template' );

function get_min_excerpt( $limit = 20 ) {
    return sprintf("%s&hellip;", word_count(get_the_excerpt(), $limit ));
}

function get_excerpt($limit, $source = null){

    $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}

function themeprefix_show_cpt_archives($query){
    if(is_category() || is_tag() && empty($query->query_vars['supress_filters'])){
        $query->set('post_type', array('post','nav_menu_item','upcoming'));
        return $query;
    }
}
add_filter('pre_get_posts', 'themeprefix_show_cpt_archives');

//  /* Listado de tags */
function list_tags() {
    $tags = get_tags( array('post_type'=>array('post','upcoming'), 'orderby' => 'count', 'order' => 'DESC', 'number' => 5) );
    foreach (  $tags as $tag ) {
        echo '<li><a style="text-transform:capitalize" href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . ' <span>(' . $tag->count . ')</span></a></li>';
    }
}

function list_tags_pull() {
    $tags = get_tags( array('post_type'=>array('post','upcoming'), 'orderby' => 'count', 'order' => 'DESC', 'number' => 5) );
    foreach (  $tags as $tag ) {
        echo '<li><a style="text-transform:capitalize" href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . ' <span class="pull-right">' . $tag->count . '</span></a></li><hr class="hrsoft">';
    }
}

//  /* Listado de categorías */
function list_categories() {
    $categories = get_categories( array('post_type'=>array('post','upcoming'), 'orderby' => 'count', 'order' => 'DESC', 'number' => 5) );
    foreach (  $categories as $category ) {
        echo '<li><a style="text-transform:capitalize" href="' . get_category_link ($category->term_id) . '" rel="tag">' . $category->name . ' <span>(' . $category->count . ')</span></a></li>';
    }
}

// /* Contador de visitas */
function get_num_visits($post_id) {
    $numvisits = 1;
    $sufix =' Visit';
    if (!add_post_meta($post_id, 'numvisits', $numvisits, true)) {
        $numvisits = get_post_meta($post_id, 'numvisits', true) + 1;
        $sufix = ' Visits';
        update_post_meta($post_id, 'numvisits', $numvisits);
    }
    return $numvisits . $sufix;
}

//Breadcrumbs
function custom_breadcrumbs() {
    $home_title         = 'News';
    $custom_taxonomy    = 'product_cat';
    global $post,$wp_query;
    if ( !is_front_page() ) {
        if(is_home()){
            echo '<li><strong>' . $home_title . '</strong></li>';
        }else{
            echo '<li><a href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        }
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            echo '<li>' . post_type_archive_title($prefix, false) . '</li>';
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
            $post_type = get_post_type();
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<li><a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
            }
            $custom_tax_name = get_queried_object()->name;
            echo '<li>' . $custom_tax_name . '</li>';
        } else if ( is_single() ) {
            $post_type = get_post_type();
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<li><a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
            }
            $category = get_the_category();
            if(!empty($category)) {
                $last_category = end(array_values($category));
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li>'.$parents.'</li>';
                }
             
            }
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
            }
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li>' . get_the_title() . '</li>';
            } else if(!empty($cat_id)) {
                echo '<li><a href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li>' . get_the_title() . '</li>';
            } else {
                echo '<li>' . get_the_title() . '</li>';
            }
        } else if ( is_category() ) {
            echo '<li>' . single_cat_title('', false) . '</li>';
        } else if ( is_page() ) {
            if( $post->post_parent ){
                $anc = get_post_ancestors( $post->ID );
                $anc = array_reverse($anc);
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li><a href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                }
                echo $parents;
                echo '<li>' . get_the_title() . '</li>';
            } else {
                echo '<li>' . get_the_title() . '</li>';
            }
        } else if ( is_tag() ) {
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
            echo '<li>' . $get_term_name . '</li>';
        } elseif ( is_day() ) {
            echo '<li><a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li><a href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li>' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</li>';
        } else if ( is_month() ) {
            echo '<li><a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li>' . get_the_time('M') . ' Archives</li>';
        } else if ( is_year() ) {
            echo '<li>' . get_the_time('Y') . ' Archives</li>';
        } else if ( is_author() ) {
            global $author;
            $userdata = get_userdata( $author );
            echo '<li>Author: ' . $userdata->display_name . '</strong></li>';
        } else if ( get_query_var('paged') ) {
            echo '<li>'.__('Page') . ' ' . get_query_var('paged') . '</li>';
        } else if ( is_search() ) {
            echo '<li>Results for : ' . get_search_query() . '</li>';
        } elseif ( is_404() ) {
            echo '<li>' . 'Error 404' . '</li>';
        }
    }
       
}

function my_excerpt_length( $length ) {
    if(!is_home()){
        return 40;
    } else {
        return 80;
    }
}
add_filter( 'excerpt_length', 'my_excerpt_length', 999 );

function add_responsive_class($content){
        if ($content){ // Por si hemos dejado vacio el content en los posts no estándar
            $post_format = get_post_format();   
            switch ($post_format){
                case 'quote': 
                    // Añadimos la clase my_quote al primer párrafo del post tipo quote
                    $newcontent = preg_replace('/<p([^>]+)?>/', '<p$1 class="my_quote">', $content, 1);
                    // Añadimos la clase my_quote_author al segundo párrafo del post tipo quoted_printable_decode
                    return preg_replace('/<p([^>]+)?>/', '<p$1 class="my_quote_author">', $newcontent, 2);
                    break;
                default:    
                // convertimos el contenido a una codificación HTML en UTF8
                $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
                $document = new DOMDocument(); // Representa al documento html
                // Deshabilitamos los errors libxml y habilita el manejo por parte del usuario -true-
                libxml_use_internal_errors(true);
                // Cargamos el contenido del post en el objeto DOMDocument
                $document->loadHTML(utf8_decode($content)); 
                // Recogemos en el array $imgs todos los tags img que tenga el documento
                $imgs = $document->getElementsByTagName('img');
                // Los recorremos y a cada uno le asignamos el atributo class con el valor img-responsive
                foreach ($imgs as $img) {           
                   $img->setAttribute('class','img-responsive');
                   $img->setAttribute('width', '100%');
                   $img->setAttribute('height', '100%');
                   /*
                   $existing_class = $img->getAttribute('class');
                   $img->setAttribute('class', "img-responsive $existing_class");
                   */
                }
                // Salvamos los cambios
                $html = $document->saveHTML();
                return $html; 
            } // del switch
        } // del if
}
add_filter ('the_content', 'add_responsive_class');

//function para obtener la primera imagen
function get_first_image() {
    if(!has_post_thumbnail()){
        global $post, $posts;
     
        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = ( isset( $matches[1][0] ) ) ? $matches[1][0] : '';
        
        // Defines a default image here
        if(empty($first_img)){
        $first_img = get_template_directory_uri()."/images/default-photo.png";
        }
    }else{
        $first_img = get_the_post_thumbnail_url();
    }
    return $first_img;
}

function cut35($title){
    $title_length = strlen($title);
    if ($title_length > 35){
        $title = substr($title, 0, 33)."...";
    }
    return $title;
}

add_action( 'pre_get_posts', function ( $q ) {
    if (    $q->is_home() && $q->is_main_query() ) {
        $q->set( 'posts_per_page', 4 );
        $q->set( 'post_type', array('upcoming','post'));
    }
});

add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
function tgm_io_cpt_search( $query ) {
	
    if ( $query->is_search ) {
	$query->set( 'post_type', array( 'post', 'upcoming') );
    }
    
    return $query;
    
}

function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'upcoming'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );



/*Título*/
function my_title(){
    if (function_exists('is_tag') && is_tag()) {
        single_tag_title('Archive &quot;'); echo '&quot; · ';
    } elseif (is_archive()) {
        echo ' Archive : ';
        wp_title(''); 
    } elseif (is_search()) {
        echo 'Search for &quot;'.wp_specialchars($_GET['s']).'&quot; · ';
    } elseif (!(is_404()) && (is_single()) || (is_page())) {
             bloginfo('name'); wp_title();
    } elseif (is_404()) {
        echo 'Not Found · ';
    }
    if (is_front_page()) {
        echo ' | News';//bloginfo('name'); echo ' · '; bloginfo('description');
    } elseif (is_home()) {
       bloginfo('name'); wp_title();
    }
    if (isset($paged) && $paged > 1) {
        echo ' · page '. $paged;
    }  
}

function my_login_logo(){
   echo '
   <style type="text/css">
        #login h1 a, .login h1 a { background-image: url('; echo get_bloginfo("template_url"); echo '/images/logo-bg.png);
            background-size: 300px, 350px;
            height: 200px;
            width:300px;
            background-repeat: no-repeat;
        }
        #login_error{
            display: none;
        }
        
        #backtoblog{
            display: none;
        }
    </style>';
}

add_action('login_enqueue_scripts','my_login_logo');

function my_login_logo_url(){
    return home_url();
}

add_filter('login_headerurl','my_login_logo_url');

function get_video_background( $post ) {
    
    $video = get_post_meta( $post->ID, 'trailerlink', true );
    if ( null === $video || $video === '' ) {
        //return null;
    }
    if ( ! filter_var( $video, FILTER_VALIDATE_URL ) ) {
        //return null;
    }
    
    $s = '';
    
    $s .= '
        <div';
    if ( $video !== '' ) {
        $s.= ' id="videoPlayer" class="thumbnail-post-single full-wh"  style="background-image: url( ' . get_first_image() . ')";';
    }
    if ( $video !== '' ) {
        $s .= '
            data-property="{
                videoURL: \'' .  $video . '\',
                containment: \'self\',
                autoPlay:true, 
                mute:true, 
                startAt:0, 
                opacity:1,
                showControls: true,
                useOnMobile: false,
                highres: \'highres\',
            }"';
    }
    $s .= '>
            <div class="bg-fade">
                <div class="item-info align-right">
                    <div class="title-div">
                        <h1 class="title cpost-title align-right">
                            <a href=" ' . get_the_permalink() . '">
                                ' . get_the_title() . '
                            </a>
                        </h1>
                    </div>
                    <p class="align-right">
                        ' . get_excerpt(200) . '
                        <br><br><br>
                        <i class="far fa-clock"></i> ' . get_the_time('j, M Y') . '
                        <br>
                        <i class="fas fa-eye"></i> '. get_num_visits( $post->ID ) . '
                    </p>
                    <p class="align-right"></p>
                    <p class="align-right"></p>
                    <a href="#post-single" class="arrow-link down">&darr;</a>
                </div>
            </div>
        </div>
    
    ';
    
    return $s;
}

    function get_post_images($post) {
        $doc = new DOMDocument();
        $doc->loadHTML($post->post_content);
        $images = $doc->getElementsByTagName('img');
        //$img->getAttribute("src") to get the src
        return $images;
    }
