<?php
//traite les donnees ajax envoyé par fichier script.js

$getParam = isset($_REQUEST['param']) ? $_REQUEST['param']: '';

if(!empty($getParam)){
    if($getParam="get_message"){
        echo json_encode(array(
            "name"=>"online web tutor",
            "author"=>"kevin"
        ));
        die();
    }
    if($getParam="post_form_data"){
        echo json_encode($_REQUEST);
        die();
    }

}

//traite les donnees envoyé par le formulaire add-new.php en ajax
//contenant le nom, le mail, et les donnees de l'editor de texte cree sur la page add-new
$getParam = isset($_REQUEST['param']) ? $_REQUEST['param']: '';
global $wpdb;
if(!empty($getParam)){
    if($getParam="savedata"){
        isset($_REQUEST['name']) ? $_REQUEST['name']: '';
        isset($_REQUEST['email']) ? $_REQUEST['email']: '';
        isset($_REQUEST['desc']) ? htmlspecialchars($_REQUEST['desc']): '';
        $wpdb->insert($wpdb->prefix . "custom_plugin", array(
            "name" => $name,
            "email" => $email,
            "description"=> $desc
        ));
        echo json_encode(array("status" =>1, "msg"=>"data saved"));
    }
}



