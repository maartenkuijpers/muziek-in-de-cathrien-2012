<div id="search">
	<form action="#">
	<input id="s"type="text" name="s" class="rounded" value="Zoeken &gt;&gt;" onclick="value=''" />
	</form>
</div><!-- ACCORDION MENU - begin -->
<div id="accordion">
<?php
	$array = get_pages(array('sort_column' => 'menu_order', 'sort_order' => 'asc' ));

	$previous_depth = get_current_page_depth;
	echo '<div>';
	foreach($array as $pages) {
		$current_page = get_page($pages);
		if (($current_page->post_status != "publish") || (get_post_meta($current_page->ID, 'NietInMenu', true) != "") ||
			(get_post_meta($current_page->ID, 'lang-' . the_curlang(), true) != null)) {
			continue;
		}

		$depth = get_page_depth($current_page);
		if ($depth == 0) {
			// main menu
			echo '</div>';
			if ($current_page->ID == $post->post_parent) {
				echo '<h3 id=post' . $post->post_parent . '>';
				// BEGIN Following javascript section will open the h3 matching the current post parent.
				echo '<script type="text/javascript">';
				echo '$(function() {';
				echo '$("#accordion").accordion("activate", "h3#post' . $post->post_parent . '")';
				echo '})';
				echo '</script>';
				// END
			} else {
				echo '<h3>';
			}
			echo $current_page->post_title . '</h3>';
			echo '<div class="content">';
		}
		if ($depth == 1) {
			echo '<a href="' . get_page_link($current_page->ID) . '">' . $current_page->post_title . '</a>';
		}
	}
	echo '</div>';
?>
</div>
<div class="rounded">
    <a href="http://www.stadskerksintcathrien.nl/Donateurs.htm">Word Donateur!</a>
</div>
<a href="/collegium-eindhoven/anbi/"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/logos/DaarGeefJeOm-Muziek_152px.png"></a>
