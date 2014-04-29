<?php get_header(); ?>

<?php
if (option::get('featured_posts_show') == 'on' && is_home() && $paged < 2) { // Show the Featured Slider
	get_template_part('wpzoom-slider'); 
}
?>

<div id="content">
	<?php
	if (option::get('portfolio') == 'on') {
		echo '<div id="portfolio-home">';
		get_template_part('wpzoom-portfolio-all');
		echo '</div>';
	}

	if (option::get('recent_posts') == 'on') {
		get_template_part('wpzoom-recentposts');	
	}
	?>
</div>

<?php get_footer(); ?>