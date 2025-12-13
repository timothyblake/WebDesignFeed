<?php
/**
 * The template for displaying Category archives
 *
 * @package Web_Design_Feed
 */

get_header(); ?>

<?php get_template_part( 'template-parts/sidebar-menu' ); ?>

<main class="container my-3 my-md-4 main-content">
  <div class="row gx-5">
    <section class="col content-section">
      <header class="archive-header mb-4">
        <h1 class="archive-title"><?php single_cat_title(); ?></h1>
        <?php if ( category_description() ) : ?>
          <div class="archive-description mb-3"><?php echo wp_kses_post( category_description() ); ?></div>
        <?php endif; ?>
      </header>

      <?php get_template_part( 'template-parts/loop' ); ?>

    </section>

    <aside class="col-md-4 sidebar-section">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</main>

<?php get_footer(); ?>
