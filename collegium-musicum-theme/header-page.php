<a href="<?php echo home_url(); ?>"><img class="site_logo" src="<?php echo get_stylesheet_directory_uri() ?>/images/logos/CME.png" alt="Collegium Musicum Eindhoven" /></a>
<img class="site_photo" src="<?php echo get_stylesheet_directory_uri() ?>/images/header_cathrien.jpg" alt="Stadskerk St. Cathrien" />

<?php
global $wp_query;
$current_page = get_page($wp_query->get_queried_object());
$css_dir = get_stylesheet_directory_uri();

$translation_id = get_page_translated_id('de_DE');
if ($translation_id != "")
    echo '<a href="' . get_permalink($translation_id) . '"><img class="flag" src="' . $css_dir . '/images/flagDE.png" title="Diese Seite in deutscher Sprache" alt="Deutsch" /></a>';
else
    echo '<img class="flag" src="' . $css_dir . '/images/flagDE_disabled.png" title="Es gibt keine deutsche &Uuml;bersetzung dieser Seite" />';

$translation_id = get_page_translated_id('fr_FR');
if ($translation_id != "")
    echo '<a href="' . get_permalink($translation_id) . '"><img class="flag" src="' . $css_dir . '/images/flagFR.png" title="Cette page en fran&ccedil;ais" alt="Fran&ccedil;ais" /></a>';
else
    echo '<img class="flag" src="' . $css_dir . '/images/flagFR_disabled.png" title="Il n\'existe pas de traduction fran&ccedil;aise de cette page" />';

$translation_id = get_page_translated_id('en_GB');
if ($translation_id != "")
    echo '<a href="' . get_permalink($translation_id) . '"><img class="flag" src="' . $css_dir . '/images/flagGB.png" title="This page in English" alt="English" /></a>';
else
    echo '<img class="flag" src="' . $css_dir . '/images/flagGB_disabled.png" title="There is no English translation of this page" />';


$translation_id = get_page_translated_id('nl_NL');
if ($translation_id != "")
    echo '<a href="' . get_permalink($translation_id) . '"><img class="flag" src="' . $css_dir . '/images/flagNL.png" title="Deze pagina in het Nederlands" alt="Nederlands" /></a>';
else
    echo '<img class="flag" src="' . $css_dir . '/images/flagNL_disabled.png" title="Er bestaat nog geen Nederlandse vertaling van deze pagina" />';
?>