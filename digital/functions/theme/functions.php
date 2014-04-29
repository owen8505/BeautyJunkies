<?php

/* Register Thumbnails Size
================================== */

if ( function_exists( 'add_image_size' ) ) {

	/* Homepage Slider */
	add_image_size( 'featured', 630, 370, true );

	/* Portfolio Thumbnails  */
  add_image_size( 'portfolio-thumb', 300, 200, true );

	add_image_size( 'similar-thumb', 200, 130, true );

	/* Portfolio Slider */
  add_image_size( 'portfolio-slide', 960);
	add_image_size( 'portfolio-slide-small', 680);

	/* Main loop */
	add_image_size( 'loop', option::get('thumb_width'), option::get('thumb_height'), true );

	/* Single blog post featured image */
	add_image_size( 'blog-featured', 740);

}
 

/* 	Register Custom Menu
==================================== */

register_nav_menu('primary', 'Main Menu');


/* Registering CSS file for responsive design
==================================== */

function responsive_styles() {
    wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/media-queries.css', array() );
}
add_action( 'wp_enqueue_scripts', 'responsive_styles' );



/*  Add support for Custom Background
==================================== */

if ( ui::is_wp_version( '3.4' ) )
    add_theme_support( 'custom-background' );
else
    add_custom_background( $args );



/*  Reset [gallery] shortcode styles
==================================== */

add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));



/*  Add Support for Shortcodes in Excerpt
========================================== */

add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode');

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');



/*  Custom Excerpt Length
==================================== */

function new_excerpt_length($length) {
	return (int) option::get("excerpt_length") ? (int) option::get("excerpt_length") : 50;
}
add_filter('excerpt_length', 'new_excerpt_length');



/*  Maximum width for images in posts
=========================================== */

 if ( ! isset( $content_width ) ) $content_width = 680;



/* Email validation
==================================== */

function simple_email_check($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }

    return true;
}


/* Drop-down menu Walker
==================================== */

class Page_Navigation_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( !empty( $children_elements[ $element->$id_field ] ) ) {
            $element->classes[] = 'item-with-ul top-level';
        }
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}


/* Show all thumbnails in attachment.php
=========================================== */

function show_all_thumbs() {
	global $post;

	$post = get_post($post);
	$images =& get_children( 'post_type=attachment&post_mime_type=image&output=ARRAY_N&orderby=menu_order&order=ASC&post_parent='.$post->post_parent);
	if($images){
		foreach( $images as $imageID => $imagePost ){
			if($imageID==$post->ID){

			unset($the_b_img);
			$the_b_img = wp_get_attachment_image($imageID, 'thumbnail', false);
			$thumblist .= '<a class="active" href="'.get_attachment_link($imageID).'">'.$the_b_img.'</a>';


			} else {
			unset($the_b_img);
			$the_b_img = wp_get_attachment_image($imageID, 'thumbnail', false);
			$thumblist .= '<a href="'.get_attachment_link($imageID).'">'.$the_b_img.'</a>';
			}
		}
	}
	return $thumblist;
}



/* Comments Custom Template           
==================================== */

function wpzoom_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case '' :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-author vcard">
      <?php echo get_avatar( $comment, 60 ); ?>
      <?php printf( __( '%s <span class="says">says:</span>', 'wpzoom' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
      
      <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php printf( __('%s at %s', 'wpzoom'), get_comment_date(), get_comment_time()); ?></a><?php edit_comment_link( __( '(Edit)', 'wpzoom' ), ' ' );
        ?>
        
      </div><!-- .comment-meta .commentmetadata -->
    
    </div><!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
      <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wpzoom' ); ?></em>
      <br />
    <?php endif; ?>

     

    <div class="comment-body"><?php comment_text(); ?></div>

    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div><!-- .reply -->
  </div><!-- #comment-##  -->

  <?php
      break;
    case 'pingback'  :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'wpzoom' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'wpzoom' ), ' ' ); ?></p>
  <?php
      break;
  endswitch;
}





/*  Limit Posts
/*
/*  Plugin URI: http://labitacora.net/comunBlog/limit-post.phps
/*	Usage: the_content_limit($max_charaters, $more_link)
===================================================== */

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '', $echo = true) {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0 && $thisshouldnotapply) {
      echo $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        if ($echo == true) { echo $content . "..."; } else {return $content; }
   }
   else {
      if ($echo == true) { echo $content . "..."; } else {return $content; }
   }
}