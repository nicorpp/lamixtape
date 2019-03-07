<?php get_header(); ?>
<section class="category">
  <div class="header">
    <div class="container">
      <hr>
      <p>Genre: <?php single_cat_title(); ?> <a href="<?php echo get_bloginfo( 'wpurl' );?>/explore"><i class="fas fa-times pull-right font-smoothing" aria-hidden="true"></i></a></p>
    </div>
  </div>
  <aside class="mixtape--list">
  <?php
    $cat_id  = get_query_var('cat');
    $args = array('cat' => $cat_id, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'publish');
    query_posts($args);
    if (have_posts()) : while (have_posts()) : the_post();
  ?>
    <a href="<?php the_permalink(); ?>">
      <header style="background-color:<?php the_field('color'); ?>">
        <div class="container">
          <h2 class="text-capitalize"><?php the_title(); ?></h2>
          <span class="font-smoothing">
            <?php
              $categories = get_the_category();
              $separator = '&nbsp;&nbsp;&nbsp;';
              $output = '';
              if ( ! empty( $categories ) ) {
                  foreach( $categories as $category ) {
                      $output .=  esc_html( $category->name ) . $separator;
                  }
                  echo trim( $output, $separator );
              }
            ?>
          </span>
        </div>
      </header>
    </a>
  <?php endwhile; else: ?>
  <?php _e( '<div class="container nothing--found"><h2 class="font-smoothing">No playlist found 🐒<br><small>Tell us if you would like to hear a genre or artist in particular <br>→ <style type="text/css">a.mailto span.displaynone{display:none;}</style><a href="mailto:hello@lamixtape.fr" class="mailto">hello@<span class="displaynone">null</span>lamixtape.fr</a></small></h2></div>'); ?>
  <?php endif; ?>
  </aside>
</section>
<?php get_footer(); ?>
