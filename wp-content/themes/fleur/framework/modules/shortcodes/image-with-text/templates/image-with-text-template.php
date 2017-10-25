<div class="mkd-iwt">
	<div class="mkd-image-holder">
		<?php if ($link != '') { ?>
		<a href="<?php echo esc_html($link); ?>" target="<?php echo esc_html($link_target); ?>">
			<?php }
			echo wp_get_attachment_image($image, 'full');
			if ($link != '') { ?>
		</a>
	<?php } ?>
	</div>
	<?php if ($title !== '' || $text !== '') : ?>
	<div class="mkd-text-holder">
		<div class="mkd-text-holder-inner">
			<?php if ($title !== '') :
			echo do_shortcode('[mkd_separator_with_icon icon_pack=""]'); ?>
			<<?php echo esc_html($title_tag) ?> class="mkd-iwt-title">
			<?php if ($link != '') { ?>
			<a href="<?php echo esc_html($link); ?>" target="<?php echo esc_html($link_target); ?>">
				<?php }
				echo esc_html($title);
				if ($link != '') { ?>
			</a>
		<?php } ?>
		</<?php echo esc_html($title_tag); ?>>
		<?php endif; ?>
		<?php if ($text !== '') : ?>
			<p>
				<?php echo esc_html($text); ?>
			</p>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
</div>