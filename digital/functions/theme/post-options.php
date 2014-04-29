<?php

/*  Post Layouts
==================================== */

 
function wpz_newpost_head() {
	?><style type="text/css">
		.slider_btn_add { margin:22px 0 0 10px; }
		.wpz_border { float:right; margin:0; }
		.wpzoom_slider li, .wpzoom_slider li * { margin: 0; }
		.wpzoom_slider li { float: left; position: relative; text-align: center; background-color: #eee; padding: 5px; border: 1px solid #e0e0e0; border-radius: 4px; margin: 10px !important; }
		.wpzoom_slider li .hndle, .wpzoom_slider li .wpzoom_slide_remove { display: none; position: absolute; top: -6px; padding: 4px; border-radius: 50%; }
		.wpzoom_slider li:hover .hndle, .wpzoom_slider li:hover .wpzoom_slide_remove { display: block; }
		.wpzoom_slider li .hndle { left: -6px; line-height: 0; }
		.wpzoom_slider li .wpzoom_slide_remove { right: -6px; font-size: 18px !important; padding: 3px 4px; }
		.wpzoom_slider.onlyone li .wpzoom_slide_remove { display: none; }
		.wpzoom_slider li .wpzoom_slide_remove:hover, .wpzoom_slider li .wpzoom_slide_remove:active { color: red; border-color: red; }
		.wpzoom_slide_preview_image { display: block; width: 250px; border: 1px solid #ccc; margin-bottom: 8px !important; }
		.wpzoom_slider li br { display: none; }
		.wpzoom_slider li hr { border: 1px solid transparent; border-top-color: #ccc; border-bottom-color: #fff; margin: 8px 0; }
		.wpzoom_slider li .wpzoom_slide_caption { width: 100%; }
 	</style><?php
}
add_action('admin_head-post-new.php', 'wpz_newpost_head', 100);
add_action('admin_head-post.php', 'wpz_newpost_head', 100);


if ( isset($_GET['wpz_slides']) ) {
	function wpz_btnval($safe_text, $text) {
			return str_replace(__('Insert into Post'), __('Use this image'), $text);
	}
	add_filter('attribute_escape', 'wpz_btnval', 10, 2);
}

/* Registering meta box for Portfolio slider
===============================================*/

function add_custom_meta_box() {
	add_meta_box(
		'custom_meta_box', // $id
		'Slider', // $title
		'show_custom_meta_box', // $callback
		'portfolio', // $page
		'normal', // $context
		'high' // $priority
	);
}
add_action('add_meta_boxes', 'add_custom_meta_box');


function show_custom_meta_box() {
	global $post;

	$meta = get_post_meta($post->ID, 'wpzoom_slider', true);

	$image = get_template_directory_uri() . '/images/image.png';

	$i = 1;

	?>

	<p class="wpz_border">
		<label for="slider_size" >Slider Size:</label> 
		<select name="slider_size" id="slider_size">
			<option<?php selected( get_post_meta($post->ID, 'slider_size', true), 'Full-width' ); ?>>Full-width</option>
			<option<?php selected( get_post_meta($post->ID, 'slider_size', true), 'Main Column' ); ?>>Main Column</option>
 		</select>
		<br />
	</p>

	<?php


	$html = '<li class="wpzoom_slider_%1$d">
				<span class="sort hndle button" title="Click and drag to reorder this slide"><img src="' . get_template_directory_uri() . '/images/move.png" alt="#" /></span>
				<span class="wpzoom_slide_remove button" title="Click to remove this slide">&times;</span>

				<span class="wpzoom_slide_default_image" style="display:none">' . get_template_directory_uri() . '/images/image.png</span>
				<img src="%3$s" class="wpzoom_slide_preview_image" />

				<br />

				<input name="wpzoom_slider[%1$d][imageId]" type="hidden" class="wpzoom_slide_upload_image" value="%2$s" />
				<input class="wpzoom_slide_upload_image_button button" type="button" value="Choose Image" />
				<small>&nbsp;<a href="#" class="wpzoom_slide_clear_image_button">Remove Image</a></small>

				<hr />

				<input type="text" name="wpzoom_slider[%1$d][caption]" value="%4$s" placeholder="Caption&hellip;" class="wpzoom_slide_caption" />
			</li>';

	echo '<input type="hidden" name="wpzoom_slider_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

	echo '<div class="slider_btn_add"><a class="wpzoom_slide_add button" href="#">+ Add Slide</a><br class="clear"></div><ul class="wpzoom_slider' . (count($meta) <= 1 ? ' onlyone' : '') . '">';

 
	if ( !empty($meta) ) {
		foreach ( $meta as $item ) {
			unset($attachment, $currImg);
			$attachment = is_numeric($item['imageId']) ? array_shift(wp_get_attachment_image_src($item['imageId'], 'medium')) : $item['imageId'];
			$currImg = isset($attachment) && !empty($attachment) ? $attachment : $image;

			printf($html, $i, $item['imageId'], $currImg, $item['caption']);

			$i++;
		}
	} else {
		printf($html, $i, '', $image, '');
	}

	echo '</ul><br class="clear" />';

	return;
}

function save_custom_meta($post_id) {
	// verify nonce
	if (!wp_verify_nonce($_POST['wpzoom_slider_meta_box_nonce'], basename(__FILE__)))
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}


	$slides = isset($_POST['wpzoom_slider']) ? (array)$_POST['wpzoom_slider'] : array();
	$new = array();

	foreach ( $slides as $slide ) {
		$image = trim($slide['imageId']);
		$caption = trim($slide['caption']);

		if ( empty($image) && empty($caption) ) continue;

		$new[] = array('imageId' => $image, 'caption' => $caption);
	}

	update_post_meta($post_id, 'wpzoom_slider', $new);
 	update_custom_meta($post_id, $_POST['slider_size'], 'slider_size');


}
add_action('save_post', 'save_custom_meta');



/*
/* Registering metaboxes
============================================*/

add_action('admin_menu', 'wpzoom_options_box');

function wpzoom_options_box() {
   	add_meta_box('wpzoom_portfolio_meta', 'Optional Details', 'wpzoom_portfolio_options', 'portfolio', 'side', 'high');
}

 

// Portfolio Options
function wpzoom_portfolio_options() {
	global $post;
	?>
	<fieldset>
		<div>

			<p>
 				<?php $isChecked = ( get_post_meta($post->ID, 'wpzoom_is_featured', true) == 1 ? 'checked="checked"' : '' ); // we store checked checkboxes as 1 ?>
				<input type="checkbox" name="wpzoom_is_featured" id="wpzoom_is_featured" value="1" <?php echo $isChecked; ?> /> <label for="wpzoom_is_featured"><strong>Feature on Homepage</strong></label> 
			</p>

			<p>
				<label for="wpzoom_portfolio_overview" ><strong>Project Overview</strong>:</label><br />
				<textarea style="height: 90px; width: 255px;" name="wpzoom_portfolio_overview" id="wpzoom_portfolio_overview"><?php echo get_post_meta($post->ID, 'wpzoom_portfolio_overview', true); ?></textarea>
			</p>

			<p>
				<label for="wpzoom_portfolio_client" ><strong>Client's Name</strong>:</label><br />
				<input style="width: 255px;" type="text" name="wpzoom_portfolio_client" id="wpzoom_portfolio_client" value="<?php echo get_post_meta($post->ID, 'wpzoom_portfolio_client', true); ?>"/>
 			</p>

			<br/>

			<p>
				<label for="wpzoom_portfolio_services" ><strong>Services</strong>:</label><br />
				<textarea style="height: 90px; width: 255px;" name="wpzoom_portfolio_services" id="wpzoom_portfolio_services"><?php echo get_post_meta($post->ID, 'wpzoom_portfolio_services', true); ?></textarea>
			</p>


			<br/>

 		</div>
	</fieldset>
	<?php
	}



add_action('save_post', 'custom_add_save');

function custom_add_save($postID){

	// called after a post or page is saved
	if($parent_id = wp_is_post_revision($postID))
	{
	  $postID = $parent_id;
	}

	if (isset($_POST['save']) || isset($_POST['publish'])) {

		update_custom_meta($postID, $_POST['wpzoom_is_featured'], 'wpzoom_is_featured');
		update_custom_meta($postID, $_POST['wpzoom_portfolio_overview'], 'wpzoom_portfolio_overview');
     	update_custom_meta($postID, $_POST['wpzoom_portfolio_client'], 'wpzoom_portfolio_client');
     	update_custom_meta($postID, $_POST['wpzoom_portfolio_services'], 'wpzoom_portfolio_services');

	}
}


function update_custom_meta($postID, $newvalue, $field_name) {
	// To create new meta
	if (!get_post_meta($postID, $field_name)) {
 		add_post_meta($postID, $field_name, $newvalue);
	} else {
		// or to update existing meta
		update_post_meta($postID, $field_name, $newvalue);
	}
}


/*
/*	Queue Scripts
============================================*/
function wpzoom_admin_scripts() {
	global $pagenow, $typenow;

	if ( isset($pagenow) && ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) && isset($typenow) && $typenow == 'portfolio' ) {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('wpzoom-upload', get_template_directory_uri() . '/functions/theme/assets/js/upload-button.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('wpzoom-upload');
	}
}
function wpzoom_admin_styles() {
	global $pagenow, $typenow;

	if ( isset($pagenow) && ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) && isset($typenow) && $typenow == 'portfolio' ) {
		wp_enqueue_style('thickbox');
	}
}
add_action('admin_print_scripts', 'wpzoom_admin_scripts');
add_action('admin_print_styles', 'wpzoom_admin_styles');
