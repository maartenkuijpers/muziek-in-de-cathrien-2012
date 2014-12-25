<?php
/*
 * Template Name: Aankomend Concert template
 *
 * This page loads the url from the first Google Calendar event in the future
 * and forwards to this page.
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

	<div id="footerPage">
	Toegevoegd op <?php the_date(); ?> om <?php the_time(); ?> door <?php the_author_meta(first_name) ?>.
	</div>

	<script type="text/javascript">
    var googleCalendarV3 = getGoogleCalendarApiV3Url(1, 1);
    var newLocation = '?page_id=14';

	$.getJSON(googleCalendarV3, function (json) {
		if (typeof json.items !== "undefined") {
			$.each(json.items, function (i, event) {
				if (event.location !== "") {
					newLocation = event.location;
				}
			});
		}
		window.location = newLocation; // Required here when a location is available.
	});
    </script>
</div>

<?php get_footer(); ?>