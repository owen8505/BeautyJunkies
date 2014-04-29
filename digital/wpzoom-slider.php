<div id="heading">
	<h2><?php echo option::get('slideshow_title'); ?></h2>

	<div id="slider">
		<ul class="slides">
	 
			<?php $loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => option::get('featured_posts_posts'), 'meta_key' => 'wpzoom_is_featured', 'meta_value' => 1 ) ); ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>

				<li>
					<div class="image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php get_the_image( array( 'size' => 'featured',  'width' => 630, 'height' => 370, 'link_to_post' => false ) ); ?>
						</a>
					</div>

					<div class="content">
						<h3><?php printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute('echo=0'), get_the_title() ); ?></h3>
						<p class="category"><?php echo get_the_term_list( get_the_ID(), 'skill-type', '', ' / ', '' ); ?></p>
						<?php the_excerpt(); ?>
					</div>

					<br class="clear" />
				</li>
			<?php endwhile; ?>
			 
		</ul>

	</div>
</div>

<?php wp_reset_query(); ?>