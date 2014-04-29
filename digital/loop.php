<?php while (have_posts()) : the_post();?>

	<div class="posts">

		<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

		<?php if (option::get('index_thumb') == 'on') {

 			get_the_image( array( 'size' => 'loop', 'width' => option::get('thumb_width'), 'height' => option::get('thumb_height'), 'before' => '<div class="post-thumb">', 'after' => '</div>' ) );

		} ?>
		
		<ul class="meta">
			<?php if (option::get('display_date') == 'on') { ?><span><?php printf( __('%s at %s', 'wpzoom'),  get_the_date(), get_the_time()); ?></span><?php } ?>
			<?php if (option::get('display_comments') == 'on') { ?><span><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>
			<?php if (option::get('display_category') == 'on') {?><span><?php _e('in', 'wpzoom'); ?> <?php the_category(', '); ?></span><?php } ?>
			<?php edit_post_link( __('Edit', 'wpzoom') ); ?>
		</ul>

		<div class="cleaner">&nbsp;</div>

 		<div class="postcontent">
			<?php if (option::get('display_content') == 'Full Content') {  the_content('<span>'.__('Read more', 'wpzoom').' &#8250;</span>'); } if (option::get('display_content') == 'Excerpt')  { the_excerpt(); } ?>
		</div>
		<div class="cleaner">&nbsp;</div>

	</div><!-- /.posts -->

<?php endwhile; ?>

<div class="cleaner">&nbsp;</div>
<?php get_template_part( 'pagination'); ?>
<?php wp_reset_query(); ?>
<div class="cleaner">&nbsp;</div>