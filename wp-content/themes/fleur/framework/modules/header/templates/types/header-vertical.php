<?php do_action('fleur_mikado_before_page_header'); ?>
	<aside class="mkd-vertical-menu-area">
		<div class="mkd-vertical-menu-area-inner">
			<div class="mkd-vertical-area-background" <?php fleur_mikado_inline_style(array(
				$vertical_header_background_color,
				$vertical_header_opacity,
				$vertical_background_image
			)); ?>></div>
			<?php if(!$hide_logo) {
				fleur_mikado_get_logo('vertical');
			} ?>
			<?php fleur_mikado_get_vertical_main_menu(); ?>
			<div class="mkd-vertical-area-widget-holder">
				<?php if(is_active_sidebar('mkd-vertical-area')) : ?>
					<?php dynamic_sidebar('mkd-vertical-area'); ?>
				<?php endif; ?>
			</div>
		</div>
	</aside>

<?php do_action('fleur_mikado_after_page_header'); ?>