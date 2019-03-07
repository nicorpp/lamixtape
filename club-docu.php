<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php echo get_bloginfo( 'name' ); ?> › <?php the_title(); ?></title>
    <meta name="description" content="Receive each month in your mailbox, a musical documentary to watch, carefully picked by our editors.">

    <meta property="og:title" content="<?php the_title(); ?>">
    <meta property="og:description" content="Receive each month in your mailbox, a musical documentary to watch, carefully picked by our editors.">
    <meta property="og:image" content="https://lamixtape.fr/wp-content/themes/lamixtape/img/lamixtape-clubdocu.png">
    <meta property="og:url" content="<?php the_permalink(); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>">
    <meta name="twitter:image:alt" content="Receive each month in your mailbox, a musical documentary to watch, carefully picked by our editors.">
    <meta property="fb:app_id" content="169884383585844">
    <meta name="twitter:site" content="@lamixtape">

    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <article class="club-docu">
      <section id="landing">
        <article>
          <div class="container text-center">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <h1>Lamixtape</h1>
                <svg width="400px" height="50px" class="font-smoothing">  1
                  <rect x="0" y="0" width="50" height="50" class="c--1" /><text x="13" y="37px" font-family="Futura" font-size="30" fill="#fff" >C</text></rect>
                  <rect x="50" y="0" width="50" height="50" class="c--2" /><text x="66" y="37px" font-family="Futura" font-size="30" fill="#fff">L</text></rect>
                  <rect x="100" y="0"  width="50" height="50" class="c--3" /><text x="113" y="37px" font-family="Futura" font-size="30" fill="#fff">U</text></rect>
                  <rect x="150" y="0" width="50" height="50" class="c--4" /><text x="165" y="37px" font-family="Futura" font-size="30" fill="#fff">B</text></rect>
                  <rect x="200" y="0" width="50" height="50" class="c--5" /><text x="214" y="37px" font-family="Futura" font-size="30" fill="#fff">D</text></rect>
                  <rect x="250" y="0"  width="50" height="50" class="c--6" /><text x="261" y="37px" font-family="Futura" font-size="30" fill="#fff">O</text></rect>
                  <rect x="300" y="0" width="50" height="50" class="c--7" /><text x="311" y="37px" font-family="Futura" font-size="30" fill="#fff">C</text></rect>
                  <rect x="350" y="0" width="50" height="50" class="c--8" /><text x="363" y="37px" font-family="Futura" font-size="30" fill="#fff">U</text></rect>
                </svg>
              </div>
            </div>
            <h2 class="text-center font-smoothing">A musical documentary to watch, carefully picked by our editors, every month in your mailbox.</h2>
            <form id="subscribe-form" action="//lamixtape.us5.list-manage.com/subscribe/post-json?u=736b870a10734052b6e900cda&amp;id=63d6a048d8" method="get">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="input-group">
                    <input type="email" value="" name="EMAIL" class="required email form-control font-smoothing" id="mce-EMAIL" placeholder="Your Email">
                    <span class="input-group-btn">
                      <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default font-smoothing" type="button">&rarr;</button>
                    </span>
                  </div>
                </div>
              </div>
              <div id="subscribe-result" class="font-smoothing"></div>
            </form>
          </div>
        </article>
        <nav>
          <div class="container">
            <div class="row">
              <div class="col-sm-5 col-xs-12 font-smoothing">
                &larr;&nbsp;<a href="<?php echo get_bloginfo( 'wpurl' );?>">Go back on Lamixtape</a>
                <!--<a href="<?php echo get_bloginfo( 'wpurl' );?>">MIXTAPES</a>&nbsp;&nbsp;
                <a href="<?php echo get_bloginfo( 'wpurl' );?>/explore">EXPLORE</a>&nbsp;&nbsp;
                <a href="<?php echo get_bloginfo( 'wpurl' );?>/about">ABOUT</a>-->
              </div>
              <div class="col-sm-7 text-right hidden-xs">
                <ul class="list-inline">
                  <li>
                    <form role="search" method="get" id="expand" class="" action="<?php echo get_bloginfo( 'wpurl' );?>">
                      <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="" placeholder="&#xF002;" style="font-Family:FontAwesome;font-Style:normal;font-Weight:normal;textDecoration:inherit;">
                    </form>
                  </li>
                  <li><a href="//twitter.com/lamixtape" class="no--hover" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>&nbsp;&nbsp;</li>
                  <li><a href="//www.facebook.com/Lamixtape" class="no--hover" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </section>
      <?php
          $new_loop = new WP_Query( array(
          'post_type' => 'club-docu',
              'posts_per_page' => 1 // put number of posts that you'd like to display
          ) );
      ?>
      <?php if ( $new_loop->have_posts() ) : ?>
      <?php while ( $new_loop->have_posts() ) : $new_loop->the_post(); ?>
      <section id="sample" style="background: url(<?php if( get_field('background') ): ?><?php the_field('background'); ?><?php endif; ?>) no-repeat center center ; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
        <div class="filter">
          <div class="container">
            <div class="row">
              <div class="col-md-7">
                <span class="font-smoothing text-uppercase">This Month Documentary</span>
                <h3 class="font-smoothing"><?php the_title(); ?></h3>
                <p class="infos font-smoothing"><?php if( get_field('annee') ): ?><?php the_field('annee'); ?><?php endif; ?> • <?php if( get_field('duree') ): ?><?php the_field('duree'); ?><?php endif; ?> • <?php if( get_field('langue') ): ?><?php the_field('langue'); ?><?php endif; ?></p>
                <div class="abstract font-smoothing"><?php the_field('synopsis'); ?></div>
                <a href="<?php if( get_field('link') ): ?><?php the_field('link'); ?><?php endif; ?>" class="btn btn-xl btn-default  text-capitalize" target="_blank"><i class="fa fa-play" aria-hidden="true"></i>&nbsp;WATCH IT NOW</a>
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><div class="hidden-xs"><p>&nbsp;</p></div>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-4 hidden-xs">
                <img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive" alt="<?php the_title(); ?>" style="margin-top:50px">
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php endwhile;?>
      <?php else: ?>
      <?php endif; ?>
      <div class="footer--border">
        <div class="color-1"></div>
        <div class="color-2"></div>
        <div class="color-3"></div>
        <div class="color-4"></div>
        <div class="color-5"></div>
        <div class="color-6"></div>
        <div class="color-7"></div>
        <div class="color-8"></div>
        <div class="color-9"></div>
        <div class="color-10"></div>
      </div>
      <section id="footer">
        <article class="container">
          <p class="text-center font-smoothing">Don’t miss the next documentary, receive it directly in your mailbox.  <br><small>No spam, no hassle. Just a documentary. Each month.</small></p>
          <form id="subscribe-form-2" action="//lamixtape.us5.list-manage.com/subscribe/post-json?u=736b870a10734052b6e900cda&amp;id=63d6a048d8" method="get">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="input-group">
                  <input type="email" value="" name="EMAIL" class="required email form-control font-smoothing" id="mce-EMAIL" placeholder="Your Email">
                  <span class="input-group-btn">
                    <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default font-smoothing" type="button">&rarr;</button>
                  </span>
                </div>
              </div>
            </div>
            <div id="subscribe--result" class="font-smoothing text-center"></div>
          </form>
        </article>
      </section>
      <footer class="container">
        <div class="row">
          <div class="col-xs-8">
            <p class="font-smoothing">© <?php echo date("Y"); ?>, Lamixtape &#8226; <a href="<?php echo get_bloginfo( 'wpurl' );?>/legals" class="underline">Impressum</a></p>
          </div>
          <div class="col-xs-4 text-right">
            <p class="font-smoothing">v4.1</p>
          </div>
        </div>
      </footer>
    </article>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/libs.min.js" ></script>
    <?php wp_footer(); ?>
  </body>
</html>
