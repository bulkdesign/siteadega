<div class="mkd-elements-holder-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo fleur_mikado_get_inline_attrs($elements_holder_item_data); ?> <?php echo fleur_mikado_get_inline_style($elements_holder_item_style); ?>>
	<div <?php fleur_mikado_class_attribute($element_holder_item_inner_classes);?> <?php fleur_mikado_inline_style($element_holder_item_inner_style)?>>
		<div class="mkd-elements-holder-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo fleur_mikado_get_inline_style($elements_holder_item_content_style); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>