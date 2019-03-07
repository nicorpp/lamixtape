<?php /* Template Name: explore */ ?>
<?php get_header(); ?>
<section class="explore">
	<form role="search" method="get" id="" class="" action="<?php echo get_bloginfo( 'wpurl' );?>">
    <div class="container">
      <hr>
      <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="form-control" placeholder="Search...">
    </div>
  </form>
  <aside class="text-center font-smoothing">
  <?php $category_ids = get_terms(); ?>
  <?php
    $args = array(
    'orderby' => 'slug',
    'parent' => 0,
    'hide_empty' => false
    );
    $categories = get_categories( $args );
    foreach ( $categories as $category ) {
    echo '<a href="' . get_category_link( $category->term_id ) . '"><header><h2>' . $category->name . '</h2></header></a>';
    }
  ?>
  </aside>
</section>
<?php get_footer(); ?>
