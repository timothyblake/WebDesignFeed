<?php
/**
 * Featured post loop for a specific category
 *
 * Usage: get_template_part( 'template-parts/featured-loop', null, array( 'category' => 'news', 'posts_per_page' => 1 ) );
 *
 * @package Web_Design_Feed
 */

// Acceptable args when called via get_template_part( ..., $args )
$category       = isset( $args['category'] ) ? $args['category'] : 'news';
$posts_per_page = isset( $args['posts_per_page'] ) ? (int) $args['posts_per_page'] : 5;

// Create a unique transient key for caching
$cache_key = 'wdf_featured_' . sanitize_key( $category ) . '_' . $posts_per_page;
$featured_query = get_transient( $cache_key );

// If no cached query, run the query and cache it
if ( false === $featured_query ) {
  // Build the query args. Allow either category slug/name or numeric ID.
  $query_args = array(
    'posts_per_page'      => $posts_per_page,
    'ignore_sticky_posts' => true,
  );

  if ( is_numeric( $category ) ) {
    $query_args['cat'] = (int) $category;
  } else {
    $query_args['category_name'] = sanitize_text_field( $category );
  }

  $featured_query = new WP_Query( $query_args );

  // Cache the query for 1 hour (3600 seconds)
  set_transient( $cache_key, $featured_query, HOUR_IN_SECONDS );
}

if ( $featured_query->have_posts() ) : ?>
  
      <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
        <li class="d-flex align-items-center py-3">    
          <a href="<?php the_permalink(); ?>" class="row no-gutters align-items-center text-decoration-none featured-post" aria-label="Read featured post: <?php the_title_attribute(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="col-3 col-md-4 col-lg-3">
              <?php the_post_thumbnail( 'featured_xs', array( 'class' => 'rounded-circle w-100', 'alt' => the_title_attribute( array( 'echo' => false ) ), 'width' => 60, 'height' => 60, 'style' => 'object-fit:cover;width:60px;height:60px;', 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
              </div>
            <?php endif; ?>
            <div class="col col-md col-lg">
              <h3 class=" pb-0 mb-0 text-decoration-none"><span><?php the_title(); ?></span></h3>
            </div>
          </a>
        </li>
      <?php endwhile; ?>

<?php
endif;
wp_reset_postdata();
