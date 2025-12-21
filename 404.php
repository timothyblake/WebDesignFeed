<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Web_Design_Feed
 */

get_header(); ?>

<main class="site container py-5 " role="main">
  <div class="row">
    <section class="col-md-8  col-12 error-404 not-found py-5">
        <header class="page-header">
          <h1 class="page-title"><?php esc_html_e( 'Oops! That page can\'t be found.', 'web-design-feed' ); ?></h1>
        </header>
        <div class="page-content">
          <p class="my-4"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'web-design-feed' ); ?></p>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary learn-more mt-4" target="_self" rel="">Back to Home</a>
          <!-- ?php get_search_form(); ?> -->
        </div>
      </section>


      <aside class="col-lg-4 col-12 sidebar-section">
        <!-- Sidebar -->
        <?php get_sidebar(); ?>
      </aside>
  </div>
 

</main>

<?php get_footer(); ?>
