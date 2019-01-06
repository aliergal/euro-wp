<?php get_header(); ?>
<body class="homepage">
    <?php get_template_part( 'template-parts/navbar' ); ?>

    <!--Banner-->
    <header class="masthead text-center text-white">
      <div class="masthead-content">
        <div class="container">
          <h1 class="masthead-heading mb-0">Euro Food LTD</h1>
          <h2 class="masthead-subheading mb-0">Eastern European Food & Drink Specialist</h2>
          <!--<a href="#" class="btn btn-primary btn-xl rounded-pill mt-5">Learn More</a>-->
        </div>
      </div>
    </header>


    <section class="usp text-center">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <img src="<?php echo get_template_directory_uri(); ?>/img/usp1.png">
            <p><b>premium</b> quality</p>
          </div>
          <div class="col-sm-4">
            <img src="<?php echo get_template_directory_uri(); ?>/img/usp2.png">
            <p><b>free</b> delivery</p>
          </div>
          <div class="col-sm-4">
            <img src="<?php echo get_template_directory_uri(); ?>/img/usp3.png">
            <p><b>excellent</b> support</p>
          </div>
        </div>
      </div>
    </section>

    

    <!--Products-->
    <?php get_template_part( 'template-parts/content-featured' ); ?>

    
    <!--Intro-->
    <?php get_template_part( 'template-parts/content-about' ); ?>



    <!--Brands-->
    <?php get_template_part( 'template-parts/content-partners' ); ?>



    <!--Contact Form-->
    <?php get_template_part( 'template-parts/form-contact' ); ?>

<?php get_footer(); ?>