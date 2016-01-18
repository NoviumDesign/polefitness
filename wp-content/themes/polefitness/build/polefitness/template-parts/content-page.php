<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package polefitness
 */

?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
  <?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
    $thumb_url = $thumb_url_array[0];
  ?>
<?php endif; ?>

<header class="entry-header" 
  <?php if (has_post_thumbnail( $post->ID ) ): ?>
    style="background-image:url('<?php echo $thumb_url ?>')"
  <?php endif; ?>
>
  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
</header><!-- .entry-header -->

<div id="primary" class="content-area subpage-content">
  <main id="main" class="site-main" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="entry-content">
        <?php the_content(); ?>
        <?php
          wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'polefitness' ),
            'after'  => '</div>',
          ) );
        ?>
      </div><!-- .entry-content -->



      <footer class="entry-footer">
        <?php
          edit_post_link(
            sprintf(
              /* translators: %s: Name of current post */
              esc_html__( 'Edit %s', 'polefitness' ),
              the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ),
            '<span class="edit-link">',
            '</span>'
          );
        ?>
      </footer><!-- .entry-footer -->
    </article>
  </main>
</div>