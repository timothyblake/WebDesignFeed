<?php
/**
 * Posts loop template part
 *
 * @package Web_Design_Feed
 */
?>

<ul class="list-unstyled article-list">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <li>
      <article id="post-<?php the_ID(); ?>" <?php post_class( 'article-post border bg-white' ); ?>>
        <div class="p-3 row gx-md-1 align-items-center">
          <?php
            // Determine a source link from post content (anchor with configured class) or fall back to the post permalink.
            // Call helper without specifying a class so it uses the Customizer/default (e.g. 'btn-primary').
            $source = function_exists( 'web_design_feed_get_link_by_class' ) ? web_design_feed_get_link_by_class( get_the_ID() ) : false;
            if ( $source ) {
              $is_external = ( parse_url( $source, PHP_URL_HOST ) !== parse_url( home_url(), PHP_URL_HOST ) );
              $target = $is_external ? '_blank' : '_self';
              $rel    = $is_external ? 'noopener noreferrer' : '';
              $href   = esc_url( $source );
            } else {
              $href   = esc_url( get_the_permalink() );
              $target = '_self';
              $rel    = '';
            }
          ?>

          <figure class="col-4 col-md-2 mb-0 pb-0">
            <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php echo $href; ?>" class="post-title" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Read more: %s', get_the_title() ) ); ?>"><?php the_post_thumbnail( 'featured_small', array( 'class' => 'w-100 rounded', 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?></a>
            <?php else : ?>
              <a href="<?php echo $href; ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Read more: %s', get_the_title() ) ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/post-item.jpg' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-100 rounded" />
              </a>
            <?php endif; ?>
          </figure>

          <figcaption class="col mx-md-4">
            <h2><a href="<?php echo $href; ?>" class="post-title" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Read more: %s', get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>
            <p class="pb-0 mb-0 post-excerpt"><?php echo wp_kses_post( wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 45, '...' ) ); ?></p>
          </figcaption>
        </div>

        <div class="article-post--details">
          <div class="row align-items-center">
            <div class="col-md-8">
              <ul class="list-unstyled d-flex justify-content-around">
                <?php
                // Display the Second-Level Domain (SLD) of the source link (found by the button class).
                // Fallback: show the post author if no source link or host is available.
                $sld_display = '';
                if ( ! empty( $source ) ) {
                  $host = parse_url( $source, PHP_URL_HOST );
                  if ( $host ) {
                    // remove common www prefix
                    $host = preg_replace( '/^www\./i', '', $host );
                    $parts = explode( '.', $host );
                    $count = count( $parts );
                    if ( $count >= 2 ) {
                      // simple SLD extraction: last but one segment (e.g. example.com -> example)
                      $sld = $parts[ $count - 2 ];
                    } else {
                      $sld = $host;
                    }
                    $sld_display = $sld;
                  }
                }
                if ( empty( $sld_display ) ) {
                  $sld_display = get_the_author();
                }
                ?>
                <li class="fw-bold text-capitalize"><?php echo esc_html( $sld_display ); ?></li>
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

            <div class="col d-flex justify-content-end">
              <a href="<?php echo $href; ?>" class="btn-primary learn-more" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Learn more about %s', get_the_title() ) ); ?>"><?php esc_html_e( 'Learn more', 'web-design-feed' ); ?></a>
            </div>
          </div>
        </div>

      </article>
    </li>
  <?php endwhile; ?>

  <?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>

  <?php else : ?>
    <li>
      <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'web-design-feed' ); ?></p>
    </li>
  <?php endif; ?>
</ul>
