<?php
/*
Plugin Name: My Book
Description: Second homemade plugin.
Author: kevin prevost
Version: 1.0
*/

/* second plugin development youtube d'une liste*/ 

//plugin exist ?
if(!defined('ABSPATH'))
    exit;
//on met accessible 2 constante a travers tout le plugin
//1er qui sert pour retrouver le chemin des fichiers php
//2eme sert pour retrouver le chemin des fichiers css, images et js
if(!defined("MY_BOOK_PLUGIN_DIR_PATH"))
    define("MY_BOOK_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
if(!defined("MY_BOOK_PLUGIN_URL"))
    define("MY_BOOK_PLUGIN_URL", plugins_url()."/my-books");


function my_book_include_assets(){

    $slug = '';
    $pages_includes = array("frontendpage","book-list", "add-new", "add-author", "remove-author", "add-student", "remove-student", "course-tracker");

    $currentPage = $_GET['page'];

    if(empty($currentPage)){
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if(preg_match("/my_book/", $actual_link)){
            $currentPage = "frontendpage";
        }
    }

    if(in_array($currentPage, $pages_includes)){
    
        wp_enqueue_style("bootstrap", MY_BOOK_PLUGIN_URL. "/assets/css/bootstrap.css", "");
        wp_enqueue_style("datatable", MY_BOOK_PLUGIN_URL. "/assets/css/jquery.dataTables.min.css", "");
        wp_enqueue_style("notifybar", MY_BOOK_PLUGIN_URL. "/assets/css/jquery.notifyBar.css", "");
        wp_enqueue_style("style", MY_BOOK_PLUGIN_URL. "/assets/css/style.css", "");

        wp_enqueue_script("jquery");
        wp_enqueue_script("bootstrap.min.js", MY_BOOK_PLUGIN_URL. '/assets/js/bootstrap.min.js', "", true);
        wp_enqueue_script("validation.min.js", MY_BOOK_PLUGIN_URL. '/assets/js/jquery.validate.min.js', "", true);
        wp_enqueue_script("datatable.min.js", MY_BOOK_PLUGIN_URL. '/assets/js/jquery.dataTables.min.js', "", true);
        wp_enqueue_script("jquery.notifybar.min.js", MY_BOOK_PLUGIN_URL. '/assets/js/jquery.notifyBar.js', "", true);
        wp_enqueue_script("script.js", MY_BOOK_PLUGIN_URL. '/assets/js/script.js', "",true);
        wp_localize_script("script.js", "mybookajaxurl", admin_url('admin-ajax.php'));
    }

}
add_action('init', 'my_book_include_assets');

function my_book_plugin_menus(){
    add_menu_page(
        "my book", //page title
        "my book", //menu title
        "manage_options", //admin level
        "book-list", //page slug - parent slug
        "my_book_list", //callback function
        "dashicons-book-alt", //icon url
        30, //position sur le menu
    );
    add_submenu_page(
        "book-list", //parent slug
        "Book List", //page title
        "Book List", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "book-list", //menu slug
        "my_book_list" //callback function
    );
    add_submenu_page(
        "book-list", //parent slug
        "Add New", //page title
        "Add New", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "add-new", //menu slug
        "my_book_Add" //callback function
    );
    add_submenu_page(
        "book-list", //parent slug
        "Add New Author", //page title
        "Add New Author", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "add-author", //menu slug
        "my_author_add" //callback function
    );
    add_submenu_page(
        "book-list", //parent slug
        "Manage Author", //page title
        "Manage Author", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "remove-author", //menu slug
        "my_author_remove" //callback function
    );
    add_submenu_page(
        "book-list", //parent slug
        "Add New Student", //page title
        "Add New Student", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "add-student", //menu slug
        "my_student_add" //callback function
    );
    add_submenu_page(
        "book-list", //parent slug
        "Manage Student", //page title
        "Manage Student", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "remove-student", //menu slug
        "my_student_remove" //callback function
    );
    add_submenu_page(
        "book-list", //parent slug
        "Course Tracker", //page title
        "Course Tracker", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "course-tracker", //menu slug
        "course_tracker" //callback function
    );
    add_submenu_page(
        "book-list", //parent slug
        "", //page title
        "", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "book-edit", //menu slug
        "my_book_edit" //callback function
    );
}
function my_author_add(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/author-add.php';
}
function my_author_remove(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/manage-author.php';
}
function my_student_add(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/student-add.php';
}
function my_student_remove(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/manage-student.php';
}
function course_tracker(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/course-tracker.php';
}

add_action('admin_menu', 'my_book_plugin_menus');

function my_book_list(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/book-list.php';
}
function my_book_Add(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/book-add.php';
}
function my_book_edit(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/book-edit.php';
}

//sql
function my_book_table(){
    global $wpdb;
    return $wpdb->prefix."my_books";
}
function my_books_generates_table_script(){
    global $wpdb;
    require_once ABSPATH . "wp-admin/includes/upgrade.php";

    $sql = "
        CREATE TABLE " .my_book_table(). " (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) DEFAULT NULL,
        `author` varchar(255) DEFAULT NULL,
        `about` text,
        `book_image` text,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
       ";
    dbDelta($sql);

    $sql2 = "
    CREATE TABLE `".my_authors_table()."` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) DEFAULT NULL,
        `fb_link` text,
        `about` text,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
       ";
       dbDelta($sql2);

    $sql3 = "
        CREATE TABLE `".my_students_table()."` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) DEFAULT NULL,
        `email` varchar(255) DEFAULT NULL,
        `user_login_id` int(11) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
       ";
       dbDelta($sql3);

    $sql4 = "
        CREATE TABLE `".my_enrol_table()."` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `student_id` int(11) NOT NULL,
        `book_id` int(11) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
       ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
       ";
        dbDelta($sql4);
        
        //attribuer un role a un utilisateur
        add_role("wp_book_user_key", "My Book User", array(
            "read"=>true
        ));

        //creation de pages dynamiques
        $my_post = array(
            'post_title'    => "Book Page",
            'post_content'  => "[book_page]",//shortcode
            'post_status'   => 'publish',
            'post_type' => "page",
            'post_name' => "my_book"//c est le slug
          );
           
          // Insert the post into the database
          $book_id = wp_insert_post( $my_post );
          add_option("my_book_page_id", $book_id);
}
register_activation_hook(__FILE__, "my_books_generates_table_script");
//creation du contenu de la page dynamique
function my_book_page_function(){
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/my_books_frontend_lists.php';
}
add_shortcode("book_page", "my_book_page_function");

