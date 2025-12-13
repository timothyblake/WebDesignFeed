<?php
/**
 * Template for comments
 *
 * @package Web_Design_Feed
 */

if ( post_password_required() ) {
  return;
}
?>
<div id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
      <?php printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'web-design-feed' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
    </h2>

    <ol class="comment-list">
      <?php wp_list_comments(); ?>
    </ol>

  <?php endif; ?>

  <?php comment_form(); ?>
</div>
