<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
      <div class="container">
        <a class="navbar-brand" href="<?php _e(site_url()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" width="200" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php _e(site_url()); ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php _e(get_permalink(9)); ?>">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php _e(get_permalink(18)); ?>">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php _e(get_permalink(20)); ?>">Our Partners</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php _e(get_permalink(16)); ?>">My Account</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>