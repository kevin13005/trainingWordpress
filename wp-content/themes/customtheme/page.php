
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
                <?php echo get_the_content(); ?>
            
                </p>
            </div>
            <?php
        }
    }
    ?>

</div>

<?php get_footer(); ?>