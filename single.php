<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <title><?php echo get_bloginfo( 'name' ); ?> › <?php the_title(); ?></title>
    <meta name="description" content="10 tracks of <?php
            $categories = get_the_category();
            $separator = ', ';
            $output = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $output .= esc_html( $category->name ) . $separator;
                }
                echo trim( $output, $separator );
            }
          ?>, curated for Lamixtape with <?php the_field('artist_1'); ?>, <?php the_field('artist_2'); ?>, <?php the_field('artist_3'); ?>...">

    <meta property="og:title" content="<?php the_title(); ?>">
    <meta property="og:description" content="10 tracks of <?php
            $categories = get_the_category();
            $separator = ', ';
            $output = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $output .= esc_html( $category->name ) . $separator;
                }
                echo trim( $output, $separator );
            }
          ?>, curated for Lamixtape with <?php the_field('artist_1'); ?>, <?php the_field('artist_2'); ?>, <?php the_field('artist_3'); ?>...">
    <meta property="og:image" content="<?php the_post_thumbnail_url(); ?>">
    <meta property="og:url" content="<?php the_permalink(); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>">
    <meta name="twitter:image:alt" content="10 tracks of <?php
            $categories = get_the_category();
            $separator = ', ';
            $output = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $output .= esc_html( $category->name ) . $separator;
                }
                echo trim( $output, $separator );
            }
          ?>, curated for Lamixtape with <?php the_field('artist_1'); ?>, <?php the_field('artist_2'); ?>, <?php the_field('artist_3'); ?>...">
    <meta property="fb:app_id" content="169884383585844">
    <meta name="twitter:site" content="@lamixtape">

    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.min.css">

    <?php wp_head();?>
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- Pour les employés d'Orange qui subissent la dette technique -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body <?php body_class(); ?>>
    <div id="preloader"></div>
    <nav class="container font-smoothing">
      <div class="row">
        <div class="col-sm-6 col-xs-5">
          <h1><a class="no--hover" href="<?php echo get_bloginfo( 'wpurl' );?>">Lamixtape</a></h1>
        </div>
        <div class="col-sm-6 col-xs-7">
          <ul class="text-uppercase list-inline text-right">
            <li><a href="<?php echo get_bloginfo( 'wpurl' );?>/explore">Explore</a></li>
            <li><a href="<?php echo get_bloginfo( 'wpurl' );?>/about">About</a></li>
          </ul>
        </div>
      </div>
    </nav>
<?php
  if ( have_posts() ) : while ( have_posts() ) : the_post();
      get_template_part( 'content-single', get_post_format() );
  endwhile; endif;
?>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/player/mediaelement-and-player.min.js" ></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/player/renderers/soundcloud.min.js" ></script>
<?php get_footer(); ?>
