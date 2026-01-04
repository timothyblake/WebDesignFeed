<?php
/**
 * Template Name: Blog 
 * Template Post Type: post
 *
 * An alternate single-post template that mirrors the primary `single.php` layout.
 */

get_header(); ?>

<?php get_template_part( 'template-parts/sidebar-menu' ); ?>

<main class="container py-3" role="main">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
    

     <main class="container my-3 my-md-4 main-content">
        <div class="row gx-5">
            <section class="col content-section">
                <h1 class="mb-4"><?php the_title(); ?></h1>


                <!-- Posts loop -->

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'article-post border bg-white' ); ?>>


        <div class="p-3 row gx-md-1 align-items-center">
          <div class="col-12 col-md mx-md-4">
            <div class="pb-0 mb-0 post-content">
              <?php the_content(); ?>

            </div>
          </div>


        </div>

        <div class="article-post--details">
          <div class="row align-items-center">
            <div class="col-md-6">
              <ul class="list-unstyled d-flex justify-content-around mb-0 pb-0">
                <li class="fw-bold"><?php the_author(); ?></li>
                <li>|</li>
                <?php
                $cats = get_the_category();
                if ( ! empty( $cats ) ) :
                  $first_cat = $cats[0];
                  ?>
                  <li class="fw-bold"><a href="<?php echo esc_url( get_category_link( $first_cat->term_id ) ); ?>"><?php echo esc_html( $first_cat->name ); ?></a></li>
                <?php else : ?>
                  <li class="fw-bold"><?php echo esc_html__( 'Uncategorized', 'web-design-feed' ); ?></li>
                <?php endif; ?>
                <li class="mobile-hidden">|</li>
                <li class="fw-bold mobile-hidden"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></li>
              </ul>
            </div>

          </div>
        </div>
        
      </article>

            <?php get_template_part( 'template-parts/related-posts' ); ?>


            </section>

            <aside class="col-lg-4 sidebar-section">
              <!-- Sidebar -->
              <?php get_sidebar(); ?>

            </aside>

        </div>


    </main>

    <?php endwhile;
  endif;
  ?>
</main>

<?php get_footer(); ?>
