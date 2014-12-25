<?php
/*
 * Template Name: Nieuws template
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

<?php
 $postslist = get_posts('numberposts=5&order=DESC&orderby=date');
 foreach ($postslist as $post) :
    setup_postdata($post);
 ?>
 <div class="entry">
	 <a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>&nbsp;
	 <?php the_excerpt(); ?><?/* (<?php the_time(get_option('date_format')) ?>)*/?>
 </div>
 <?php endforeach; ?>

</div>
<?php get_footer(); ?>
