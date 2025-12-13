<footer class="py-4 border-top">
      <div class="container text-center">

        <div class="row justify-content-between">
          <!-- <div class="col"> 
          <ul class="list-unstyled mb-0 pb-2 d-flex justify-content-between ">
              <li><a href="/about-us" class="mr-2">About Us</a></li>
              <li><a href="#">Contact Us</a></li>
          </ul>
          </div> -->

          <div class="col-12 col-md">
        <ul class="list-unstyled mb-0 pb-2 d-flex justify-content-center justify-content-md-start">

         <li class="px-2">
          <p class="fw-bold">Follow us:</p>
          </li>
          
          <li class="px-2">
            <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook">
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/facebook-50.svg' ); ?>" alt="Facebook" width="24" height="24" class="social-icon" />
            </a>
          </li>

          <li class="px-2">
            <a href="https://twitter.com" target="_blank" rel="noopener" aria-label="Twitter">
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/x-50.svg' ); ?>" alt="Twitter" width="24" height="24" class="social-icon" />
            </a>
          </li>
          <li class="px-2">
            <a href="https://pinterest.com" target="_blank" rel="noopener" aria-label="Pinterest">
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/pinterest-50.svg' ); ?>" alt="Pinterest" width="24" height="24" class="social-icon" />
            </a>
          </li>   
         </ul>
      </div>

          <div class="col-12 col-md text-md-end">
            <small>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</small>
          </div>
        </div>

      </div>
    </footer>

  <?php wp_footer(); ?>
</body>
</html>
