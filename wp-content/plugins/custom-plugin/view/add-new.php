
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<?php
//ajouter des images venant de la library wordpress, ca permet de pouvoir utiliser methode js 
wp_enqueue_media();

//obtenir data de bdd envoyé par formulaire de add-new pour voir le wp_editor()
global $wpdb;
$data = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM wp_custom_plugin ORDER BY id DESC LIMIT 1")
);

?>


</head>
<body>

<?php
/*------------------------------------insertion donnees dans bdd ---------------------------------------------*/
/*
    global $wpdb;
    //1ere methode inserer donnees avec insert(nom table, tableau donnee avec champ table et valeur)
    $wpdb->insert(
        "wp-custom-plugin",
        array(
            "name"=>"online web tutor",
            "email"=>"online@gmail.com",
            "phone"=>"0987657890"
        )
    );
    //2eme methode insertion donnees, le %s pour entrer des string et %d pour des int
    $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO wp_custom_plugin (name, email, phone) VALUES ('%s', '%s', '%s')", "kevin", "kevin@gmail.com", '0954653421'
        )
    );

/*----------------------------------update donnee bdd -----------------------------------------------------*/
/*
    //1ere methode update donnees (table, donnee remplacée, ou ca)
   $wpdb->update(
       "wp_custom_plugin",
       array(
           "email"=> "kek@gmail.com"
       ),
       array(
           "id"=>3
       )
       );
    //2eme methode update donnees
    $wpdb->query(
        $wpdb->prepare(
            "UPDATE wp_custom_plugin SET email = '%s' WHERE id = %d", 'kevin@gmail.com', 4
        )
    );
/*-----------------------------delete donnees bdd -------------------------------------------------------*/
/*
    //1ere methode delete donnees (table, ou ca)
   $wpdb->delete(
    "wp_custom_plugin",
    array(
        "id"=>5
    )
    );
 //2eme methode delete donnees
 $wpdb->query(
     $wpdb->prepare(
         "DELETE FROM wp_custom_plugin WHERE id = %d",4
     )
 );

/*----------------------------recuperer des donnees de bdd ------------------------------------------------*/
/*
   //on recupere des donnees de la table wp_posts
    $db_results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM wp_posts ORDER BY id LIMIT 5", ''
        )
    );
    //on les affiche de facon vertical et clair grace a <pre>
    echo "<pre>";print_r($db_results);echo "</pre>";
*/
?>

<div class="container">
  <h2>Formulaire</h2>
  <form action="#" id="frmpost">
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="txtname" value="<?php echo $data->name ?>" placeholder="Enter Name" name="txtname">
    </div>
    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="email" class="form-control" id="txtEmail" value="<?php echo $data->email ?>" placeholder="Enter email" name="txtEmail">
    </div>
    <div class="form-group">
      <label for="pwd">ajout description:</label>
    <?php
    //ajouter un editeur comme celui wordpress dans son plugin,
    //1er argument, les donnees
    //2eme, le nom de l'editor
    // possible de personnaliser avec 3eme arguments pour customiser
    wp_editor(html_entity_decode($data->description), "description_id"); ?>
    </div>
    <div class="form-group">
      <label for="pwd">Upload image:</label>
      <input type="file" class="form-control" id="btnimage" name="btnimage" value="upload image">
      <img src="" id="getimage" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<p>
    <img src="<?= PLUGIN_URL.'/custom-plugin/assets/images/NikeRouge.jpg' ?>" style="height:200px;width:200px;"/>
</p>
<p>
    <button class="btn-clik">click ici</button>
</p>

</body>
</html>
