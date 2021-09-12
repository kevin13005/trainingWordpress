<?php

function glacever_scripts(){

    wp_enqueue_style('main_style', get_stylesheet_uri());//principal css
    wp_enqueue_style('style_file', get_template_directory_uri().'/css/style.css');//trouvez le chemin de depart du theme
    wp_enqueue_style('flat_file', get_template_directory_uri().'/css/flaticon.css');// get_theme_file_uri(), c'st pour la nouvelle version wordpress
    wp_enqueue_style('animate_file', get_template_directory_uri().'/css/animate.css');//il y aussi get_parent_theme_file_uri() si t es dans un theme enfant et tu veux un fichier du theme parent
    wp_enqueue_style('carousel_file', get_template_directory_uri().'/css/owl.carousel.min.css');
    wp_enqueue_style('default_file', get_template_directory_uri().'/css/owl.theme.default.min.css');
    wp_enqueue_style('popup_file', get_template_directory_uri().'/css/magnific-popup.css');
    wp_enqueue_style('datepicker_file', get_template_directory_uri().'/css/bootstrap-datepicker.css');
    wp_enqueue_style('timepicker_file', get_template_directory_uri().'/css/jquery.timepicker.css');
    
    wp_enqueue_script('jquery.min.js', get_template_directory_uri().'/js/jquery.min.js', array(), '1.1', true);
    wp_enqueue_script('jquery-migrate-3.0.1.min.js', get_template_directory_uri().'/js/jquery-migrate-3.0.1.min.js', array(), '1.1', true);
    wp_enqueue_script('popper.min.js', get_template_directory_uri().'/js/popper.min.js', array(), '1.1', true);
    wp_enqueue_script('bootstrap.min.js', get_template_directory_uri().'/js/bootstrap.min.js', array(), '1.1', true);
    wp_enqueue_script('jquery.easing.1.3.js', get_template_directory_uri().'/js/jquery.easing.1.3.js', array(), '1.1', true);
    wp_enqueue_script('waypoints.min.js', get_template_directory_uri().'/js/jquery.waypoints.min.js', array(), '1.1', true);
    wp_enqueue_script('stellar.min.js', get_template_directory_uri().'/js/jquery.stellar.min.js', array(), '1.1', true);
    wp_enqueue_script('jquery.animateNumber.min.js', get_template_directory_uri().'/js/jquery.animateNumber.min.js', array(), '1.1', true);
    wp_enqueue_script('bootstrap-datepicker.js', get_template_directory_uri().'/js/bootstrap-datepicker.js', array(), '1.1', true);
    wp_enqueue_script('jquery.timepicker.min.js', get_template_directory_uri().'/js/jquery.timepicker.min.js', array(), '1.1', true);
    wp_enqueue_script('owl.carousel.min.js', get_template_directory_uri().'/js/owl.carousel.min.js', array(), '1.1', true);
    wp_enqueue_script('jquery.magnific-popup.min.js', get_template_directory_uri().'/js/jquery.magnific-popup.min.js', array(), '1.1', true);
    wp_enqueue_script('scrollax.min.js', get_template_directory_uri().'/js/scrollax.min.js', array(), '1.1', true);
    wp_enqueue_script('google-map.js', get_template_directory_uri().'/js/google-map.js', array(), '1.1', true);
    wp_enqueue_script('main.js', get_template_directory_uri().'/js/main.js', array(), '1.1', true);
    wp_enqueue_script('jquery-ui-button', array('jquery'));

}
add_action("wp_enqueue_scripts", "glacever_scripts");

//-------------------------------menu------------------------------------//

//enregistrer le menu jaune avec nos 6 liens
function register_glacever_theme(){
    //enregistrer code pour menu
    register_nav_menus(
        array(
            'header'=> 'Primary Menu',
            'footer'=> 'Footer Menu'
        )
    );
}
add_action('init', 'register_glacever_theme');
/*
//ajouter une class au lien du menu <a></a>
add_filter("nav_menu_link_attributes", "ajout_href_a");
function ajout_href_a($attr){
    $attr['class'] = "nav-link";
    return $attr;
}

//ajouter des classe au li du menu
add_filter("nav_menu_css_class", "ajout_li_class",10,4);
function ajout_li_class($classes, $attr, $args,$dept){
    $classes[] = "nav-item";
    return $classes;
  }
*/
//---------------------------------fin menu--------------------------------------//

//personnaliser un logo a nous
//mettre un endroit logo dans la section personnaliser (episode 8)
function themename_custom_logo_setup(){

    $defaults = array(
    'height'      => 50,
    'width'       => 177,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');

//creer dans l admin une autre section pour les articles; c est comme si on refaisait la section article
function register_my_projects() {

    register_post_type('custom-project', array(
        'labels'=>array(
            'name'=> _('Our Projects'),
            'singular_name'=> _('custom_projects')
        ),
        'public'=>true,
        'show_in_nav_menus'=>true,
        'has_archive'=>false,
        'supports'=>array('title', 'editor', 'excerpt', 'author', 'comments', 'revisions', 'custom-fields')
        )
    );
}
add_action( 'init', 'register_my_projects' );

//ajouter une partie widget dans apparence et y ajouter une sidebar
function glacever_register_sidebar(){
    register_sidebar(array(
        'name'=>__('primary sidebar 1', 'theme_name'),
        'id'=>'sidebar-1',
        'before_title'=>'<h1 class="widget-title">',
        'after_title'=>'</h1>'
    ));
}
add_action('widgets_init', 'glacever_register_sidebar');

//ajouter une partie dans pages et articles ou on peut ajouter une image mis en avant
function glacever_theme_supports(){

    add_theme_support('post-thumbnails');
    //quand on prend une image de la bibliotheque, elle sera a ce format a l affichage
    add_image_size('small-thumbnail',120,90,true);//ce nom sera argument a l appel de the_post_thumbnail('small-thumnail)
    add_image_size('banner-image',700,350,true);//meme chose mais la l'image sera en plus grand
    //ajoute une partie avec un format a choisir
    add_theme_support('post-formats',array('aside', 'gallery','link'));
}
add_action('after_setup_theme', 'glacever_theme_supports' );

//ajouter un section article bis 
function owt_custom_init() {
    $args = array(
        'public'    => true,
        'label'     => 'movies',
    );
    register_post_type( 'movies', $args );
}
add_action( 'init', 'owt_custom_init' );

//internationalisation
function my_theme_load_theme_textdomain() {
    load_theme_textdomain( 'custom-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_theme_load_theme_textdomain' );

?>