<?php // Deze regels niet verwijderen
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { // and it doesn't match the cookie
	?>
	<h2><?php _e('Wachtwoord beveiligd'); ?></h2>
	<p><?php _e('Geef wachtwoord om reacties te zien.'); ?></p>

	<?php return;
	}
}
/* Deze variable is om de comment achtergrond 'alt' aan te passen */
$oddcomment = 'alt';
?>
<!-- Hier kun je aanpassen. -->
<?php if ($comments) : ?>
<h3 id="comments"><?php comments_number('Geen reacties', 'E&eacute;n reactie', '% reacties' );?> op "<?php the_title(); ?>"</h3>
<ol class="commentlist">
<?php foreach ($comments as $comment) : ?>

<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>" style="padding:0;">
<div class="commentmetadata">
<strong><?php comment_author_link() ?></strong> schreef op <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('jS F Y') ?> <?php _e('om');?> <?php comment_time() ?></a> <?php edit_comment_link('Wijzig reactie',' ',' '); ?>

<?php if ($comment->comment_approved == '0') : ?>
<em><?php _e('Uw reactie wordt gecontroleerd.'); ?></em>
<?php endif; ?>
</div><div style="border-bottom:1px solid #fff;"></div>
<div style="padding:10px;"><?php comment_text() ?></div>

</li>
<?php /* Verandert iedere oneven reactie in een verschillende class */
if ('alt' == $oddcomment) $oddcomment = ' ';
else $oddcomment = 'alt';
?>
<?php endforeach; /* end for each comment */ ?>
</ol>
<?php else : // geen reacties geeft dit weer ?>
<?php if ('open' == $post->comment_status) : ?>
<!-- Als er geen berichten zijn maar wel kunnen gegeven worden. -->
<?php else : // comments are closed ?>

<!-- Als reacties geven gesloten is. -->
<p class="nocomments">Reageren niet mogelijk.</p>
<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<h3 id="respond">Laat een bericht achter</h3><br />

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>Je moet zijn <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">ingelogd</a> om te reageren.</p>

<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php if ( $user_ID ) : ?>
	<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout »</a></p>

	<?php else : ?>
	<p>
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="40" tabindex="1" style="font-family:tahoma,sans-serif;" />
		<label for="author"><small>Naam <?php if ($req) echo "(verplicht)"; ?></small></label>
	</p>
	<p>
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" style="font-family:tahoma,sans-serif;" />
		<label for="email"><small>Email adres (wordt niet getoond) <?php if ($req) echo "(verplicht)"; ?></small></label>
	</p>
	<p>
		<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="40" tabindex="3" style="font-family:tahoma,sans-serif;" />
		<label for="url"><small>Eigen website</small></label>
	</p>
	<?php endif; ?>
	<?php /*<p><small>Toegestane <strong>XHTML</strong>: <?php echo allowed_tags(); ?></small></p>*/ ?>
	<p>
		<textarea name="comment" id="comment" cols="60" rows="4" tabindex="4" style="font-family:tahoma,sans-serif;"></textarea>
	</p><br />
	
	<p><input name="submit" type="submit" id="submit" tabindex="5" value="Plaats bericht" style="font-family:tahoma,sans-serif;" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	</p><br />
	<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // Als registreren verplicht is ?>

<?php endif; // Niet verwijderen!! ?>
