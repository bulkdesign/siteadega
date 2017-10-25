<?php
/**
 * Highlight shortcode template
 */
?>

<span class="mkd-highlight" <?php fleur_mikado_inline_style($highlight_style); ?>>
	<?php echo esc_html($content); ?>
</span>