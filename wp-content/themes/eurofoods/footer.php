<!-- Footer -->
    <footer class="py-5 bg-black text-center">
      <div class="container">
        <p class="m-0 text-center text-white small">All Rights Reserved © Euro Foods & Drinks LTD <?php echo date('Y'); ?></p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo get_template_directory_uri(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      var adminurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>"
    </script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/main.min.js"></script>
  </body>

</html>