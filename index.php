<?php
/**
 * Main template file
 *
 * @package Web_Design_Feed
 */

get_header(); ?>

<?php get_template_part( 'template-parts/sidebar-menu' ); ?>


  <main class="container my-3 my-md-4 main-content">
        <div class="row gx-5">
            <section class="col content-section">
                <h1>Latest news</h1>
                <p class="mb-0 pb-0">Learn the fundamentals of web design with our HTML and CSS tutorials. Build landing pages, apps, websites, and more, with animations and other advanced effects.</p>

                <!-- Posts loop -->
                  <?php get_template_part( 'template-parts/loop' ); ?>

            </section>

            <aside class="col-lg-4 sidebar-section">
              <!-- Sidebar -->
              <?php get_sidebar(); ?>

            </aside>

        </div>


    </main>



<?php get_footer(); ?>
