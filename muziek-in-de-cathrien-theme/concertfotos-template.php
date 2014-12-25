<?php
/*
 * Template Name: Concertfoto's template
 *
 * This page lists all pages having the "ConcertFotos" extra field in chronological order (newest first).
 */
?>
<?php get_header(); ?>
<div id="content">
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php endwhile; ?>
		<?php else : ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			Not Found
		</div>
	<?php endif; ?>

<?php
	// Reset Post Data
	wp_reset_postdata();

	$array = get_pages(array('sort_column' => 'menu_order', 'sort_order' => 'asc' ));
	foreach($array as $pages) {
		$current_page = get_page($pages);
		if (get_post_meta($current_page->ID, 'ConcertFotos', true))
			echo '<div class="entry"><a href="' . get_page_link($current_page->ID) . '"><h3>' . $current_page->post_title . '</h3></a></div><hr>';
	}
?>

</div>

<?php get_footer(); ?>
