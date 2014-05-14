<?php get_header(); 

/*if(has_post_thumbnail()){
?>

<div id="heading">
	
 	<?php
	if (option::get('post_thumb') == 'on') {
		get_the_image( array( 'size' => 'blog-featured', 'width' => 740, 'before' => '<div class="post-thumb">', 'after' => '</div>', 'link_to_post' => false ) );
	}
	?>
 
	<!--h2><?php the_title(); ?></h2>

	<div class="meta">
		<?php if (option::get('post_date') == 'on') { ?><span><?php printf( __('%s at %s', 'wpzoom'),  get_the_date(), get_the_time()); ?></span><?php } ?> 

		<?php if (option::get('post_author') == 'on') { ?><span><?php _e('by', 'wpzoom'); ?> <?php the_author_posts_link(); ?></span><?php } ?>

 		<?php if (option::get('post_category') == 'on') { ?><span><?php _e('in', 'wpzoom'); ?> <?php the_category(', '); ?></span><?php } ?>

 		<?php edit_post_link( __('Edit', 'wpzoom'), '<span>', '</span>' ); ?>
	</div-->

 
	<div class="clear">&nbsp;</div>


</div><!-- / #welcome -->
<?php } */ ?>

<div id="content">
	 
	<div class="post_content">
		<?php wp_reset_query(); if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="entry">

			<div class="imagen_principal"><?php the_post_thumbnail(array(700, 300)); ?></div>

			<div class="titulo"><?php the_title(); ?></div>

			<?php the_content(); ?>
		
			<?php wp_link_pages(array('before' => '<p class="pages"><strong>'.__('Pages', 'wpzoom').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<?php if (option::get('post_tags') == 'on') { the_tags( '<strong>' . __('Tags:', 'wpzoom') . '</strong> ', ', ', '' ); } ?>


		</div><!-- / .entry -->

		<?php if (option::get('post_comments') == 'on') { ?>

			<div id="comments">
				<?php comments_template(); ?>  
			</div>

		<?php } ?>
		
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria', 'wpzoom');?>.</p>
		<?php endif; ?>

		<div class="cleaner">&nbsp;</div>          
	</div><!-- / .post_content -->

	<div class="cleaner">&nbsp;</div>
</div><!-- / #content -->
  
<?php get_footer(); ?>