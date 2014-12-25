<?php
/*
 * Template Name: Categories template
 *
 * This page lists a summary of all posts from the past 7 days. Including a clickable link to the post.
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

<h2>Ensembles</h2>
<?php
$args = array('category_name' => 'ensembles', 'posts_per_page' => -1 );
$query = new WP_Query($args);
if ($query->have_posts()) :
	// The Loop
	while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="entry"><a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a></div>
	<?php endwhile;
else : echo 'Nog geen informatie beschikbaar.';
endif; ?>
<hr>

<h2>Koren</h2>
<?php
$args = array('category_name' => 'koren', 'posts_per_page' => -1 );
$query = new WP_Query($args);
if ($query->have_posts()) :
	// The Loop
	while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="entry"><a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a></div>
	<?php endwhile;
else : echo 'Nog geen informatie beschikbaar.';
endif; ?>
<hr>


<h2>Organisten</h2>
<?php
$args = array('category_name' => 'organisten', 'posts_per_page' => -1 );
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
