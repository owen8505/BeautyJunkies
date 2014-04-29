<?php get_header(); ?>

<?php
$taxonomy_obj = $wp_query->get_queried_object();
$taxonomy_nice_name = $taxonomy_obj->name;

if (have_posts()) : ?>

<div id="heading">

	<div id="heading_wrap">

		<h2 class="section_title"><?php echo $taxonomy_nice_name; ?></h2>

 	 
		<?php if (option::get('portfolio_tags') == 'on') { ?>
			<p id="portfolio-tags" >
				<a class="all" data-value="*" href="<?php echo get_page_link(option::get('portfolio_url')); ?>"><?php _e('All', 'wpzoom'); ?></a>
				<?php wp_list_categories(array('title_li' => '', 'hierarchical' => false, 'taxonomy' => 'skill-type', 'style' => 'custom', 'current_category' => $taxonomy_obj->term_id, 'walker' => new Walker_Category_Filter())); ?>
			</p>
		<?php } ?>

 
 		<div class="clear"></div>

	</div>

</div>

<?php
$query = new WP_Query();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page = get_option('posts_per_page');
$query->query( array(
	'post_type' => 'portfolio',
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	'tax_query' => array(
		array(
			'taxonomy' => 'skill-type',
			'field' => 'id',
			'terms' => $taxonomy_obj->term_id
		)
	)
) );
?>
<script type="text/javascript">
	var wpz_currPage = <?php echo $paged; ?>,
			wpz_maxPages = <?php echo $query->max_num_pages; ?>,
			wpz_pagingURL = '<?php global $wp; echo trailingslashit( home_url( add_query_arg( array(), $wp->request ) ) ); ?>page/';
</script>

<div id="portfolio">
	<ul id="portfolio-items" >
		<?php $count = 1;
		while ( $query->have_posts() ) : $query->the_post();
			$terms = get_the_terms( get_the_ID(), 'skill-type' ); ?>
		<li data-id="id-<?php echo $count; ?>" class="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" >

			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wpzoom'), get_the_title()); ?>">
				<?php get_the_image( array( 'size' => 'portfolio-thumb',  'width' => 300, 'height' => 200, 'link_to_post' => false  ) ); ?>
			</a>

			<div class="meta">
				<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'wpzoom'), get_the_title()); ?>">  <?php the_title(); ?></a></h3>
 			</div>
		</li>
		<?php $count++; ?>
		<?php endwhile; endif; ?>
 		<div class="clear"></div>
	</ul>

	<?php wp_reset_query(); ?>

</div><!-- / #portfolio -->

<div class="clear"></div>

<?php get_footer(); ?>