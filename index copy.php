<?php
/**
 * Main template file
 *
 * @package Web_Design_Feed
 */

get_header(); ?>

<main class="site" role="main">
  <header class="site-header">
    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
      <nav class="site-nav" role="navigation">
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
      </nav>
    <?php endif; ?>
  </header>

  <div class="layout">
    <div class="content-area">
      <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
              <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>
            <div class="entry-content">
              <?php the_excerpt(); ?>
            </div>
          </article>
        <?php endwhile;

        the_posts_pagination();

      else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'web-design-feed' ); ?></p>
      <?php endif; ?>
    </div>

    <aside class="sidebar" role="complementary">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</main>

<?php get_footer(); ?>
