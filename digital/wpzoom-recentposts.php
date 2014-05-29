<div id="recentposts">
	<?php

	$query = new WP_Query();

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	//$query->query( 'posts_per_page=' . option::get('recent_posts_items') );
	$query->query( 'posts_per_page=10&paged=' . $paged); 
	if ($query->have_posts()) : ?>

	<script type="text/javascript">
		var wpz_currPage = <?php echo $paged; ?>,
		    wpz_maxPages = <?php echo $wp_query->max_num_pages; ?>,
		    wpz_pagingURL = '<?php the_permalink(); ?>page/';
	</script>
 
	<ul>

		<?php while ($query->have_posts()) : $query->the_post(); ?>

			<li>

				<?php if (option::get('index_thumb') == 'on') {

					get_the_image( array( 'size' => 'portfolio-thumb', 'before' => '<div class="post-thumb">', 'after' => '</div>' ) );

				} ?>

				<div class="postcontent">

					<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

					<div class="meta">
                    	 <p>                         
							<?php echo get_the_excerpt(); ?>
                      </p>										
                      <p class="readmore"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> > > > READ MORE</a></p>
						<p class="category">&#8226;<?php if (option::get('recent_posts_category') == 'on') {?> <?php the_category(', '); ?><?php } ?>&#8226;</p>
					</div>
				</div>

			</li>

		<?php endwhile; ?>

	</ul>
	<?php get_template_part( 'pagination'); ?>
	<?php endif; wp_reset_query(); ?>

	<div class="clear"></div>
</div>