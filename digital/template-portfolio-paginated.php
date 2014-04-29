<?php
/*
Template Name: Portfolio (paginated)
*/
?>

<?php get_header(); ?>


<div id="heading">

	<div id="heading_wrap">
 
		<h2 class="section_title"><?php the_title(); ?></h2>
  
 		<?php if (option::get('portfolio_tags') == 'on') { ?>
			<p id="portfolio-tags" >
				<a class="all" data-value="*" href="<?php echo get_page_link(option::get('portfolio_url')); ?>"><?php _e('All', 'wpzoom'); ?></a>
				<?php wp_list_categories(array('title_li' => '', 'hierarchical' => false, 'taxonomy' => 'skill-type', 'style' => 'custom', 'current_category' => $taxonomy_obj->term_id, 'walker' => new Walker_Category_Filter())); ?>
			</p>
		<?php } ?>
  
		<div class="clear"></div>
 
	</div>
</div>
<div class="clear"></div>

<div id="portfolio">

	<?php
			global $wp_query;
			global $paged;

			wp_reset_query();
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$posts_per_page = intval(option::get('paginated_posts')) > 0 ? intval(option::get('paginated_posts')) : 12;


			$args = array(
				'post_type' => 'portfolio',
				'paged' => $paged,
				'posts_per_page' => $posts_per_page,
				);

			$wp_query = new WP_Query($args);
		?>

			<script type="text/javascript">
			var wpz_currPage = <?php echo $paged; ?>,
			    wpz_maxPages = <?php echo $wp_query->max_num_pages; ?>,
			    wpz_pagingURL = '<?php the_permalink(); ?>page/';
		</script>



	<ul id="portfolio-items" >

		 
		<?php

			while ( $wp_query->have_posts() ) : $wp_query->the_post();  $count = 1; $count++;

			$terms = get_the_terms( get_the_ID(), 'skill-type' );  ?>

		<li data-id="id-<?php echo $count; ?>" class="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" >

			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wpzoom'), get_the_title()); ?>">

				<?php get_the_image( array( 'size' => 'portfolio-thumb',  'width' => 300, 'height' => 200, 'link_to_post' => false  ) ); ?>

				<span class="ext">
					<span class="p"><?php echo option::get('portfolio_project_title'); ?></span>
				</span>
			</a>

			<div class="meta">
				<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wpzoom'), get_the_title()); ?>">  <?php the_title(); ?></a></h3>
				<?php
					if (is_array($terms)) {
						$count = count($terms);
						$i = 0;
						foreach ($terms as $term) {
							$i++;
							echo $term->name;
							if ($i < $count) {echo ', '; }
						}
					}

				?>
			</div>
		</li>
		<?php $count++; ?>
		<?php endwhile; ?>

 		<div class="clear"></div>
		 
	</ul>

	<?php get_template_part( 'pagination'); ?>
	<?php wp_reset_query(); ?>
		
</div><!-- / #portfolio -->

<div class="clear"></div>

<?php get_footer(); ?>