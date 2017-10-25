<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="mkd-blockquote-shortcode" <?php fleur_mikado_inline_style($blockquote_style); ?> >
	<div class="mkd-blockquote-icon"></div>
	<h4 class="mkd-blockquote-text">
		<span><?php echo esc_attr($text); ?></span>
	</h4>
</blockquote>