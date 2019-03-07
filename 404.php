<?php get_header(); ?>
<div class="container error">
  <hr>
  <aside>
    <div class="text-right">
      <h2>Looks like you got lost</h2>
      <p>Sorry, the page you are looking for has moved</p>
      <a class="btn btn-default" href="<?php echo get_bloginfo( 'wpurl' );?>/explore">Search</a>&nbsp;
      <?php $posts = get_posts('orderby=rand&numberposts=1'); foreach($posts as $post) { ?><a class="btn btn-default" href="<?php the_permalink(); ?>">Random Mixtape</a><?php } ?>
    </div>
  </aside>
  <img src="<?php echo esc_url( get_template_directory_uri() );?>/img/404.gif" class="img-responsive error--gif">
</div>
<?php get_footer(); ?>
