<?php
   // the query
   $the_query = new WP_Query( array(
      'posts_per_page' => 1,
   ));
?>

<?php if ( $the_query->have_posts() ) : ?>
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <article class="post articlepost highlight" data-count="<?php echo $counter; ?>" >
      <header style="background-color:<?php the_field('color'); ?>">
        <div class="container">
          <a href="<?php the_permalink(); ?>" class="visible-xs"><h2><?php the_title(); ?></h2></a>
          <div class="row hidden-xs">
            <div class="col-lg-7 col-md-7">
              <p class="text-uppercase sub-title font-smoothing">This week Mixtape</p>
              <a href="<?php the_permalink(); ?>"><h2 class="font-smoothing"><?php the_title(); ?></h2></a>
              <span class=""><?php
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
              <p class="font-smoothing excerpt"><?php echo(get_the_excerpt()); ?></p>
              <p class="font-smoothing author-<?php the_author_meta('ID') ?>">A mixtape curated by <?php the_author_link(); ?> for Lamixtape.</p>
              <a href="<?php the_permalink(); ?>" class="text-uppercase btn font-smoothing">&rarr;&nbsp;Listen Now</a>
              <ul class="list-inline font-smoothing stream">
                <?php if( get_field('youtube') ): ?>
                <li>This mixtape is also available on</li>
                <li><a href="<?php the_field('youtube'); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                <?php endif; ?>
                <?php if( get_field('spotify') ): ?>
                <li><a href="<?php the_field('spotify'); ?>" target="_blank"><i class="fab fa-spotify"></i></a></li>
                <?php endif; ?>
                <?php if( get_field('apple') ): ?>
                <li><a href="<?php the_field('apple'); ?>" target="_blank"><i class="fab fa-apple"></i></a></li>
                <?php endif; ?>
              </ul>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-4 hidden-sm hidden-xs col-md-5">
              <a href="<?php the_permalink(); ?>" ><img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive" alt="<?php the_title(); ?>"></a>
            </div>
          </div>
        </div>
      </header>
    </article>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
  <?php else : ?>
    <p><?php __('No News'); ?></p>
  <?php endif; ?>
    <div id="posts">
      <section class="mixtape--list" id="main">
        <?php $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        $args = array( 'post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged );
        $wp_query = new WP_Query($args);
        $counter = 0;
        while ( have_posts() ) : the_post(); ?>
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
          <?php
          if($counter > 9) {
            $counter = 1;
          } else {
            $counter++;
          }
          ?>
<?php endwhile; ?>
    </section>
  </div>
    <div id="pagination">
      <?php next_posts_link( '&larr; Older posts', $wp_query ->max_num_pages); ?>
      <?php previous_posts_link( 'Newer posts &rarr;' ); ?>
    </div>
<!-- <div class="bandeau font-smoothing hidden-sm hidden-xs">
  <div class="container">
    <p>🚩&nbsp;Our next dance will take place in Paris on 14th of September • Full crew 👊🏼 Vinyls only 🔥  &nbsp;&nbsp;<a href="//www.facebook.com/events/239945656720788" target="_blank" class="pull-right">More information</a></p>
  </div>
</div>-->
