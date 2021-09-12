<?php
/*
Template Name: Glacever Carte Template
*/
?>
<?php
//chaque page créé , on a possibilité de l'affilier a ce template qui pourrait
//etre des cartes toutes pretes par exemple, il est dispo dans template dans pages 
//grace au commentaire ligne 1 a 3
//on peut creer autant dd template qu on veut dans ce dossier template
?>


<?php get_header(); ?>

<div>

    <?php
    if(have_posts()){
        while(have_posts()){
            the_post();
            ?>
            <div>
                <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                <p>
                <?php the_content(); ?>
            
                </p>
            </div>
            <?php
        }
    }
    ?>

</div>

<?php get_footer(); ?>