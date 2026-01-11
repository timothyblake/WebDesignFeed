<?php
/**
 * Web Design Feed functions and definitions
 *
 * @package Web_Design_Feed
 */

if ( ! function_exists( 'web_design_feed_setup' ) ) :
  function web_design_feed_setup() {
    load_theme_textdomain( 'web-design-feed', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
      'primary' => esc_html__( 'Primary', 'web-design-feed' ),
      'primary-menu' => esc_html__( 'Primary Menu', 'web-design-feed' ),
      'sidebar' => esc_html__( 'Sidebar', 'web-design-feed' ),
    ) );

    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    add_theme_support( 'custom-logo' );

    // Register multiple custom image sizes used by the theme
    // Helper: register an array of sizes in one place
    $web_design_feed_image_sizes = array(
      'featured_xs'     => array( 100,  100,  true ),   // small thumbnail
      'featured_small'  => array( 145, 140,  true ),   // square
      'featured_medium' => array( 300, 200,  true ),   // medium crop
      'featured_large'  => array(1024, 512,  true ),   // large wide
      'featured_hero'   => array(1600, 600,  true ),   // hero / banner
    );

    foreach ( $web_design_feed_image_sizes as $name => $args ) {
      add_image_size( $name, $args[0], $args[1], $args[2] );
    }
  }
endif;
add_action( 'after_setup_theme', 'web_design_feed_setup' );

