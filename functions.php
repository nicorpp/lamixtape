<?php

  // -----------------------------------------------------
  // ------  Enabling Support for Post Thumbnails --------
  // -----------------------------------------------------

  add_theme_support( 'post-thumbnails' );

  // -----------------------------------------------------
  // ---------- Search on custom fields ------------------
  // -----------------------------------------------------

  /* Join posts and postmeta tables */

  function cf_search_join( $join ) {
      global $wpdb;
      if ( is_search() ) {
          $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
      }
      return $join;
  }
  add_filter('posts_join', 'cf_search_join' );

  /* Modify the search query with posts_where */

  function cf_search_where( $where ) {
      global $pagenow, $wpdb;
      if ( is_search() ) {
          $where = preg_replace(
              "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
              "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
      }
      return $where;
  }
  add_filter( 'posts_where', 'cf_search_where' );

  /** Prevent duplicates */

  function cf_search_distinct( $where ) {
      global $wpdb;
      if ( is_search() ) {
          return "DISTINCT";
      }
      return $where;
  }
  add_filter( 'posts_distinct', 'cf_search_distinct' );

  /** Exclude Pages from search results */

  function SearchFilter($query) {
    if ($query->is_search) {
    $query->set('post_type', 'post');
    }
    return $query;
  }

  add_filter('pre_get_posts','SearchFilter');

  // -----------------------------------------------------
  // ---------- add page slug to body class --------------
  // -----------------------------------------------------

  add_filter( 'body_class', 'prefix_conditional_body_class' );
  function prefix_conditional_body_class( $classes ) {
    if( is_page_template('about.php') )
        $classes[] = 'about';
    return $classes;
  }

  // -----------------------------------------
  // ---------- Clean up the <head> ----------
  // -----------------------------------------

  remove_action('wp_head', 'rsd_link');
  remove_action( 'wp_head', 'rel_canonical' );
  remove_action('wp_head', 'wp_resource_hints', 2);
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'start_post_rel_link');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'adjacent_posts_rel_link');
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action( 'wp_head',      'rest_output_link_wp_head'              );
  remove_action( 'wp_head',      'wp_oembed_add_discovery_links'         );
  remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
  function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
  }
  add_action( 'wp_footer', 'my_deregister_scripts' );

  //Disable gutenberg style in Front
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );

  // -----------------------------------------
  // ---- Backoffice : rename "Posts" --------
  // -----------------------------------------

  function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Playlist';
    $submenu['edit.php'][5][0] = 'Playlists';
    $submenu['edit.php'][10][0] = 'Add Playlist';
    $submenu['edit.php'][16][0] = 'Playlist Tags';
  }

  function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Playlists';
    $labels->singular_name = 'Playlists';
    $labels->add_new = 'Add Playlist';
    $labels->add_new_item = 'Add Playlist';
    $labels->edit_item = 'Edit Playlist';
    $labels->new_item = 'Playlists';
    $labels->view_item = 'View Playlist';
    $labels->search_items = 'Search Playlists';
    $labels->not_found = 'No Playlist found';
    $labels->not_found_in_trash = 'No Playlists found in Trash';
    $labels->all_items = 'All Playlists';
    $labels->menu_name = 'Playlists';
    $labels->name_admin_bar = 'Playlists';
  }

  add_action( 'admin_menu', 'revcon_change_post_label' );
  add_action( 'init', 'revcon_change_post_object' );

  // -----------------------------------------
  // ----------- Random Button 404  ----------
  // -----------------------------------------

  add_action('init','random_post');
  function random_post() {
   global $wp;
   $wp->add_query_var('random');
   add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
  }

  add_action('template_redirect','random_template');
  function random_template() {
    if (get_query_var('random') == 1) {
           $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
           foreach($posts as $post) {
                   $link = get_permalink($post);
           }
           wp_redirect($link,307);
           exit;
    }
  }

  // -----------------------------------------
  // ---------- Ajax loadmore shit  ----------
  // -----------------------------------------

