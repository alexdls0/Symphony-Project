<?php
/*
    Plugin Name: upcoming
    Plugin URI: www.capsule.org
    Description: Crear el custom post type de capsule
    Version: 1.0
    Author: admin
    License: GPL
*/

/*
*
*   Función para registrar el custom post type upcoming
*
*/

function registra_upcomings(){
    $supports = array(
        'title', // post title
        //'editor', // post content
        //'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        //'custom-fields', // custom fields
        //'comments', // post comments
        'revisions', // post revisions
        //'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Upcomings', 'plural'), // general name for the post type - usually plural (default = posts/pages)
        'singular_name' => _x('Upcoming', 'singular'), // name for one object of this post type
        'menu_name' => _x('Upcomings', 'admin menu'), // Text for use in the admin area 
        'name_admin_bar' => _x('Upcoming', 'admin bar'), // Text for use in the New option in admin area 
        'add_new' => _x('Add Upcoming', 'Add Upcoming'), // The text for add new (default 'Add New')
        'add_new_item' => __('Add new Upcoming'), // Text for add new item (default 'Add new post'/'Add new page')
        'new_item' => __('New Upcoming'), // idem.
        'edit_item' => __('Edit Upcoming'),  // idem.
        'view_item' => __('See Upcoming'),// idem.
        'all_items' => __('All Upcomings'),// idem.
        'search_items' => __('Seach Upcoming'),// idem.
        'not_found' => __('Upcomings not found.'),// idem.
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true, // Controls how the type is visible to authors (show_in_nav_menus, show_ui) and readers (exclude_from_search, publicly_queryable). Default: false
        'query_var' => true,
        'rewrite' => array('slug' => 'upcoming'),//especificar el slug del custom post type
        'has_archive' => true, // Para que podamos usar la plantilla archive-{custom_post_type}.php   -->  no me funciona
        'hierarchical' => false,
        'menu_position' => 4, // The position in the menu order the post type should appear
        'menu_icon' => 'dashicons-format-video', //The url to the icon to be used for this menu or the name of the icon from the iconfont [1] Default: null - defaults to the posts icon
        // EJEMPLO: 'get_template_directory_uri() . "/images/cutom-posttype-icon.png"' (Use a image located in the current theme)
        //'taxonomies' => array('category'), //  
    );
    register_post_type('upcoming', $args);
}

add_action('init','registra_upcomings');

function add_cat_panels(){
    register_taxonomy_for_object_type('category','upcoming');
    register_taxonomy_for_object_type('post_tag','upcoming');
}
add_action('init','add_cat_panels');

function crear_metabox(){
    $screens = array('upcoming');
    foreach($screens as $screen){
        add_meta_box('upcomings_meta',__('Upcomings rate'),'upcomings_callback',$screen,'normal');
    }
}

add_action( 'add_meta_boxes','crear_metabox' );

function upcomings_callback($post){
    //Crear el campo nonce
    wp_nonce_field('save_metabox','upcomings_nonce');
    
    //Recoger los valores de los campos
    $director = get_post_meta( $post->ID, 'director', true );
    $productor = get_post_meta( $post->ID, 'productor', true );
    $fecha = get_post_meta( $post->ID, 'fecha', true );
    $sinopsis = get_post_meta( $post->ID, 'sinopsis', true );
    $infoadicional = get_post_meta( $post->ID, 'infoadicional', true );
    $trailerlink = get_post_meta( $post->ID, 'trailerlink', true );
    
    //Construir la estructura html
    echo '<h2>Upcoming<h2>';
    
    echo '<fieldset class="mt-5">';
    echo '<label for="director"><h3>Director</h3></label>';
    echo '<input type="text" required style="width:100%;max-width:500px" id="director" value="'.$director.'" name="director">';    
    echo '</fieldset>';
    
    echo '<fieldset class="mt-5">';
    echo '<label for="productor"><h3>Producer</h3></label>';
    echo '<input type="text" required style="width:100%;max-width:500px" id="productor" value="'.$productor.'" name="productor">';    
    echo '</fieldset>';
    
    echo '<fieldset class="mt-5">';
    echo '<label for="fecha"><h3>Release date</h3></label>';
    echo '<input type="date" required id="fecha" value="'.$fecha.'" name="fecha">';    
    echo '</fieldset>';
    
    echo '<fieldset class="mt-5">';
    echo '<label for="sinopsis"><h3>Synopsis</h3></label>';
    echo '<textarea class="col-md-12" style="width:100%;max-width:500px;min-height:250px;white-space: pre-wrap;" id="sinopsis" value="'.$sinopsis.'" name="sinopsis">';
    echo $sinopsis;
    echo '</textarea>';    
    echo '</fieldset>';
    
    echo '<fieldset class="mt-5">';
    echo '<label for="infoadicional"><h3>Information</h3></label>';
    echo '<textarea required class="col-md-12" style="width:100%;max-width:500px;min-height:250px;white-space: pre-wrap;" id="infoadicional" value="'.$infoadicional.'" name="infoadicional">';
    echo nl2br($infoadicional);
    echo '</textarea>';    
    echo '</fieldset>';
    
    echo '<fieldset class="mt-5">';
    echo '<label for="trailerlink"><h3>Link of trailer (Youtube)</h3></label>';
    echo '<input type="text" style="width:100%;max-width:500px" id="trailerlink" value="'.$trailerlink.'" name="trailerlink">';    
    echo '</fieldset>';
}

function save_metabox($post_id){
    //Comprobar el campo nonce
    if( !isset( $_POST['upcomings_nonce'] ) ){
        return;
    }
    
    if( ! wp_verify_nonce( $_POST['upcomings_nonce'], 'save_metabox' ) ){
        return;
    }
    
    //Comprobar que el usuario tiene permisos
    if( ! current_user_can( 'edit_page', $post_id ) ){
        return;
    }
    
    if( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }
    
    //Saneamos los campos antes de salvarlos
    $director = sanitize_text_field($_POST['director']);
    $productor = sanitize_text_field($_POST['productor']);
    $fecha = sanitize_text_field($_POST['fecha']);
    $sinopsis = wp_kses_post($_POST['sinopsis']);
    $infoadicional = wp_kses_post($_POST['infoadicional']);
    $trailerlink = sanitize_text_field( $_POST['trailerlink'] );
    
    //Actualizamos la BBDD
    update_post_meta( $post_id, 'director', $director);
    update_post_meta( $post_id, 'productor', $productor);
    update_post_meta( $post_id, 'fecha', $fecha);
    update_post_meta( $post_id, 'sinopsis', $sinopsis);
    update_post_meta( $post_id, 'infoadicional', $infoadicional);
    update_post_meta( $post_id, 'trailerlink', $trailerlink );
}

add_action( 'save_post', 'save_metabox' );