<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Web_Design_Feed
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
  <?php dynamic_sidebar( 'sidebar-2' ); ?>
<?php else : ?>


  <div class="widget widget-posts  rounded" style="background:#79bcd8; ">
        <h2 class="text-center py-2 text-white" style="background:#416777;"> One stop shop for <br> everything web</h2>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/webdesign-design-feed.jpg' ); ?>" class="w-100 rounded" alt="Web Design News" />
  </div>


  <div class="widget bg-white p-4 rounded mt-4 widget-posts">
        <h2 class="text-center "> From our blog </h2>

    <ul class="list-unstyled widget-posts--list">
      
      <?php
  // Show a featured post (from the 'news' category) in the sidebar as a spotlight.
  get_template_part( 'template-parts/featured-loop', null, array( 'category' => 'Blog', 'posts_per_page' => 5 ) );
  ?>

    </ul>

    <div class="d-flex justify-content-center mt-3">
      <a href="/blog" class="btn-primary learn-more mx-auto" target="_self" rel="" aria-label="Learn more about Light paintings free texture set">View all</a>
    </div>
  </div>  


  <div class="widget bg-white p-4 rounded mt-4 widget-posts widget-contact">

  <h2 class="text-center "> Join our newsletter </h2>

  <?php echo do_shortcode( '[wdf_sidebar_signup]' ); ?>

<div class="text-center">
      <small class="text-center">By subscribing, you agree to our Terms of Service. We respect your privacy and will never share your details.</small>
    </div>

    <!--form end -->

</div>


<?php endif; ?>