function misha_loadmore_ajax_handler(){

		global $wpdb;

		if(is_single()) {
			$postid = get_the_ID();
			$format = 'Y-m-d H:i:s';
			$publish_date = get_the_date( $format, $postid );
			$querystr = "
				SELECT
						p1.*
					FROM
						$wpdb->posts p1
					WHERE
						p1.post_date <= '$publish_date' AND
						p1.ID < $postid AND
						p1.post_type = 'post' AND
						p1.post_status = 'publish' AND
						p1.ID NOT IN ($postid)
					ORDER by
						p1.post_date DESC, p1.ID DESC";
		} else {
			$querystr = "
				SELECT
						p1.*
					FROM
						$wpdb->posts p1
					WHERE
						p1.post_type = 'post' AND
						p1.post_status = 'publish'
					ORDER by
						p1.post_date DESC, p1.ID DESC";
		}

				$post_per_page = 10;
				$offset = $_POST['page'] * $post_per_page;

				$total_record = count($wpdb->get_results($querystr, ARRAY_A));

				$wp_query->found_posts = $total_record;
				// number of pages

				$wp_query->max_num_pages = ceil($wp_query->found_posts / $post_per_page);

				$pageposts = $wpdb->get_results( $querystr . " LIMIT $offset, $post_per_page" , OBJECT);

		    //$pageposts = $wpdb->get_results($querystr, OBJECT);


    		 if ($pageposts):
    		 global $post;
         $counter = 0;
    		 foreach ($pageposts as $post):
           $backgroundColor = '';

           switch ($counter) {
             case 0:
                 $backgroundColor = '#34495e';
                 break;
             case 1:
                 $backgroundColor = '#3498db';
                 break;
             case 2:
                 $backgroundColor = '#1abc9c';
                 break;
             case 3:
                 $backgroundColor = '#16a085';
                 break;
             case 4:
                 $backgroundColor = '#2ecc71';
                 break;
             case 5:
                 $backgroundColor = '#bdc3c7';
                 break;
             case 6:
                 $backgroundColor = '#e74c3c';
                 break;
             case 7:
                 $backgroundColor = '#e67e22';
                 break;
             case 8:
                 $backgroundColor = '#f1c40f';
                 break;
             case 9:
                 $backgroundColor = '#9b59b6';
                 break;
            }
            $counter++;
    		 setup_postdata($post);

            //$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            //query_posts('paged='.$paged);

    			  echo '<article>
    			  <a href="'.get_the_permalink().'">
    				<header style="background-color:'.$backgroundColor.'">
    				  <div class="container">
    					<h2 class="">'.get_the_title().'<span class="hidden-xs hidden-sm pull-right '.get_the_author().'" style="display:none!important"> Selected by: '.get_the_author().'</span></h2>

    					<span class="hidden-xs">';

    						$categories = get_the_category();
    						$separator = ' ';
    						$output = '';
    						if ( ! empty( $categories ) ) {
    							foreach( $categories as $category ) {
    								$output .= '<a class="category hidden-xs" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
    							}
    							echo trim( $output, $separator );
    						}
    					  echo '</span>

    				  </div>

    				</header>

    			  </a>
    			</article>';

    	endforeach;

    	endif;

    	die; // here we exit the script and even no wp_reset_query() required!
    }

  add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
  add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

  function loadmore_enqueue() {
	wp_enqueue_script( 'ias-script', get_template_directory_uri() . '/js/jquery-ias.min.js', null, null, true);
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
    wp_localize_script( 'ajax-script', 'loadmore', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
  }

  add_action( 'wp_enqueue_scripts', 'loadmore_enqueue' );

  // -----------------------------------------------------
  // -------- Custom posts type: Club Docu  --------------
  // -----------------------------------------------------

  function create_documentaire_cpt() {
    $labels = array(
      'name' => __( 'Documentaires', 'Post Type General Name', 'club-docu' ),
      'singular_name' => __( 'Documentaire', 'Post Type Singular Name', 'club-docu' ),
      'menu_name' => __( 'Documentaires', 'club-docu' ),
      'name_admin_bar' => __( 'Documentaire', 'club-docu' ),
      'archives' => __( 'Documentaire Archives', 'club-docu' ),
      'attributes' => __( 'Documentaire Attributes', 'club-docu' ),
      'parent_item_colon' => __( 'Parent Documentaire:', 'club-docu' ),
      'all_items' => __( 'All Documentaires', 'club-docu' ),
      'add_new_item' => __( 'Add New Documentaire', 'club-docu' ),
      'add_new' => __( 'Add New', 'club-docu' ),
      'new_item' => __( 'New Documentaire', 'club-docu' ),
      'edit_item' => __( 'Edit Documentaire', 'club-docu' ),
      'update_item' => __( 'Update Documentaire', 'club-docu' ),
      'view_item' => __( 'View Documentaire', 'club-docu' ),
      'view_items' => __( 'View Documentaires', 'club-docu' ),
      'search_items' => __( 'Search Documentaire', 'club-docu' ),
      'not_found' => __( 'Not found', 'club-docu' ),
      'not_found_in_trash' => __( 'Not found in Trash', 'club-docu' ),
      'featured_image' => __( 'Featured Image', 'club-docu' ),
      'set_featured_image' => __( 'Set featured image', 'club-docu' ),
      'remove_featured_image' => __( 'Remove featured image', 'club-docu' ),
      'use_featured_image' => __( 'Use as featured image', 'club-docu' ),
      'insert_into_item' => __( 'Insert into Documentaire', 'club-docu' ),
      'uploaded_to_this_item' => __( 'Uploaded to this Documentaire', 'club-docu' ),
      'items_list' => __( 'Documentaires list', 'club-docu' ),
      'items_list_navigation' => __( 'Documentaires list navigation', 'club-docu' ),
      'filter_items_list' => __( 'Filter Documentaires list', 'club-docu' ),
    );
    $args = array(
      'label' => __( 'Documentaire', 'club-docu' ),
      'description' => __( 'Club ocuD', 'club-docu' ),
      'labels' => $labels,
      'menu_icon' => 'dashicons-format-video',
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail', ),
      'taxonomies' => array(),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'show_in_admin_bar' => true,
      'show_in_nav_menus' => true,
      'can_export' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'exclude_from_search' => true,
      'show_in_rest' => true,
      'publicly_queryable' => true,
      'capability_type' => 'post',
    );
    register_post_type( 'club-docu', $args );
  }

  add_action( 'init', 'create_documentaire_cpt', 0 );

  // -----------------------------------------------------
  // ------------- Reduce Post Revisions -----------------
  // -----------------------------------------------------

  define( 'WP_POST_REVISIONS', 3 );

  // -----------------------------------------------------
  // ------------- Remove WP version # -------------------
  // -----------------------------------------------------

  function wpb_remove_version() {
  return '';
  }
  add_filter('the_generator', 'wpb_remove_version');

  // -----------------------------------------------------
  // --------------- Secure WP Admin ---------------------
  // -----------------------------------------------------

  /* Hide Login Errors in WordPress */

  function no_wordpress_errors(){
    return 'Something is wrong!';
  }
  add_filter( 'login_errors', 'no_wordpress_errors' );

  // -----------------------------------------------------
  // --------------- Next and Previous links -------------
  // -----------------------------------------------------

  add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
  add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');
  add_filter('next_post_link_attributes', 'posts_link_attributes_1');
  add_filter('previous_post_link_attributes', 'posts_link_attributes_2');

  function posts_link_attributes_1() {
      return 'class="prev-post"';
  }

  function posts_link_attributes_2() {
      return 'class="next-post"';
  }

  // -----------------------------------------------------
  // ------------- Remove Contact Form 7 CSS -------------
  // -----------------------------------------------------
  //

add_action( 'wp_enqueue_scripts', 'ac_remove_cf7_scripts' );

function ac_remove_cf7_scripts() {
  if ( !is_page('contact') ) {
    wp_deregister_style( 'contact-form-7' );
    wp_deregister_script( 'contact-form-7' );
  }
}


 // -----------------------------------------------------
 // ------------- Comments on Mixtapes      -------------
 // -----------------------------------------------------
 //

 // Comments
 function tape_comment($comment, $args, $depth) {
     if ( 'div' === $args['style'] ) {
         $tag       = 'div';
         $add_below = 'comment';
     } else {
         $tag       = 'li';
         $add_below = 'div-comment';
     }?>
     <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php
     if ( 'div' != $args['style'] ) { ?>
         <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
     } ?>
     <?php echo get_comment_text(); ?><br>
         <p><small>&mdash; <?php
             if ( $args['avatar_size'] != 0 ) {
                 echo get_avatar( $comment, $args['avatar_size'] );
             }
             printf( __( '%s' ), get_comment_author_link() ); ?>
         </small></p><?php
         if ( $comment->comment_approved == '0' ) { ?>
             <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
         } ?>
 <?php
     if ( 'div' != $args['style'] ) : ?>
         </div><?php
     endif;
 }

 // form

function my_update_comment_fields( $fields ) {

 $commenter = wp_get_current_commenter();
 $req       = get_option( 'require_name_email' );
 $label     = $req ? '*' : ' ' . __( '(optional)', 'text-domain' );
 $aria_req  = $req ? "aria-required='true'" : '';

 $fields['author'] =
   '<p class="comment-form-author">
     <input id="author" name="author" type="text" placeholder="' . esc_attr__( "Name", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
   '" size="30" ' . $aria_req . ' />
   </p>';

 $fields['email'] =
   '<p class="comment-form-email">
     <input id="email" name="email" type="email" placeholder="' . esc_attr__( "name@email.com", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
   '" size="30" ' . $aria_req . ' />
   </p>';

 $fields['url'] =
   '<p class="comment-form-url">
     <input id="url" name="url" type="url"  placeholder="' . esc_attr__( "http://google.com", "text-domain" ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
   '" size="30" />
     </p>';

 return $fields;
}
add_filter( 'comment_form_default_fields', 'my_update_comment_fields' );

function my_update_comment_field( $comment_field ) {

 $comment_field =
   '<p class="comment-form-comment">
           <textarea required id="comment" name="comment" placeholder="' . esc_attr__( "Comment...", "text-domain" ) . '" cols="45" rows="8" aria-required="true"></textarea>
       </p>';

 return $comment_field;
}
add_filter( 'comment_form_field_comment', 'my_update_comment_field' );

  // -----------------------------------------------------
  // ------------- Code for Like and Dislike features-------------
  // -----------------------------------------------------
  //


 function push_script() {

    wp_localize_script( 'jquery', 'bloginfo', array(
        'template_url' => get_bloginfo('template_url'),
        'site_url' => get_bloginfo('url'),
            'post_id'   => get_queried_object()
      ));
}
add_action('init', 'push_script');




// Register the new route
add_action( 'rest_api_init', function () {

  register_rest_route( 'social/v2', '/likes/(?P<id>\d+)', array(
        'methods' => array('GET','POST'),
        'callback' => 'social__like',
    ) );
  register_rest_route( 'social/v2', '/dislikes/(?P<id>\d+)', array(
        'methods' => array('GET','POST'),
        'callback' => 'social__dislike',
    ) );

});

// This is how you setup a callback function to work with your new endpoint
 function social__like( WP_REST_Request $request ) {
        // Custom field slug
        $field_name = 'likes_number';
        // Get the current like number for the post
        $current_likes = get_field($field_name, $request['id']);
        // Add 1 to the existing number
        $updated_likes = $current_likes + 1;
        // Update the field with a new value on this post
        $likes = update_field($field_name, $updated_likes, $request['id']);

        return $likes;
    }
  // This is how you setup a callback function to work with your new endpoint
 function social__dislike( WP_REST_Request $request ) {
        // Custom field slug
        $field_name = 'dislikes_number';
        // Get the current like number for the post
        $current_dislikes = get_field($field_name, $request['id']);
        // Add 1 to the existing number
        $updated_dislikes = $current_dislikes + 1;
        // Update the field with a new value on this post
        $dislikes = update_field($field_name, $updated_dislikes, $request['id']);

        return $dislikes;
    }
