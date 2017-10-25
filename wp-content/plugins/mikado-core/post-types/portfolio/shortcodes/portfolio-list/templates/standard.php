<?php // This line is needed for mixItUp gutter ?>
	<article class="mkd-portfolio-item mix <?php echo esc_attr($categories) ?>">
		<div class="mkd-ptf-item-image-holder">
			<div class="mkd-ptf-item-hover-holder">
				<a href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_target); ?>">
					<?php if ($use_custom_image_size && (is_array($custom_image_sizes) && count($custom_image_sizes))) : ?>
						<?php echo fleur_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_image_sizes[0], $custom_image_sizes[1]); ?>
					<?php else: ?>
						<?php the_post_thumbnail($thumb_size); ?>
					<?php endif; ?>
					<span class="mkd-ptf-portfolio-overlay-bg"></span>
				</a>

				<?php if ($is_external){ ?>
				<a class="mkd-ptf-portfolio-overlay-icon" href="<?php echo esc_url($item_link); ?>"
				   target="<?php echo esc_attr($item_target); ?>">
					<?php }else{ ?>
					<a class="mkd-ptf-portfolio-overlay-icon"
					   href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"
					   data-rel="prettyPhoto[portfolio-standard]">
						<?php } ?>
						<?php echo fleur_mikado_icon_collections()->renderIcon('lnr-magnifier', 'linear_icons'); ?>
					</a>
			</div>
		</div>
		<div class="mkd-ptf-item-text-holder">
			<div class="mkd-ptf-item-text-holder-inner">
				<<?php echo esc_attr($title_tag) ?> class="mkd-ptf-item-title">
				<a href="<?php echo esc_url($item_link); ?>">
					<?php echo esc_attr(get_the_title()); ?>
				</a>
			</<?php echo esc_attr($title_tag) ?>>
		</div>
		</div>
	</article>
<?php // This line is needed for mixItUp gutter ?>