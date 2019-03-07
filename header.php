<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php echo get_bloginfo( 'name' ); ?> › <?php the_title(); ?></title>
    <meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>">

    <meta property="og:title" content="<?php echo get_bloginfo( 'name' ); ?>">
    <meta property="og:description" content="<?php echo get_bloginfo( 'description' ); ?>">
    <meta property="og:image" content="<?php the_post_thumbnail_url(); ?>">
    <meta property="og:url" content="<?php the_permalink(); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>">
    <meta name="twitter:image:alt" content="<?php echo get_bloginfo( 'description' ); ?>">
    <meta property="fb:app_id" content="169884383585844">
    <meta name="twitter:site" content="@lamixtape">

    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#333333">
    <meta name="msapplication-TileColor" content="#333333">
    <meta name="theme-color" content="#ffffff">

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
