<?php
/*
Template Name: Blog
*/
?>
 
<?php get_header(); ?>

<div id="heading">
	
	<h2><?php the_title(); ?></h2>

</div><!-- / #welcome -->

<div id="content">

	<div class="post_content">
 
		<?php // WP 3.0 PAGED BUG FIX
			if ( get_query_var('paged') )
				$paged = get_query_var('paged');
			elseif ( get_query_var('page') ) 
				$paged = get_query_var('page');
			else 
				$paged = 1;
			//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
			 
			query_posts("post_type=post&paged=$paged"); if (have_posts()) :
		?>	
		
			<?php get_template_part('loop'); ?>
			
		<?php endif; ?>
		
		<div class="cleaner">&nbsp;</div>
 
	</div><!-- / .post_content -->
 
</div><!-- / #content -->
 
<?php get_footer(); ?>