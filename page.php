<?php
/**
 * Template for pages
 *
 * @package Web_Design_Feed
 */

get_header(); ?>

  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
    



        <main class="container my-2 my-md-4 main-content">
          
        <div class="row gx-5">
            <section class="col content-section">
                                  <h1 class="entry-title mb-3"><?php the_title(); ?></h1>
  
            <div class="bg-white p-4 border rounded">
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <?php the_content(); ?>
                  </article>
              </div>
             
                <!-- Posts loop -->
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

<?php get_footer(); ?>
