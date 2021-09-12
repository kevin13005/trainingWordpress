/* fichier js */

jQuery(function(){

    /*-------------------------------ajax -----------------------------------------------------------*/

    //2me moyen requete ajax possible
    jQuery("#frmpostOtherPage").on("click", function(e){
        //pour eviter de soumettre le formulaire au click, on le soumet sur le formulaire entier
        e.preventDefault();
        jQuery.post(ajaxurl,{action:"custom_plugin",name:"online web tutor",tut:"word plug"}, function(){
            console.log(response);
        });
    });

    //2eme ajax requete possible pour les formulaires
    jQuery("#frmpostOtherPage").validate({
        //propriete de validate()
        submitHandler:function(){
            //passer des donnees dynamique avec serialize()
            var post_data = jQuery("#frmpostOtherPage").serialize()+"action=custom_ajax_req";
            jQuery.post(ajaxurl, post_data, function(){
                var data = parseJSON(response); //pour recuperer proprement les donnees en json apres comme le nom
                console.log(data.name);
            });
        }
    });

    //1er moyen requete ajax possible
    jQuery(document).on("click", ".btn-clik", function(){
        
        var post_data = "action=custom_plugin_library&param=get_message";
        jQuery.post(ajaxurl, post_data, function(response){
            console.log(response);
        });
    });

    //valider un formulaire en utilisant le plugin jquery validate avec 1ere methode
    $("#frmpost").validate({
        //propriete de validate()
        submitHandler:function(){
            //serialize pour tous mettre en 1 bloc de donnees
            var post_data = $("#frmpost").serialize()+"action=custom_plugin_library&param=post_form_data";
            //utilisation ajax
            $.post(ajaxurl, post_data, function(response){
                var data = $.parseJSON(response);
                console.log(data);
                consologe.log(data.txtname);
            });
        }
    });

    /*-------------------------------ajout image de media library wordpress -------------------------------*/

    //utilisable grace a wp_enqueue_media() mis dans le fichier php ciblé, ici add-new.php

    jQuery("#btnimage").on('click', function(){
        //acceder a la media library
        //on l'ouvre, puis on selectionne
        //on obtient la selection et on l'envoie en json
        var images = wp.media({
            title: "upload image",
            multiple: "false"
        }).open().on('select', function(){
            var uploadedImages = images.state().get("selection");
            var selectedImages = uploadedImages.toJSON();
            //si on veut afficher l'image selectionné, on ajoute .first() apres get(selection)
            //et on utilise la methode attr()
            jQuery("#getimage").attr("src", selectedImages.url);

        });
        //1ere methode pour recuperer plusieurs valeurs
        //si la proprieté multiple est sur true, donc qu on peut selectionner plusieurs images alors boucle
        jQuery.each(selectedImages, function(index, image){
            console.log("image url "+image.url+" et titre "+image.title);
        });
        //2eme methode pour ptopriete multiple sur true
        //on enlevera a selectedImages ligne 62, le .toJSON() 
        selectedImages.map(function(image){
            var itemDetail = image.toJSON();
            console.log(itemDetail.url);
        });
    });

/*--------------------------traiter formulaire dynamiquement, et avec un editor------------------------------*/

jQuery("#frmpost").validate({
    //propriete de validate()
    submitHandler:function(){
        var email = jQuery("#txtEmail").val();
        var name = jQuery("#txtname").val();
        var description = encodeURIComponent(tinyMCE.get("description_id").getContent());

        var postdata = action = "custom_plugin_library&param=savedata&email="+email+"&name="+name+"&desc="+description;
        jQuery.post(ajaxurl, postdata, function(response){
            console.log(response);
        })

});