<?php if ($flip_on_hover !== 'yes') { ?>
	<div <?php fleur_mikado_class_attribute($item_classes); ?> <?php fleur_mikado_inline_style($bckg_styles); ?> >
	    <?php echo do_shortcode($content); ?>
	</div>
<?php } else  { ?>
	<div <?php fleur_mikado_class_attribute($item_classes); ?>>
		<?php if ($link != '') { ?>
			<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
		<?php } ?>
		<div class="mkd-box-item-front" <?php fleur_mikado_inline_style($bckg_styles); ?> >
	    	<?php echo do_shortcode($content); ?>
	    </div>
		<div class="mkd-box-item-back" <?php fleur_mikado_inline_style($item_back_side_styles); ?> ></div>
	</div>
<?php } ?>