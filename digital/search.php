<?php get_header(); ?>

<div id="heading">
 	<h2><?php _e('Search Results for','wpzoom');?> <strong>&ldquo;<?php the_search_query(); ?>&rdquo;</strong></h2>
	<div class="cleaner">&nbsp;</div>
</div>

 
<div id="content">
	<div class="post_content">
	
		<?php get_template_part('loop'); ?>

	</div><!-- / .post_content -->
 
 
</div><!-- /#content -->
 
 
<?php get_footer(); ?>