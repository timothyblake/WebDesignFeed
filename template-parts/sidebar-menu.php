<?php
/**
 * Template part: Sidebar menu
 * Shows a sidebar navigation menu (uses 'sidebar' theme location) with a categories fallback.
 *
 * @package Web_Design_Feed
 */
?>

   <!-- The Sidebar -->
    <aside id="siteSidebar" class="sidebar border-right">
        <button id="sidebarClose" class="sidebar-close" aria-label="Close sidebar">✕</button>
    
       <?php
                        // Render the Primary Menu if assigned, otherwise fall back to categories list
                        wp_nav_menu( array(
                          'theme_location' => 'primary-menu',
                          'container'      => false,
                          'menu_class'     => 'list-unstyled ',
                          'fallback_cb'    => 'web_design_feed_primary_menu_fallback',
                        ) );
                        ?>
    </aside>

    <!-- Backdrop for slideout sidebar -->
    <div id="sidebarBackdrop" class="sidebar-backdrop" aria-hidden="true"></div>