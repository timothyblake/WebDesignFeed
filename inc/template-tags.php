<?php
/**
 * Custom template tags for this theme.
 *
 * @package Web_Design_Feed
 */

if ( ! function_exists( 'web_design_feed_posted_on' ) ) :
  function web_design_feed_posted_on() {
    printf( '<span class="posted-on">%s</span>', esc_html( get_the_date() ) );
  }
endif;
