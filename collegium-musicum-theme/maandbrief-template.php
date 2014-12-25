<?php
/*
 * Template Name: Maandbrief template
 *
 * This page lists all "Maandbrief" pages in chronological order (newest first).
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
$args = array('category_name' => 'maandbrief', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' );
$query = new WP_Query($args);
if ($query->have_posts()) :
	// The Loop
	while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="entry"><a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a></div>
	<?php endwhile;
else : echo 'Nog geen informatie beschikbaar.';
endif; ?>
<hr>

<?php 
// Reset Post Data
wp_reset_postdata();?>

</div>

<?php get_footer(); ?>
