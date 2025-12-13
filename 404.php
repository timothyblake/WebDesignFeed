<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Web_Design_Feed
 */

get_header(); ?>

<main class="site container" role="main">
  <section class="error-404 not-found py-5">
    <header class="page-header">
      <h1 class="page-title"><?php esc_html_e( 'Oops! That page can\'t be found.', 'web-design-feed' ); ?></h1>
    </header>
    <div class="page-content">
      <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'web-design-feed' ); ?></p>
      <?php get_search_form(); ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
