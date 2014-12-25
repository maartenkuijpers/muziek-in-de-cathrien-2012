<?php
/*
 * Template Name: Links template
 *
 * This page lists all page links with description, per categorie.
 */
?>
<?php get_header(); ?>
<div id="content">
<h1><?php the_title(); ?></h1>

<?php

$args = array(
    'class' => 'h3',
    'category_before' => '',
    'category_after' => ''
);

wp_list_bookmarks($args);

?>

</div>

<?php get_footer(); ?>
