<?php
// get_header();
get_header('search');
global $wp_query;
?>
<section class="explore">
  <form role="search" method="get" id="" class="" action="<?php echo get_bloginfo( 'wpurl' );?>">
  <div class="container">
    <hr>
    <p class="font-smoothing">Search: <?php the_search_query(); ?> <a href="<?php echo get_bloginfo( 'wpurl' );?>/explore"><i class="fas fa-times pull-right font-smoothing"></i></a></p>
  </div>
</form>
<?php $allsearch = new WP_Query("s=$s&showposts=-1"); ?>
<section class="mixtape--list">
<?php if ($allsearch->have_posts()) : ?>
<?php while ($allsearch->have_posts()) : $allsearch->the_post(); ?>
  <article class="post articlepost" data-count="<?php echo $counter; ?>">
    <header style="background-color:<?php the_field('color'); ?>">
      <div class="container">
        <a href="<?php the_permalink(); ?>"><h2 class="font-smoothing"><?php the_title(); ?><span class="hidden-xs hidden-sm pull-right author-<?php the_author_meta('ID') ?>">Curated by <?php the_author(); ?></span></h2></a>
        <span class="hidden-xs font-smoothing"><?php
            $categories = get_the_category();
            $separator = ' ';
            $output = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $output .= '<a class="category hidden-xs" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                }
                echo trim( $output, $separator );
            }
        ?></span>
      </div>
    </header>
  </article>
<?php endwhile; else: ?>
<?php _e( '<div class="container nothing--found"><h2 class="font-smoothing">No playlist found 🐒<br><small>Tell us if you would like to hear a genre or artist in particular <br>→ <style type="text/css">a.mailto span.displaynone{display:none;}</style><a href="mailto:hello@lamixtape.fr" class="mailto">hello@<span class="displaynone">null</span>lamixtape.fr</a></small></h2></div>'); ?>
<?php endif; ?>
</section>
<script>
  fbq('track', 'Search');
</script>
<?php get_footer(); ?>
