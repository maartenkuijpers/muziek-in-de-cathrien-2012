<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header(); ?>
<div id="content" role="main">

<?php
	$posts=query_posts($query_string . '&posts_per_page=10');
	if (have_posts())
	{
		?>
		<h1>Zoekresultaten voor "<?php echo $s; ?>"</h1>
		<?php while (have_posts()) : the_post(); ?>
		<div class="entry">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Toon bericht: <?php the_title_attribute(); ?>">
				<strong><?php the_title(); ?></strong> (<?php echo(the_date(get_option('date_format'))); ?>) <?php the_excerpt(); ?>
			</a>
		</div>
		<?php
		endwhile;
	}
	else
	{
		echo '<h1>Geen resultaat</h1>';
		echo 'Geen berichten gevonden waarin "' . $s . '" voorkomt.';
	}
	?>
	<div class="alignleft"><?php next_posts_link('&laquo; oudere berichten'); ?></div>
	<div class="alignright"><?php previous_posts_link('nieuwere berichten &raquo;'); ?></div>
</div>

<?php get_footer(); ?>
