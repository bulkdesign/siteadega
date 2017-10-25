<button type="submit" <?php fleur_mikado_inline_style($button_styles); ?> <?php fleur_mikado_class_attribute($button_classes); ?> <?php echo fleur_mikado_get_inline_attrs($button_data); ?> <?php echo fleur_mikado_get_inline_attrs($button_custom_attrs); ?>>
	<span class="mkd-btn-text"><?php echo esc_html($text); ?></span>

	<?php if($show_icon) : ?>
		<span class="mkd-btn-icon-holder">
			<?php echo fleur_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
				'icon_attributes' => array(
					'class' => 'mkd-btn-icon-elem'
				)
			)); ?>
		</span>
	<?php endif; ?>

	<?php if($display_helper) : ?>
		<span class="mkd-btn-helper" <?php fleur_mikado_inline_style($helper_styles); ?>></span>
	<?php endif; ?>

</button>