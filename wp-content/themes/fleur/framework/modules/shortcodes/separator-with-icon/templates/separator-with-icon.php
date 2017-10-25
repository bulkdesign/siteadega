<div <?php fleur_mikado_class_attribute($separator_class); ?> <?php fleur_mikado_inline_style($separator_holder_style); ?>>

	<span class="mkd-separator-left" <?php echo fleur_mikado_get_inline_style($separator_style); ?>></span>
	<?php if ($icon_pack) { ?>
		<div class="mkd-icon-holder">
			<?php echo fleur_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?>
		</div>
	<?php } else { ?>
		<div class="mkd-default-icon-holder" <?php echo fleur_mikado_get_inline_style($separator_style); ?>></div>
	<?php } ?>
	<span class="mkd-separator-right" <?php echo fleur_mikado_get_inline_style($separator_style); ?>></span>
</div>