function web_design_feed_scripts() {
  wp_enqueue_style( 'web-design-feed-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
  wp_enqueue_script( 'web-design-feed-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'web_design_feed_scripts' );

function web_design_feed_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'web-design-feed' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'web-design-feed' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  // Register second sidebar so templates checking sidebar-2 work
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 2', 'web-design-feed' ),
    'id'            => 'sidebar-2',
    'description'   => esc_html__( 'Alternate sidebar used by some templates.', 'web-design-feed' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'web_design_feed_widgets_init' );

// Add block editor support and editor stylesheet
function web_design_feed_block_editor_setup() {
  add_theme_support( 'editor-styles' );
  add_editor_style( 'assets/css/editor-style.css' );
  add_theme_support( 'align-wide' );
  add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'web_design_feed_block_editor_setup' );

// Enqueue styles for the block editor
function web_design_feed_enqueue_block_editor_assets() {
  wp_enqueue_style( 'web-design-feed-editor', get_template_directory_uri() . '/assets/css/editor-style.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'enqueue_block_editor_assets', 'web_design_feed_enqueue_block_editor_assets' );

// Fallback for the primary-menu: render top categories as a simple list
function web_design_feed_primary_menu_fallback( $args ) {
  $cats = get_categories( array( 'orderby' => 'name', 'hide_empty' => true ) );
  if ( ! empty( $cats ) ) {
    echo '<ul class="' . esc_attr( $args['menu_class'] ) . '">';
    foreach ( $cats as $cat ) {
      $link = get_category_link( $cat->term_id );
      printf( '<li><a href="%s" class="nav-desktop">%s</a></li>', esc_url( $link ), esc_html( $cat->name ) );
    }
    echo '</ul>';
  }
}

// Make the custom image sizes available in the media modal size selector
function web_design_feed_custom_image_sizes( $sizes ) {
  return array_merge( $sizes, array(
    'featured_xxs'    => __( 'Featured XXS (70×70)', 'web-design-feed' ),
    'featured_xs'     => __( 'Featured XS (100×100)', 'web-design-feed' ),
    'featured_small'  => __( 'Featured Small (145×140)', 'web-design-feed' ),
    'featured_medium' => __( 'Featured Medium (300×200)', 'web-design-feed' ),
    'featured_large'  => __( 'Featured Large (1024×512)', 'web-design-feed' ),
    'featured_hero'   => __( 'Featured Hero (1600×600)', 'web-design-feed' ),
  ) );
}
add_filter( 'image_size_names_choose', 'web_design_feed_custom_image_sizes' );

// Return a WP_Query of related posts for a given post ID.
function web_design_feed_get_related_posts( $post_id = 0, $args = array() ) {
  $post_id = (int) $post_id;
  if ( ! $post_id ) {
    return null;
  }

  $defaults = array(
    'posts_per_page'      => 4,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
    'orderby'             => 'date',
  );

  $args = wp_parse_args( $args, $defaults );

  // Try to find related by tags first
  $tags = wp_get_post_tags( $post_id, array( 'fields' => 'ids' ) );

  $query_args = array(
    'post__not_in' => array( $post_id ),
    'posts_per_page' => (int) $args['posts_per_page'],
    'post_status' => $args['post_status'],
    'ignore_sticky_posts' => $args['ignore_sticky_posts'],
    'orderby' => $args['orderby'],
  );

  if ( ! empty( $tags ) ) {
    $query_args['tag__in'] = $tags;
  } else {
    // Fallback to categories
    $cats = wp_get_post_categories( $post_id );
    if ( ! empty( $cats ) ) {
      $query_args['category__in'] = $cats;
    }
  }

  $related_query = new WP_Query( $query_args );
  return $related_query;
}

/**
 * Return the first URL from post content whose <a> has the given class.
 * Priority:
 *  - post meta 'source_link' (override)
 *  - first <a> in post content matching one of the provided classes
 *
 * If $class is null, the theme Customizer setting 'wdf_button_class' is used
 * (defaults now to 'btn-primary'). Multiple classes may be supplied as a
 * comma-separated or space-separated string and any matching class will be used.
 *
 * @param int $post_id Post ID. Defaults to current post.
 * @param string|null $class CSS class or classes to match on the anchor.
 * @return string|false Sanitized URL string or false if none found.
 */
function web_design_feed_get_link_by_class( $post_id = 0, $class = null ) {
  if ( ! $post_id ) {
    $post_id = get_the_ID();
  }

  // If class not provided, fall back to theme setting (or 'btn-primary')
  if ( empty( $class ) ) {
    $class = get_theme_mod( 'wdf_button_class', 'btn-primary' );
  }

  // Normalize classes into an array of simple class names
  if ( is_string( $class ) ) {
    $class_list = preg_split( '/[\s,]+/', trim( $class ) );
  } elseif ( is_array( $class ) ) {
    $class_list = $class;
  } else {
    $class_list = array();
  }
  // sanitize entries
  $classes = array();
  foreach ( $class_list as $c ) {
    $c = trim( $c );
    if ( $c !== '' ) {
      $classes[] = $c;
    }
  }
  if ( empty( $classes ) ) {
    return false;
  }

  // 1) allow a post meta override
  $meta = get_post_meta( $post_id, 'source_link', true );
  if ( ! empty( $meta ) ) {
    return esc_url_raw( $meta );
  }

  $content = get_post_field( 'post_content', $post_id );
  if ( empty( $content ) ) {
    return false;
  }

  // DOMDocument approach (robust)
  libxml_use_internal_errors( true );
  $dom = new DOMDocument();
  $ok  = $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
  libxml_clear_errors();

  if ( $ok ) {
    foreach ( $dom->getElementsByTagName( 'a' ) as $a ) {
      $classAttr = $a->getAttribute( 'class' );
      if ( $classAttr ) {
        foreach ( $classes as $check ) {
          if ( preg_match( '/\b' . preg_quote( $check, '/' ) . '\b/i', $classAttr ) ) {
            $href = $a->getAttribute( 'href' );
            if ( $href ) {
              if ( strpos( $href, '/' ) === 0 ) {
                $href = home_url( $href );
              }
              return esc_url_raw( $href );
            }
          }
        }
      }
    }
  }

  // Fallback: regex search for anchor with any of the classes and href
  $escaped = array_map( 'preg_quote', $classes );
  $alt = implode( '|', $escaped );
  $pattern = '/<a[^>]*class=["\']([^"\']*(?:' . $alt . ')[^"\']*)["\'][^>]*href=["\']([^"\']+)["\']/i';
  if ( preg_match( $pattern, $content, $m ) ) {
    $href = $m[2];
    if ( strpos( $href, '/' ) === 0 ) {
      $href = home_url( $href );
    }
    return esc_url_raw( $href );
  }

  return false;
}

// Add a simple meta box to expose the 'source_link' custom field in the post editor
function wdf_add_source_meta_box() {
  add_meta_box(
    'wdf_source_link',
    __( 'Source Link', 'web-design-feed' ),
    'wdf_source_meta_box_cb',
    'post',
    'side',
    'default'
  );
}
add_action( 'add_meta_boxes', 'wdf_add_source_meta_box' );

function wdf_source_meta_box_cb( $post ) {
  wp_nonce_field( 'wdf_source_nonce', 'wdf_source_nonce_field' );
  $value = get_post_meta( $post->ID, 'source_link', true );
  ?>
  <p>
    <label for="wdf_source_link"><?php esc_html_e( 'Override URL (optional)', 'web-design-feed' ); ?></label>
  </p>
  <p>
    <input type="url" id="wdf_source_link" name="wdf_source_link" value="<?php echo esc_attr( $value ); ?>" class="widefat" placeholder="https://example.com" />
  </p>
  <p class="description">
    <?php esc_html_e( 'If set, this URL will be used instead of any anchor found in the post content.', 'web-design-feed' ); ?>
  </p>
  <?php
}

function wdf_save_source_meta_box( $post_id ) {
  if ( ! isset( $_POST['wdf_source_nonce_field'] ) || ! wp_verify_nonce( wp_unslash( $_POST['wdf_source_nonce_field'] ), 'wdf_source_nonce' ) ) {
    return $post_id;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
  }

  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return $post_id;
  }

  if ( isset( $_POST['wdf_source_link'] ) ) {
    $url = trim( wp_unslash( $_POST['wdf_source_link'] ) );
    if ( empty( $url ) ) {
      delete_post_meta( $post_id, 'source_link' );
    } else {
      update_post_meta( $post_id, 'source_link', esc_url_raw( $url ) );
    }
  }
}
add_action( 'save_post', 'wdf_save_source_meta_box' );

// Add a Customizer setting so admins can change the default anchor class used by the theme
function wdf_customize_register( $wp_customize ) {
  $wp_customize->add_section( 'wdf_misc', array(
    'title'    => __( 'Web Design Feed', 'web-design-feed' ),
    'priority' => 160,
  ) );

  $wp_customize->add_setting( 'wdf_button_class', array(
    'default'           => 'button-primary',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  $wp_customize->add_control( 'wdf_button_class_control', array(
    'label'    => __( 'Default button link class', 'web-design-feed' ),
    'section'  => 'wdf_misc',
    'settings' => 'wdf_button_class',
    'type'     => 'text',
  ) );
}
add_action( 'customize_register', 'wdf_customize_register' );

/**
 * Newsletter signup shortcode
 * Usage: [wdf_newsletter]
 */
function web_design_feed_newsletter_shortcode( $atts ) {
  // Enqueue Google reCAPTCHA (v2) script
  wp_enqueue_script( 'web-design-feed-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );

  $action   = 'https://cerebro.creativenerds.co.uk/subscribe';
  $site_key = '6LeIGS8aAAAAADuLThO2kkgeO31JkQgUu7nXKc7f';

  ob_start();
  ?>

  <p>👋 Don’t miss out on the latest news, tips, and insights to help you build better websites. Delivered to your inbox once a week.</p>
  
  <form action="<?php echo esc_url( $action ); ?>" method="POST" accept-charset="utf-8" class="signupform pb-5 mx-0 px-0" novalidate>
    <label for="wdf-email" class="screen-reader-text"><?php esc_html_e( 'Email address', 'web-design-feed' ); ?></label>
    <input type="email" name="email" id="wdf-email" placeholder="<?php echo esc_attr__( 'Please enter your email address', 'web-design-feed' ); ?>" required />

    <div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $site_key ); ?>"></div>

    <div class="wdf-honeypot screen-reader-text">
      <label for="wdf-hp"><?php esc_html_e( 'Leave this field empty', 'web-design-feed' ); ?></label>
      <input type="text" name="hp" id="wdf-hp" autocomplete="off" />
    </div>

    <input type="hidden" name="list" value="LzYXAcvZ8763bqupfs6DjSfw" />
    <input type="hidden" name="subform" value="yes" />

    <button type="submit" name="submit" id="wdf-submit" class="submit-button button primary-cta-btn py-3">
      <?php esc_html_e( 'Subscribe', 'web-design-feed' ); ?>
    </button>
  </form>
  <?php

  return (string) ob_get_clean();
}
add_shortcode( 'wdf_newsletter', 'web_design_feed_newsletter_shortcode' );

/**
 * Sidebar newsletter signup shortcode
 * Usage: [wdf_sidebar_signup]
 */
function web_design_feed_sidebar_signup_shortcode( $atts ) {
  // Ensure reCAPTCHA script is loaded when the shortcode is present
  wp_enqueue_script( 'web-design-feed-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );

  $atts = shortcode_atts( array(
    'action'   => 'https://newsletters.webdesignfeed.com/subscribe',
    'site_key' => '6LdXBEAsAAAAAJ3m5jzXTZwdQbHaYccZEMVDjEUB',
    'list'     => 'N3iAF5VUAxiEmfMgrJsygA',
  ), $atts, 'wdf_sidebar_signup' );

  ob_start();
  ?>
  <form class="signupform wdf-sidebar-signup" action="<?php echo esc_url( $atts['action'] ); ?>" method="POST" accept-charset="utf-8" aria-label="Subscribe to our newsletter">
    <label for="wdf-name" class="fw-bold"><?php esc_html_e( 'Name', 'web-design-feed' ); ?></label>
    <input type="text" name="name" id="wdf-name" placeholder="<?php echo esc_attr__( 'Your name', 'web-design-feed' ); ?>" />

    <label for="wdf-email" class="mt-3 fw-bold"><?php esc_html_e( 'Email', 'web-design-feed' ); ?></label>
    <input type="email" name="email" id="wdf-email" placeholder="you@example.com" required />

    <div class="wdf-hp" style="display:none;">
      <label for="wdf-hp"><?php esc_html_e( 'HP', 'web-design-feed' ); ?></label>
      <input type="text" name="hp" id="wdf-hp" autocomplete="off" />
    </div>

    <div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $atts['site_key'] ); ?>"></div>

    <input type="hidden" name="list" value="<?php echo esc_attr( $atts['list'] ); ?>" />
    <input type="hidden" name="subform" value="yes" />

    <div class="d-flex justify-content-center mt-3">
      <input type="submit" class="btn-primary learn-more mx-auto" name="submit" id="wdf-submit" value="<?php echo esc_attr__( 'Subscribe', 'web-design-feed' ); ?>" />
    </div>
  </form>
  <?php

  return (string) ob_get_clean();
}
add_shortcode( 'wdf_sidebar_signup', 'web_design_feed_sidebar_signup_shortcode' );

/**
 * License details shortcode
 * Usage: [wdf_license]
 */
function web_design_feed_license_shortcode() {
  return '<h2>License Details</h2><p>This resource is licensed under a <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" rel="noopener noreferrer">Creative Commons Attribution 4.0 International License</a>. The resource can be used in commercial and personal projects, but cannot be redistributed without the permission of Web Design Feed.</p>';
}
add_shortcode( 'wdf_license', 'web_design_feed_license_shortcode' );


// Disable the "Big Image" scaling threshold
add_filter( 'big_image_size_threshold', '__return_false' );