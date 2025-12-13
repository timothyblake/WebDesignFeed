<?php
/**
 * Template part for displaying post content
 *
 * @package Web_Design_Feed
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php if ( is_singular() ) : ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    <?php else : ?>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php endif; ?>
  </header>

  <div class="entry-content">
    <?php
      the_content( sprintf(
        wp_kses( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'web-design-feed' ), array( 'span' => array( 'class' => array() ) ) ),
        get_the_title()
      ) );
      wp_link_pages();
    ?>
  </div>
</article>
