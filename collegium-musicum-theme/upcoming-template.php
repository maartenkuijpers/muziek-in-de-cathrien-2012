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
$(document).ready(function () {
	$.getJSON("https://www.google.com/calendar/feeds/0ufavfijfqbprcv6vgrs1qgatc%40group.calendar.google.com/public/full?alt=json-in-script&callback=?&orderby=starttime&max-results=1&singleevents=true&sortorder=ascending&futureevents=true", function (json) {
		if (typeof json.feed.entry !== "undefined") {
			$.each(json.feed.entry, function (i, event) {
				if (event.gd$where[0].valueString != "") {
					window.location = event.gd$where[0].valueString;
				}
			});
		}
		else
			document.write('<p>Geen concerten gepland.</p>');
	});
});
</script>

</div>
<?php get_footer(); ?>