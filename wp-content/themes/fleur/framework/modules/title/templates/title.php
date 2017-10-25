<?php do_action('fleur_mikado_before_page_title'); ?>
<?php if ($show_title_area) { ?>

	<div
		class="mkd-title <?php echo fleur_mikado_title_classes(); ?>" <?php fleur_mikado_inline_style($title_styles); ?>
		data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10)); ?>" <?php echo esc_attr($title_background_image_width); ?>>
		<div class="mkd-title-image"><?php if ($title_background_image_src != "") { ?>
				<img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;"/> <?php } ?>
		</div>
		<div class="mkd-title-holder" <?php fleur_mikado_inline_style($title_holder_height); ?>>
			<div class="mkd-container clearfix">
				<div class="mkd-container-inner">
					<div class="mkd-title-subtitle-holder"
						 style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
						<div class="mkd-title-subtitle-holder-inner">
							<?php switch ($type) {
								case 'standard': ?>
									<h1 <?php fleur_mikado_inline_style($title_color); ?>>
										<span><?php fleur_mikado_title_text(); ?></span></h1>
									<?php if ($has_subtitle) {
										echo fleur_mikado_execute_shortcode('mkd_separator_with_icon', array('sep_color' => $separator_color));
										?>
										<span class="mkd-subtitle" <?php fleur_mikado_inline_style($subtitle_color); ?>><span><?php fleur_mikado_subtitle_text(); ?></span></span>
									<?php } ?>
									<?php if ($enable_breadcrumbs) { ?>
										<div
											class="mkd-breadcrumbs-holder"> <?php fleur_mikado_custom_breadcrumbs(); ?></div>
									<?php } ?>
									<?php break;
								case 'breadcrumb': ?>
									<div
										class="mkd-breadcrumbs-holder"> <?php fleur_mikado_custom_breadcrumbs(); ?></div>
									<?php break;
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
<?php do_action('fleur_mikado_after_page_title'); ?>