<?php
/*
Template Name: book 
*/ 
get_header();
?>
<div class="container">
    <div class="row">
        
        <div class="alert alert-success" style="background-color:grey"><h1>hello online web tutor</h1></div>
        <?php
       //cette fonction execute le a fonction de add_shortcode()
        echo do_shortcode("[book_page]");
        ?>
        
    </div>
</div>





<?php
get_footer();
?>

