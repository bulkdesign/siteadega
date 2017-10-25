<div class="mkd-iwt-over">
	<div class="mkd-image-holder">
		<?php echo wp_get_attachment_image($image, 'full'); ?>
	</div>
	<div class="mkd-text-holder">
		<div class="mkd-text-holder-inner">
			<div class="mkd-text">
                <?php if ($link != '') { ?>
				<?php echo  fleur_mikado_get_button_html(array(
                    'type'                   => 'solid',
                    'hover_type'             => 'white',
                    'text'                   => $text,
                    'link'                   => $link,
                    'target'                 => $link_target,
                    'hover_color'            => '#000'
                )); esc_html($text); ?>
                <?php } ?>
			</div>
		</div>
	</div>
</div>