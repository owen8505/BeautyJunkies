<?php
/*
Template Name: Categorias Home
*/
?>

<?php get_header(); ?>

<?php $categoria = $_REQUEST['categoria']; 
$titulo = ucfirst($categoria);
?>

<div id="category-home-content">

<div id="heading">
	<div id="heading_wrap"> 		
		<h2 class="section_title"><?php echo $titulo; //the_title(); ?></h2>
		<?php
			$id = get_cat_ID($categoria);
		 ?>
			<!--p id="portfolio-tags" class="iso-sort" >
				<a class="all active" data-value="*" href="#"><?php _e('All', 'wpzoom'); ?></a>
				<?php wp_list_categories(array('title_li' => '', 'hierarchical' => false, 'taxonomy' => 'category', 'child_of' => $id, 'style' => 'custom', 'walker' => new Walker_Category_Filter())); ?>
			</p-->
		<div class="clear"></div>
 
	</div>
</div>
<br/>

<div id="recentposts">

<?php

	$query = new WP_Query('category_name='.$categoria);
	//$query->query( 'posts_per_page=' . option::get('recent_posts_items') );
	if ($query->have_posts()) : ?>

 
	<ul id="category-items">

		<?php while ($query->have_posts()) : $query->the_post(); ?>
			<?php $terms = get_the_terms( get_the_ID(), 'category' );?>
			<li class="<?php foreach ($terms as $term) { echo 'tag-' . strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>">

				<?php if (option::get('index_thumb') == 'on') {

					get_the_image( array( 'size' => 'portfolio-thumb', 'width' => 300, 'height' => 200, 'before' => '<div class="post-thumb">', 'after' => '</div>' ) );

				} ?>

				<div class="postcontent">

					<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

					<div class="meta">
						<p class="text"><?php echo get_the_excerpt(); ?></p>
						<br/>
						<p class="readmore"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> > > > READ MORE</a></p>
						<p class="category">&#8226;<?php if (option::get('recent_posts_category') == 'on') {?> <?php the_category(', '); ?><?php } ?>&#8226;</p>

					</div>
				</div>

			</li>

		<?php endwhile; ?>

	</ul>

	<?php endif; wp_reset_query(); ?>

<div class="clear"></div>
</div>

<?php get_footer(); ?>