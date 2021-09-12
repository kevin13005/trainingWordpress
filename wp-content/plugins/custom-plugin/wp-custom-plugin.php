<?php
/*
Plugin Name: Custom Plugin
Description: First homemade plugin.
Author: kevin prevost
Version: 1.0
*/

/* web tutor online plugin development youtube */ 

//definition des constantes
//chemins pour nos fichiers php ou js,css,images
//ou autre constante ici pour la version du plugin qui est 1.0
define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));//va jusqu'au c de l'ordi, pour les include php files, chemin absolu
define('PLUGIN_URL', plugins_url());//s'arrete a localhost, pour les images,css,js,   chemin relatif
define("PLUGIN_VERSION", "1.0");


/*-----------------------------------ajout menu sous-menu -------------------------------------*/

//ajouter un menu et sous menu a l admin wordpress
function add_my_custom_menu(){
    add_menu_page(
        "customplugin", //page title
        "Custom Plugin", //menu title
        "manage_options", //admin level
        "custom-plugin1", //page slug - parent slug
        "custom_admin_view", //callback function
        "dashicons-dashboard", //icon url
        11, //position sur le menu
    );
    add_submenu_page(
        "custom-plugin1", //parent slug
        "Add new", //page title
        "Add new", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "add-new", //menu slug
        "add_new_function" //callback function
    );
    add_submenu_page(
        "custom-plugin1", //parent slug
        "All pages", //page title
        "All pages", //menu title, c est lui qui s affiche sur le sous menu
        "manage_options", //capability = user level access
        "All-pages", //menu slug
        "all_page_function" //callback function
    );
}//ajoute la fonction a wordpress 
add_action("admin_menu", "add_my_custom_menu");

/*------------------------------- chemin, contenu, fichier à inclure ---------------------------------*/

//fonction pour ajouter le contenu dans les differentes pages de l admin
//chaque page a un fichier differents appelé ici grace a include
function custom_admin_view(){
    echo "<h1> Hello kevin ! </h1>";
}
function add_new_function(){
    include_once PLUGIN_DIR_PATH."/view/add-new.php";
}
function all_page_function(){
    include_once PLUGIN_DIR_PATH."/view/all-page.php";
}

/*--------------------------css et js accessible globalement -----------------------------------------*/

//ajouter les fichiers css ou js au plugin pour
//leur accessibilité et propagation partout sur le plugin
function custom_plugin_assets(){
    //css and js files
    wp_enqueue_style(
        "cpl_script", //nom unique pour css file
        PLUGIN_URL.'/custom-plugin/assets/css/style.css',//css files path
        '',//dependency on other files
        PLUGIN_VERSION, //numero de plugin version
    );
    wp_enqueue_script(
        "cpl_style", //nom unique pour css file
        PLUGIN_URL.'/custom-plugin/assets/js/script.js',//css files path
        '',//dependency on other files
        PLUGIN_VERSION, //numero de plugin version
        false //la balise script sera en haut a cote du css avec false, sinon avec true elle sera en bas
    );

    //3eme parametre qui represente toutes les valeurs d'un objet, 
    //le 2eme est le nom qu'a cette objet sur le code source 
    //le 1er il est rattaché a wp_enqueue_script qui a le nom cpl_script
    
    //localise et fait passer du javascript a travers ses parametres, comme l'ajax par exemple
    wp_localize_script("cpl_style", "ajaxurl", admin_url("admin-ajax.php"));
}
add_action("init", "custom_plugin_assets");

/*---------------------------------ajax sur wordpress ------------------------------------------------*/

//depend de admin-ajax.php
//1 fichier js jquery de requete ajax (script.js)
//1 fichier de recption des donnees (custom-plugin-lib.php)
//1fichier declenchant la requete ajax ou se situe l'evennement declencheur(add-new.php)
//1 fichier qui fait la jonction entre le fichier ajax et le fichier reception
if(isset($_REQUEST['action'])){//verifie si parametre action est fixé ou non
    switch(isset($_REQUEST['action'])){
        case "custom_plugin_library" : add_action("admin-init", "add_custom_plugin_library");
        function add_custom_plugin_library(){//fonction attaché avec le hook
            global $wpdb;
            include_once PLUGIN_DIR_PATH."/library/custom-plugin-lib.php";//fichier qui manipule l ajax
        }
        break;
    }
}
//2eme moyen custom ajax
add_action('wp_ajax_custom_ajax_req','custom_ajax_req_fn');

