<div id="recentposts">
	<!--h2 class="section_title">
		<?php
			if (is_home()) {
				if (option::get('recent_posts_title') != '') {
					echo option::get('recent_posts_title'); 
	 			} else {
			 		echo __('Recent Posts', 'wpzoom');
				}
			}
		?>
	</h2-->

	<div class="clear"></div>

	<?php

	$query = new WP_Query();
	$query->query( 'posts_per_page=' . option::get('recent_posts_items') );
	if ($query->have_posts()) : ?>

 
	<ul>

		<?php while ($query->have_posts()) : $query->the_post(); ?>

			<li>

				<?php if (option::get('index_thumb') == 'on') {

					get_the_image( array( 'size' => 'portfolio-thumb', 'width' => 300, 'height' => 200, 'before' => '<div class="post-thumb">', 'after' => '</div>' ) );

				} ?>

				<div class="postcontent">

					<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

					<div class="meta">
						<?php echo substr(get_the_content(), 0, 100)."..."; ?>
						<p><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">>>> READ MORE</a></p>
						<!--div class="categorias"><?php if (option::get('recent_posts_category') == 'on') {?><span><?php the_category(', '); ?></span><?php } ?></div-->

					</div>
				</div>

			</li>

		<?php endwhile; ?>

	</ul>

	<?php endif; wp_reset_query(); ?>

	<div class="clear"></div>
</div>