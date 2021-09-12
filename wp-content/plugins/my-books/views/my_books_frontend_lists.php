<?php
global $wpdb;
global $user_ID;
$getallbooks = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM " .my_book_table(). " ORDER BY id desc ", ""
    )
);
?>
<?php
if (count($getallbooks) > 0){
    foreach ($getallbooks as $key=>$value){
    ?>
    <div class="col-4 owt-layout">
    <p><img src="<?php echo $value->book_image; ?>" style="height:100px;width:100px;"></p>
    <p><?php echo $value->name; ?></p>
    <p><?php get_author_details($value->author)['name']; ?></p>
    <p>
    <?php
    //soit on a un utilisateur et on fait le lien ajax, sinon on nous renvoi a l'url admin de connexion

    if ($user_ID >0){
        //login state
    ?>
        <a class="btn btn-success owt-enrol-btn" href="javascript:void(0)">enroll now</a>
    <?php

    }else{
        //logout state
    ?>
    </p>
    <a class="btn btn-success" href="<?php echo wp_login_url(); ?>">login to enroll</a>
    <?php
    }
    ?>
    </p>
    </div>
    <?php
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col mt-5">
            <p class="bg-primary">voici un apercu des livres</p>
        </div>
    </div>
</div>





