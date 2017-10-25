<?php // This line is needed for mixItUp gutter ?>
	<article class="mkd-portfolio-item <?php echo esc_attr($categories) ?>">
		<div class="mkd-ptf-wrapper">
			<div class="mkd-ptf-item-image-holder">
				<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_size); ?>
			</div>
			<div class="mkd-ptf-item-text-overlay">
				<div class="mkd-ptf-item-text-overlay-inner">
					<div class="mkd-ptf-item-text-holder">
						<a class="mkd-portfolio-link" href="<?php echo esc_url($item_link); ?>"
						   target="<?php echo esc_attr($item_target); ?>"></a>
						<div class="mkd-ptf-item-text-holder-inner">
							<<?php echo esc_attr($title_tag) ?> class="mkd-ptf-item-title">
							<a href="<?php echo esc_url($item_link) ?>" target="<?php echo esc_attr($item_target); ?>">
								<?php echo esc_html(get_the_title()); ?>
							</a>
						</<?php echo esc_attr($title_tag) ?>>

						<?php if (!empty($category_html)) : ?>
							<?php print $category_html; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="mkd-ptf-item-overlay-bg"></div>
		</div>
		</div>
	</article>
<?php // This line is needed for mixItUp gutter ?>