function custom_ajax_req_fn(){
    echo json_encode($_REQUEST);
    wp_die();
}


//2eme moyen de faire de l'ajax
add_action('wp_ajax_custom_plugin','prefix_ajax_custom_plugin');

function prefix_ajax_custom_plugin(){
    print_r($_REQUEST);
    wp_die();
}


/*--------------------------------------- la base de donnees en wordpress -------------------------------------*/

//1 creer des tables en bdd quand on cree le plugin 
//$wpdb est l objet wordpress pour se connecter en base
function custom_plugin_tables(){
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    //get_var pour chercher une variable dans la base de donnees
    if(count($wpdb->get_var('SHOW TABLES LIKE "wp_custom_plugin')) == 0){
        $sql_query_to_create_table = "CREATE TABLE `wp_custom_plugin` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `name` varchar(150) DEFAULT NULL,
                                    `email` varchar(150) DEFAULT NULL,
                                    `phone` varchar(150) DEFAULT NULL,
                                    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
                                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4"; //sql query to create table
        //dbDelta() c est comme query() pour wordpress
        dbDelta($sql_query_to_create_table);
    }
}
register_activation_hook(__FILE__, 'custom_plugin_tables');

//2 supprimer une table à la desactivation du plugin
//on peut supprimer une table à la suppression du plugin aussi
//en utilisant register_uninstall_hook()
function deactivate_table(){
    global $wpdb;
    $wpdb->query("DROP table IF Exists wp_custom_plugin");

    //j,obtiens avec get_option l'id du champ option_name de la table wp_option
    $the_post_id = get_option("custom_plugin_page_id");
    if(!empty($the_post_id)){
        //suppression de la page contenant l'id de custom_plugin_page_id dans la table wp_post
        wp_delete_post($the_post_id, true);
    }

}
register_deactivation_hook(__FILE__, 'deactivate_table');

//3 creer une page, elle se trouve toutes
//dans la table wp-post dans la bdd, les pages et articles
function create_page(){
    $page = array();//ex $page['post_title'] et les autres sont des champs dans la table wp-post 
    $page['post_title'] = "Custom plugin kevin";
    $page['post_content'] = "learn how to customize plugin";
    $page['post_status'] = "publish";
    $page['post_slug'] = "Custom-plugin-online";
    $page['post_type'] = "page";

    $post_id = wp_insert_post($page);//inserer les donnees dans table wp_post et donc cree une page dans wordpress
    //retourne post_id

    //ajout a la table wp_options d'une ligne de la table wp_post
    //que j'appelle "custom_plugin_page_id", ce sera le champ option_name de wp_option
    add_option("custom_plugin_page_id", $post_id);


}   
register_activation_hook(__FILE__, 'create_page');

/*---------------------------------------shortcode en wordpress ------------------------------------------------*/

//ajouter des bouts de code dans des pages 

//ca s'ajoute direct apres le titre sur une page qu'on cree sur wordpress  --> [custom-plugin]
//ou dans un fichier php direct avec la fonction do_shortcode()
add_shortcode("custom-plugin", "customPluginFunction");
//on va chercher le shortcode et on l'inclue 
function customPluginFunction(){
    include_once PLUGIN_DIR_PATH.'/views/shortcode-template.php';
}

//1ere methode , on ajoute avec des parametres dynamiques 
//ne pas oublier d'ajouter le shortcode sur la page wordpress
add_shortcode("custom-plugin-parameter", "customPluginWithParams");

function customPluginWithParams($params){
    //methode pour ajouter des parametres dynamiquement , c est shortcode_atts()
    $values = shortcode_atts(
        array(//valeur defaut parametre
            "name"=>"prevost",
            "author"=>"kevin"
        ),
        $params,//passer des paramtres dynamiquement
        'custom-plugin-parameter'//optionnel
    );
    echo $values['name'].' and ' . $values['author'];
}

//2eme methode, on ajoute des parametres mais entre les 2 balises tag-based
//on met le 2eme parametres entre nos 2 balises dans wordpress,
//3eme methode, on ajoute un 3eme parametre $tag pour mettre une condition et 2 add_shortcode()
add_shortcode("tag-based", "custom_plugin_tag_based");

function custom_plugin_tag_based($params, $content, $tag){
    if($tag=="tag-based"){
        echo '<h1>' .$content. '</h1>';
    }
    if($tag=="called_me_down"){
        echo "this is kevin";
    }
}

add_shortcode("called_me_down", "custom_plugin_tag_based");








?>