function my_authors_table(){
    global $wpdb;
    return $wpdb->prefix."my_authors";
}
function my_students_table(){
    global $wpdb;
    return $wpdb->prefix."my_students";
}
function my_enrol_table(){
    global $wpdb;
    return $wpdb->prefix."my_enrol";
}

function drop_table_plugin_books(){
    global $wpdb;
    $wpdb->query('DROP TABLE IF EXISTS ' .my_book_table());
    $wpdb->query('DROP TABLE IF EXISTS ' .my_authors_table());
    $wpdb->query('DROP TABLE IF EXISTS ' .my_students_table());
    $wpdb->query('DROP TABLE IF EXISTS ' .my_enrol_table());

    if(get_role("wp_book_user_key")){
        remove_role("wp_book_user_key");
    }
    //delete password
    if(!empty(get_option("my_book_page_id"))){
        $page_id = get_option("my_book_page_id");
        wp_delete_post($page_id, true);//wp_post
        delete_option("my_book_page_id");//wp_option
    }
}
register_deactivation_hook(__FILE__, "drop_table_plugin_books");

add_action("wp_ajax_mybooklibrary", "my_book_ajax_handler");
function my_book_ajax_handler(){
    global $wpdb;
    include_once MY_BOOK_PLUGIN_DIR_PATH.'/library/my_booklibrary.php';
    wp_die();
}

add_filter("page_template", "owt_custom_page_layout");

function owt_custom_page_layout($page_template){
    global $post;
    $page_slug = $post->post_name;//book page slug
    if($page_slug =="my_book"){
        $page_template = include_once MY_BOOK_PLUGIN_DIR_PATH.'/views/frontend-books-template.php';
    }
    return $page_template;
}

function get_author_details($author_id){
    global $wpdb;
    $author_details = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM ".my_authors_table(). "WHERE id = %d,$author_id", ""
        ),ARRAY_A
    );
}

function owt_login_user_role_filter($redirect_to,$request,$user){
    //customer user role
    global $user;
    if (isset($user->roles) && is_array($user->roles)){
        if (in_array("wp_book_user_key", $user->roles)){
            return $redirect_to = site_url()."/my_book";
        }
        else{
            return $redirect_to;
        }
    }
}
add_filter("login_redirect","owt_login_user_role_filter",10,3);

function owt_logout_user_role_filter(){
    //custom user role
    wp_redirect(site_url()."/my_book");
    exit();
}
add_filter("wp_logout", "owt_logout_user_role_filter");
?>