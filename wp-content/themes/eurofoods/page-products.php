<?php get_header(); ?>
    <body class="page">
        <?php get_template_part( 'template-parts/navbar' ); ?>
        <?php get_template_part( 'template-parts/content-header' ); ?>
        <div class="container">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif;
            ?>
            
        </div>
        <div class="container">
            <section class="products">
                <?php print render_product_list(); ?>
            </section>
        </div>
        <?php get_template_part( 'template-parts/form-contact' ); ?>
<?php get_footer(); ?>