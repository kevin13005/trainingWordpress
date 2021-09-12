jQuery(document).ready(function() {

    //renroll code
    jQuery(document).on("click", "owt-enrol-btn", function(){
        
    });

    jQuery( ".act" ).click(function() {
        jQuery( ".clik" ).toggle( "slow", function() {
          // Animation complete.
        });
      });


    jQuery('#frmAddstudent').validate({
        submitHandler:function(){
            var post_data = "action=mybooklibrary&param=save_student&" + jQuery('#frmAddstudent').serialize();
            jQuery.post(mybookajaxurl, post_data, function(response){
                var data = jQuery.parseJSON(response);
                if(data.status ==1){
                    jQuery.notifyBar({
                        cssClass:"success",
                        html: data.message
                    });
                }else{

                }
            });
        }
    });
    
    jQuery('#frmAddauthor').validate({
        submitHandler:function(){
            var post_data = "action=mybooklibrary&param=save_author&" + jQuery('#frmAddauthor').serialize();
            jQuery.post(mybookajaxurl, post_data, function(response){
                var data = jQuery.parseJSON(response);
                if(data.status ==1){
                    jQuery.notifyBar({
                        cssClass:"success",
                        html: data.message
                    });
                }else{

                }
            });
        }
    });

    jQuery('#btn-upload').on('click', function(){
        var image = wp.media({
            title: "upload images for my book",
            multiple: false
        }).open().on('select', function(){
            var image_uploaded = image.state().get('selection').first();
            var getImage = image_uploaded.toJSON().url;
            jQuery('#show-image').html("<img src='"+getImage+"' style='height:50px,width:50px;'");
            jQuery('#image-name').val(getImage);
        });
    });

    jQuery('#my-book').DataTable();

    jQuery(document).on('click', '.btnbookdelete', function(){
        var conf = confirm("etes vous sur de supprimer");
        if(conf){
            var book_id = jQuery(this).attr("data-id");
            var post_data = "action=mybooklibrary&param=delete_book&id=" +book_id
            jQuery.post(mybookajaxurl, post_data, function(response){
            var data = jQuery.parseJSON(response);
            if(data.status ==1){
                jQuery.notifyBar({
                    cssClass:"success",
                    html: data.message
                });
                setTimeout(function(){
                    //windox.location.reload();
                    location.reload();
                }, 1300);
            }else{

            }
        });
        }
        
    });

    jQuery('#frmAddBook').validate({
        submitHandler:function(){
            var post_data = "action=mybooklibrary&param=save_book&" + jQuery('#frmAddBook').serialize();
            jQuery.post(mybookajaxurl, post_data, function(response){
                var data = jQuery.parseJSON(response);
                if(data.status ==1){
                    jQuery.notifyBar({
                        cssClass:"success",
                        html: data.message
                    });
                }else{

                }
            });
        }
    });

    jQuery('#frmEditBook').validate({
        submitHandler:function(){
            var post_data = "action=mybooklibrary&param=edit_book&" + jQuery('#frmEditBook').serialize();
            jQuery.post(mybookajaxurl, post_data, function(response){
                var data = jQuery.parseJSON(response);
                if(data.status ==1){
                    jQuery.notifyBar({
                        cssClass:"success",
                        html: data.message
                    });
                    setTimeout(function(){
                        //windox.location.reload();
                        location.reload();
                    }, 1300);
                }else{

                }
            });
        }
    });
});
