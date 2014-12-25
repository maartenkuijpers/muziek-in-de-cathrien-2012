<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0? href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92? href="<?php bloginfo('rss_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3? href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php wp_head(); ?>

<link href="<?php echo get_stylesheet_directory_uri() ?>/styles/reset.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo get_stylesheet_directory_uri() ?>/styles/3c.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo get_stylesheet_directory_uri() ?>/styles/site.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo get_stylesheet_directory_uri() ?>/styles/agenda.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo get_stylesheet_directory_uri() ?>/styles/posts.css" rel="stylesheet" type="text/css" media="screen" />
<!-- -------------------------------------------------------------------------->
<!-- jQuery 1.7.2 and 1.8.21 custom [Accordion] http://jqueryui.com/download -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/slides.min.jquery.js"></script>
<script type="text/javascript">
	$(function () {

		// Accordion
		$("#accordion").accordion({ header: "h3", autoHeight: false, active: false, collapsible:true });

		// Slides jQuery image slider [Standard] http://slidesjs.com/
		$('#slides').slides({
			crossfade: true,
			pagination: true,
			preload: true,
			preloadImage: '<?php echo get_stylesheet_directory_uri() ?>/images/slides/control/loading.gif',
			play: 5000,
			pause: 2500,
			hoverPause: true
		});

	});
</script>
<link href="<?php echo get_stylesheet_directory_uri() ?>/styles/accordion.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_stylesheet_directory_uri() ?>/styles/slides.css" rel="stylesheet" type="text/css" />
<!-- -------------------------------------------------------------------------->
<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38491315-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- -------------------------------------------------------------------------->
<!-- Google Calendar -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/google-calendar.js"></script>
<!-- -------------------------------------------------------------------------->
</head>
<!-- -------------------------------------------------------------------------->
<body>
	<div id="fixed">
		<div id="container">
			<div id="header">
				<?php get_header("page"); ?>
			</div>
			<div id="body">
				<div id="left-sidebar">
					<?php get_sidebar("navigation"); ?>
				</div>
				<?php if (get_post_meta($post->ID, 'ToonAgenda', true) || is_single()) { ?>
					<div id="right-sidebar">
					<?php get_sidebar("agenda"); ?>
					</div>
				<?php } ?>
