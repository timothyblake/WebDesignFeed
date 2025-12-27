<?php
/**
 * Template part for site header
 *
 * @package WebDesign_Feed_One_Stop_Shop
 */
?>

  <!-- Newsletter -->
     <section class="newsletter-bg">
            <a href="/newsletter-design-bundle/" class="text-decoration-none" aria-label="Join our newsletter and receive a free design resource bundle"> <span class="fw-bold">Join our newsletter <span class="d-none d-md-inline-block">and receive a free design resource bundle</span> </span>
            </a>
     </section>


    <!-- Header -->
     <header class="header border-bottom">
            <div class="container-fluid">
                <div class="row align-items-center"> 
                    <div class="col">
                        <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                          <?php the_custom_logo(); ?>
                        <?php else : ?>
                          <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( sprintf( __( '%s - Home', 'web-design-feed' ), get_bloginfo( 'name' ) ) ); ?>">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/web-design-feed-logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo"/>
                          </a>
                        <?php endif; ?>
                    </div>

                    <nav class="col">
                        <?php
                        // Render the Primary Menu if assigned, otherwise fall back to categories list
                        wp_nav_menu( array(
                          'theme_location' => 'primary-menu',
                          'container'      => false,
                          'menu_class'     => 'nav-desktop list-unstyled d-flex justify-content-between mb-0 pb-0',
                          'fallback_cb'    => 'web_design_feed_primary_menu_fallback',
                        ) );
                        ?>

                        <div class="d-flex justify-content-end hamburger-menu">
                         <button id="sidebarToggle" class="hamburger  btn btn-outline-secondary me-2" aria-controls="siteSidebar" aria-expanded="false" aria-label="Toggle sidebar">
                           <!-- inline accessible hamburger SVG -->
                           <svg class="hamburger-icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
                             <rect x="3" y="6" width="18" height="2" rx="1" fill="currentColor"/>
                             <rect x="3" y="11" width="18" height="2" rx="1" fill="currentColor"/>
                             <rect x="3" y="16" width="18" height="2" rx="1" fill="currentColor"/>
                           </svg>
                         </button>
                        </div>

                    </nav>

                </div>
            </div>
     </header>
