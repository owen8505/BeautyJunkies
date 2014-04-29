<?php 
	$overview = get_post_meta(get_the_ID(), 'wpzoom_portfolio_overview', true);
	$client = get_post_meta(get_the_ID(), 'wpzoom_portfolio_client', true);
	$services = get_post_meta(get_the_ID(), 'wpzoom_portfolio_services', true);
	$slides = get_post_meta(get_the_ID(), 'wpzoom_slider', true);
	$slider_size = get_post_meta(get_the_ID(), 'slider_size', true);
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="heading">

	<div id="heading_wrap">

 		<div class="single-nav">
			<?php
			$previous_post = get_previous_post();
			$next_post = get_next_post();
			?>
			<a href="<?php if ($previous_post) echo get_permalink($previous_post->ID); ?>" class="prev_project<?php if (!$previous_post) echo ' disabled'; ?>" title="<?php echo option::get('prev_project'); ?>"></a>
			<a href="<?php if ($next_post) echo get_permalink($next_post->ID); ?>" class="next_project<?php if (!$next_post) echo ' disabled'; ?>" title="<?php echo option::get('next_project'); ?>"></a>
		</div>

		<h2><?php the_title(); ?></h2>
 
		<div class="clear"></div>

	</div>

</div><!-- /#welcome -->

<div id="content">
	<div class="post_content">

 		<?php if ($slider_size == 'Full-width') { ?>

			<?php if (count($slides) > 1) { ?>
			
			<div id="portfolio-slider">
				<ul class="slides">
				 
					<?php  
						foreach ( $slides as $slide ) {
							unset($image, $height, $caption);

							if ( is_numeric($slide['imageId']) ) {
								$image = wp_get_attachment_image_src($slide['imageId'], 'portfolio-slide');
								$height = $image[2];
								$image = $image[0];
							} else {
								$image = $slide['imageId'];
								$height = false !== ( $size = @getimagesize($image) ) ? $size[1] : 600;
								unset($size);
							}
							$caption = trim($slide['caption']);

							echo '<li><img src="' . $image . '" width="960" height="' . $height . '"/>';
							if ( !empty($caption) ) echo '<p class="caption">' . esc_html($caption) . '</p>';
							echo '</li>';
						}
					?>
						 
				</ul>

			</div><!-- /#portfolio-slider -->
			<div class="clear"></div>
	 

			<?php } ?>
		<?php } ?>
		
		<div class="aside">
			<?php if ($overview) { echo nl2br($overview); } ?>
						
			<?php if ($client) { ?>
				<h4><?php echo option::get('client'); ?></h4>
				<p><?php echo $client; ?></p>
			<?php } ?>
			
			<?php if ($services) { ?>
				<h4><?php echo option::get('services'); ?></h4>
				<p><?php echo nl2br($services); ?> </p>
			<?php } ?>
			
			<?php $tax_menu_items = get_the_terms( get_the_ID(), 'skill-type' );
				if ($tax_menu_items ) { ?>
				
				<h4><?php echo option::get('skills'); ?></h4>
				
				<?php			
					foreach ( $tax_menu_items as $tax_menu_item ): ?>
					<a href="<?php echo get_term_link($tax_menu_item,$tax_menu_item->taxonomy); ?>">
						<?php echo $tax_menu_item->name; ?>
					</a><br />
				<?php endforeach; 
			} ?>
				
		</div><!-- /.aside-->

		
		<div class="entry">

			<?php if ($slider_size == 'Main Column') { ?>

				<?php if (count($slides) > 1) { ?>
				
				<div id="portfolio-slider">
					<ul class="slides">
					 
						<?php  
							foreach ( $slides as $slide ) {
								unset($image, $height, $caption);

								if ( is_numeric($slide['imageId']) ) {
									$image = wp_get_attachment_image_src($slide['imageId'], 'portfolio-slide-small');
									$height = $image[2];
									$image = $image[0];
								} else {
									$image = $slide['imageId'];
									$height = false !== ( $size = @getimagesize($image) ) ? $size[1] : 450;
									unset($size);
								}
								$caption = trim($slide['caption']);

								echo '<li><img src="' . $image . '" width="680" height="' . $height . '"/>';
								if ( !empty($caption) ) echo '<p class="caption">' . esc_html($caption) . '</p>';
								echo '</li>';
							}
						?>
							 
					</ul>

				</div><!-- /#portfolio-slider -->
				<div class="clear"></div>
		 

				<?php } ?>
			<?php } ?>


			<?php the_content(); ?>
			
			<?php edit_post_link( __('Edit', 'wpzoom'), '', ''); ?>
		 
		</div><!-- /.entry -->

  
	</div><!-- /.post_content -->

	 
	<div class="clear"></div>
 
	<?php
	$skills=array();foreach(get_the_terms(get_the_ID(),'skill-type')as$skill){$skills[]=$skill->term_id;}
	if ( !empty($skills) ) {
		$query = new WP_Query();
		$query->query( array(
			'post_type' => 'portfolio',
			'tax_query' => array(
				array(
					'taxonomy' => 'skill-type',
					'field' => 'id',
					'terms' => $skills
				)
			),
			'posts_per_page' => 3,
			'post__not_in' => array(get_the_ID())
		) );
		if ( $query->have_posts() ) {
			?><div id="similar-projects">
				<h3><?php echo option::get('similar_projects'); ?></h3>

				<ul>
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wpzoom'), get_the_title()); ?>">
								<?php get_the_image( array( 'size' => 'similar-thumb',  'width' => 200, 'link_to_post' => false ) ); ?>
							</a>

							<div class="meta">
								<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wpzoom'), get_the_title()); ?>">  <?php the_title(); ?></a></h3>
								<?php
								$terms = get_the_terms( get_the_ID(), 'skill-type' );
								if ( is_array($terms) && !empty($terms) ) {
									$terms2=array();foreach($terms as$term){$terms2[]=$term->name;}
									echo implode(', ', $terms2);
								}
								?>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
				<div class="clear"></div>
			</div><?php
		}
	}
	?>
</div>

<?php endwhile; endif; ?>
            
<?php get_footer(); ?>