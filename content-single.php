<div id="posts">
<section class="mixtape--list" id="single-main">
  <article class="playlist" style="background-color:<?php the_field('color'); ?>">
    <div class="container">
      <header id="main-playlist font-smoothing">
        <div class="row">
          <div class="col-sm-7 col-xs-12">
            <h2><?php the_title(); ?></h2>
            <script type="text/javascript">
             var postid = "<?php the_ID(); ?>";

           </script>
            <?php
              $categories = get_the_category();
              $separator = ' ';
              $output = '';
              if ( ! empty( $categories ) ) {
                  foreach( $categories as $category ) {
                      $output .= '<a class="category font-smoothing" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                  }
                  echo trim( $output, $separator );
              }
            ?>
          </div>
          <div class="col-sm-5 text-right hidden-xs buttons">
            <button class="like__btn animated">
               🔥&nbsp;
               <span class="like__number"><?php if(!get_field('likes_number')) { echo "0"; } else { the_field('likes_number'); } ?></span>
             </button>
             <button class="dislike__btn animated">
             🤔&nbsp;
             <span class="dislike__number"><?php if(!get_field('dislikes_number')) { echo "0"; } else { the_field('dislikes_number'); } ?></span>
           </button>
            <button type="button" data-toggle="collapse" data-target="#comments" aria-expanded="false" aria-controls="comments">💬&nbsp;<?php printf( _nx( '1', '%1$s', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n(get_comments_number() ) ); ?></button>
          </div>
        </div>
      </header>
      <hr class="hr--playlist">
    	<div class="visible-xs font-smoothing">
        <br>
        <?php if( get_field('iframe') ): ?>
        <?php the_field('iframe'); ?>
        <?php else: echo '→ This playlist will be soon available on mobile.'; endif; ?>
    	</div>
      <div class="row">
      <ul class="tracklist hidden-xs col-sm-8 list-unstyled font-smoothing">
        <li>
          <a class="track-url" id="first-track" href="<?php the_field('url_1'); ?>" data-url="<?php the_field('url_1'); ?>" >
            <span class="track-name"><?php the_field('artist_1'); ?> - <?php the_field('track_1'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_2'); ?>" data-url="<?php the_field('url_2'); ?>" >
            <span class="track-name"><?php the_field('artist_2'); ?> - <?php the_field('track_2'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_3'); ?>" data-url="<?php the_field('url_3'); ?>" >
            <span class="track-name"><?php the_field('artist_3'); ?> - <?php the_field('track_3'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_4'); ?>" data-url="<?php the_field('url_4'); ?>" >
            <span class="track-name"><?php the_field('artist_4'); ?> - <?php the_field('track_4'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_5'); ?>" data-url="<?php the_field('url_5'); ?>" >
            <span class="track-name"><?php the_field('artist_5'); ?> - <?php the_field('track_5'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_6'); ?>" data-url="<?php the_field('url_6'); ?>" >
            <span class="track-name"><?php the_field('artist_6'); ?> - <?php the_field('track_6'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_7'); ?>" data-url="<?php the_field('url_7'); ?>" >
            <span class="track-name"><?php the_field('artist_7'); ?> - <?php the_field('track_7'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_8'); ?>" data-url="<?php the_field('url_8'); ?>" >
            <span class="track-name"><?php the_field('artist_8'); ?> - <?php the_field('track_8'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_9'); ?>" data-url="<?php the_field('url_9'); ?>" >
            <span class="track-name"><?php the_field('artist_9'); ?> - <?php the_field('track_9'); ?></span>
          </a>
        </li>
        <li>
          <a class="track-url" href="<?php the_field('url_10'); ?>" data-url="<?php the_field('url_10'); ?>" >
            <span class="track-name"><?php the_field('artist_10'); ?> - <?php the_field('track_10'); ?></span>
          </a>
        </li>
      </ul>
      <aside class="col-sm-4">
        <div class="collapse" id="comments">
          <?php comments_template(); ?>
          <br>
          <?php comment_form(); ?>
        </div>
      </aside>
    </div>
      <br>
      <p class="font-smoothing author-<?php the_author_meta('ID') ?>">A mixtape curated by <?php the_author_link(); ?> for Lamixtape.</p>
      <div class="text-center newsletter font-smoothing hidden-xs">
        <p>Never miss a new mixtape, get them delivered to your inbox.</p>
        <form id="subscribe-form" action="//lamixtape.us5.list-manage.com/subscribe/post-json?u=736b870a10734052b6e900cda&amp;id=63d6a048d8" method="get">
          <input type="email" value="" name="EMAIL" class="required email form-control font-smoothing" id="mce-EMAIL" placeholder="Your email here">
          <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default font-smoothing" type="button">SUBSCRIBE</button>
          <div id="subscribe-result" class="font-smoothing"></div>
        </form>
        <br>
        <ul class="list-inline text-center">
          <li><a href="https://www.instagram.com/lamixtape/" target="_blank" class="no--hover"><i class="fab fa-instagram fa-sm"></i></a></li>
          <li><a href="https://www.facebook.com/Lamixtape/" target="_blank" class="no--hover"><i class="fab fa-facebook fa-sm"></i></a></li>
          <li><a href="https://twitter.com/lamixtape" target="_blank" class="no--hover"><i class="fab fa-twitter fa-sm"></i></a></li>
          <li><a href="https://soundcloud.com/lamixtape" target="_blank" class="no--hover"><i class="fab fa-soundcloud fa-sm"></i></a></li>
          <li><a href="https://www.youtube.com/channel/UCC6KvX3PCah6yWMCP6BFOYA" target="_blank" class="no--hover"><i class="fab fa-youtube fa-sm"></i></a></li>
          <li><a href="https://open.spotify.com/user/lamixtape" target="_blank" class="no--hover"><i class="fab fa-spotify fa-sm"></i></a></li>
          <li><a href="https://itunes.apple.com/profile/Lamixtape" target="_blank" class="no--hover"><i class="fab fa-apple fa-sm"></i></a></li>
        </ul>
      </div>
    </div>
  </article>
  <?php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $query_string = "paged=" . $paged . "&order=DESC&posts_per_page=1000000";

  // Create a new filtering function that will add our where clause to the query
  function filter_where($where = '') {
    $postid = get_the_ID();
    $format = 'Y-m-d';
    $publish_date = get_the_date( $format, $postid);

    $where .= " AND post_date <= '" . $publish_date . "'";

    return $where;
  }

  add_filter( 'posts_where', 'filter_where' );
  $custom_query = new WP_Query( $query_string );
  remove_filter( 'posts_where', 'filter_where' );

  $pageposts = $custom_query->posts;
  if ($pageposts):
  global $post;
  ?>
  <?php
  $counter = $_COOKIE['count'] + 1;
  foreach ($pageposts as $post):
  setup_postdata($post);
  ?>
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
  <?php endforeach;?>
  <?php else : ?>
  <?php _e( '<div class="container nothing--found"><h2 class="font-smoothing">No playlist found 🐒<br><small>Tell us if you would like to hear a genre or artist in particular <br>→ <style type="text/css">a.mailto span.displaynone{display:none;}</style><a href="mailto:hello@lamixtape.fr" class="mailto">hello@<span class="displaynone">null</span>lamixtape.fr</a></small></h2></div>'); ?>
  <?php endif;?>
</section>
</div>

<?php include "player.php" ?>

<!-- Code stars for like and dislike -->

<script type="text/javascript">
  $(document).ready(function(){

    // When a user clicks the like button
$('.like__btn').on('click', function(){
        // AJAX call goes to our endpoint url
        $.ajax({
            url: bloginfo.site_url + '/wp-json/social/v2/likes/'+ postid,
            type: 'post',
            success: function() {
                $(this).attr('disabled', true).addClass('tada');
             },
             error: function() {
                console.log('failed!');
              }
          });

        // Change the like number in the HTML to add 1
        var updated_likes = parseInt($('.like__number').html()) + 1;

        $('.like__number').html(updated_likes);
        // Make the button disabled
        $(this).attr('disabled', true);
    });



  $('.dislike__btn').on('click', function(){
        // AJAX call goes to our endpoint url
        $.ajax({
            url: bloginfo.site_url + '/wp-json/social/v2/dislikes/'+ postid,
            type: 'post',
            success: function() {
                $(this).attr('disabled', true).addClass('tada');
             },
             error: function() {
                console.log('failed!');
              }
          });

        // Change the like number in the HTML to add 1
        var updated_likes = parseInt($('.dislike__number').html()) + 1;

        $('.dislike__number').html(updated_likes);
        // Make the button disabled
        $(this).attr('disabled', true);
    });

  });
</script>
<!-- Code ends for like and dislike -->
