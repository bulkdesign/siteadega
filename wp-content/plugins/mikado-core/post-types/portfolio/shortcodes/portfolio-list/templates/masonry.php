<article
	class="mkd-portfolio-item<?php echo esc_attr($space_btw_items) ?> <?php echo esc_attr($article_masonry_size) ?> <?php echo esc_attr($categories) ?>">
	<div class="mkd-portfolio-masonry-item">
		<div class="mkd-item-image-holder">
			<?php
			echo get_the_post_thumbnail(get_the_ID(), $thumb_size);
			?>
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
					<?php if ($show_excerpt === 'yes') : ?>
						<p><?php echo esc_html($caller->itemExcerpt($excerpt_length)); ?></p>
					<?php endif; ?>

					<?php if ($show_category === 'yes') : ?>
						<?php if (!empty($category_html)) : ?>
							<?php print $category_html; ?>
						<?php endif; ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
	</div>
</article>
