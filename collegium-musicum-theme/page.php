<?php get_header(); ?>
<div id="content">
	<?php
	if (get_post_meta($post->ID, 'ToonAgenda', true) == "")
	{ echo('<script type="text/javascript">document.getElementById("content").style.marginRight="0px";</script>'); }
	?>

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

	<div id="footerPage">
	Toegevoegd op <?php the_date(); ?> om <?php the_time(); ?> door <?php the_author_meta(first_name) ?>.
	</div>
</div>
<?php get_footer(); ?>
