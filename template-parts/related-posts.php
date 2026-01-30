<?php
/**
 * Template part: Related posts
 * Expects global $post to be set. Uses web_design_feed_get_related_posts() to fetch related posts.
 */
if ( ! isset( $post ) ) {
  return;
}

$related = web_design_feed_get_related_posts( $post->ID, array( 'posts_per_page' => 4 ) );
if ( $related && $related->have_posts() ) : ?>

    <h3 class="widget-title mt-4 related-posts-title">Related posts</h3>


  <div class="mb-3">
    <ul class="list-unstyled mb-0 row gx-4 gy-3 ">
      <?php while ( $related->have_posts() ) : $related->the_post(); ?>
        <li class="col-md-6 col-12 ">
            <div class="widget related-posts mt-3 bg-white p-3 rounded nt-4 d-flex align-items-center py-2  h-100">
  
          <a href="<?php the_permalink(); ?>" class="d-flex align-items-center " aria-label="Read related post: <?php the_title_attribute(); ?>">
            <div class="me-3 related-posts-thumbnail">
              <?php if ( has_post_thumbnail() ) :
                the_post_thumbnail( 'featured_xs', array( 'class' => 'rounded-circle w-100', 'alt' => the_title_attribute( array( 'echo' => false ) ), 'loading' => 'lazy', 'decoding' => 'async' ) );
              else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/featured-150x150.svg' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="rounded-circle" width="60" height="60" loading="lazy" decoding="async" />
              <?php endif; ?>
            </div>
            <div class="flex-fill">
              <h3 class="mb-0 small "><a href="<?php the_permalink(); ?>" class="text-decoration-none" aria-label="Read related post: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
            </div>
          </a>
          </div>
        </li>
      <?php endwhile; wp_reset_postdata(); ?>
    </ul>
  </div>
<?php endif; ?>
