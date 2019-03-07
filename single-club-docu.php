<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php the_title(); ?> - Lamixtape Club Docu</title>

    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.min.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '474041402976651');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="//www.facebook.com/tr?id=474041402976651&ev=PageView&noscript=1"/></noscript>

    <!-- Pour les employés d'Orange qui subissent la dette technique -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head();?>
  </head>
  <body <?php body_class(); ?>>
    <div id="preloader"></div>
    <nav class="navbar navbar-default">
      <div class="container hamburger">
        <div class="navbar-header">
          <a target="#" class="hamburger--menu pull-right navbar-toggle" data-toggle="collapse" data-target="#menu" aria-expanded="false">
            MENU
          </a>
          <h1><a href="<?php echo get_bloginfo( 'wpurl' );?>">Lamixtape</a></h1>
        </div>
        <div class="collapse navbar-collapse" id="menu">
          <ul class="nav navbar-nav navbar-right text-uppercase">
            <li><a href="<?php echo get_bloginfo( 'wpurl' );?>">Mixtapes</a></li>
            <li><a href="<?php echo get_bloginfo( 'wpurl' );?>/explore">Explore</a></li>
            <li><a href="<?php echo get_bloginfo( 'wpurl' );?>/club-docu">Clubdocu</a><span class="new hidden-xs"></span></li>
            <li><a href="<?php echo get_bloginfo( 'wpurl' );?>/about">About</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <article class="club-docu">
    <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
          get_template_part( 'club-docu-content-single', get_post_format() );
      endwhile; endif;
    ?>
    </article>
<?php get_footer(); ?>