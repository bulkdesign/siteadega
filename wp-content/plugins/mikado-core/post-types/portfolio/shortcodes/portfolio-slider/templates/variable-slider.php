<div <?php mkd_core_class_attribute($holder_classes); ?>>
	<?php if ($query->have_posts()) : ?>
	<ul class="mkd-portfolio-slider-list" <?php echo mkd_core_get_inline_attrs($holder_data); ?>>
		<?php while ($query->have_posts()) :
		$query->the_post();
		$categories = wp_get_post_terms(get_the_ID(), 'portfolio-category');
		?>
		<li <?php post_class(); ?>>
			<div class="mkd-ptfs-item">
				<?php if (has_post_thumbnail()) : ?>
				<div class="mkd-ptfs-item-image">
					<a href="<?php esc_url(the_permalink()); ?>">
						<?php if ($use_custom_image_size && (is_array($custom_image_sizes) && count($custom_image_sizes))) : ?>
							<?php echo fleur_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_image_sizes[0], $custom_image_sizes[1]); ?>
						<?php else: ?>
							<?php the_post_thumbnail($thumb_size); ?>
						<?php endif; ?>
					</a>
				</div>
				<div class="mkd-ptfs-item-content">
					<<?php echo esc_attr($title_tag); ?> class="mkd-ptfs-item-title">
					<a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a>
				</<?php echo esc_attr($title_tag); ?>>
				<?php if ($excerpt_length != 0) { ?>
					<div class="mkd-ptfs-item-excerpt-holder">
						<p><?php echo esc_html($caller->itemExcerpt($excerpt_length)); ?></p>
					</div>
				<?php } ?>
				<?php if ($show_category === 'yes') : ?>

					<div class="mkd-ptf-category-holder">
						<?php foreach ($categories as $cat) { ?>
							<span><?php print $cat->name; ?></span>
						<?php } ?>
					</div>


				<?php endif; ?>
			</div>
			<?php endif; ?>
</div>
</li>
<?php endwhile; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php else: ?>
	<p><?php esc_html_e('Sorry, no posts matched your criteria.', 'mkd_core'); ?></p>
<?php endif; ?>
</div>