<div id="heading">

	<div id="heading_wrap">
 
		<h2 class="section_title"><?php echo is_home() ? option::get('portfolio_title') : get_the_title(); ?></h2>

		<?php if (option::get('portfolio_tags') == 'on') { ?>
			<p id="portfolio-tags" class="iso-sort" >
				<a class="all active" data-value="<?php echo is_home() ? ':nth-child(-n+6)' : '*'; ?>" href="#"><?php _e('All', 'wpzoom'); ?></a>
				<?php wp_list_categories(array('title_li' => '', 'hierarchical' => false, 'taxonomy' => 'skill-type', 'style' => 'custom', 'walker' => new Walker_Category_Filter())); ?>
			</p>
		<?php } ?>z
 
		<div class="clear"></div>
 
	</div>

</div>
<div class="clear"></div>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if ( is_home() ) {

	$ids = array();

	foreach ( get_categories( 'taxonomy=skill-type' ) as $category ) {
		$posts = get_posts( array(
			'post_type' => 'portfolio',
			'posts_per_page' => intval( option::get('portfolio_items') ) > 0 ? intval( option::get('portfolio_items') ) : 6,
			'tax_query' => array(
				array(
					'taxonomy' => 'skill-type',
					'field' => 'id',
					'terms' => $category->term_id
				)
			)
		) );

		foreach ( $posts as $post ) $ids[] = $post->ID;
	}

	$query = new WP_Query( array(
		'post_type' => 'portfolio',
		'posts_per_page' => -1,
		'ignore_sticky_posts' => 1,
		'post__in' => array_unique( $ids, SORT_NUMERIC ),
		'paged' => $paged
	) );

} else {

	$query = new WP_Query( array(
		'post_type' => 'portfolio',
		'posts_per_page' => 99,
		'paged' => $paged
	) );

	?><script type="text/javascript">
		var wpz_currPage = <?php echo $paged; ?>,
		    wpz_maxPages = <?php echo $query->max_num_pages; ?>,
		    wpz_pagingURL = '<?php the_permalink(); ?>page/';
	</script><?php

}
?>

<div id="portfolio">
	<ul id="portfolio-items" >
		<?php $count = 1; ?>
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
				  $terms = get_the_terms( get_the_ID(), 'skill-type' );  ?>
		<li data-id="id-<?php echo $count; ?>" class="<?php foreach ($terms as $term) { echo 'tag-' . strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" >


			 <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wpzoom'), get_the_title()); ?>">
				<?php get_the_image( array( 'size' => 'portfolio-thumb',  'width' => 300, 'height' => 200, 'link_to_post' => false ) ); ?>
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
		<?php endwhile; endif; ?>

		<?php wp_reset_query(); ?>
	</ul>

	<div class="clear"></div>
</div><!-- / #portfolio -->