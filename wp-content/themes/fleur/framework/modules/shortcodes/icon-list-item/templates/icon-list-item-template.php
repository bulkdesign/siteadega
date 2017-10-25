<div <?php fleur_mikado_inline_style($holder_styles); ?> <?php fleur_mikado_class_attribute($holder_classes); ?>>
	<div class="mkd-icon-list-icon-holder">
		<div class="mkd-icon-list-icon-holder-inner clearfix">
			<?php echo fleur_mikado_icon_collections()->renderIcon($icon, $icon_pack, $params);
			?>
		</div>
	</div>
	<p class="mkd-icon-list-text" <?php echo fleur_mikado_get_inline_style($title_style) ?> > <?php echo esc_attr($title) ?></p>
</div>