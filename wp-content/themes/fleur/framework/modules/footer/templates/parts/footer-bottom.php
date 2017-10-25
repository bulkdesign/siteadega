<div class="mkd-footer-bottom-holder-outer">
	<div class="mkd-footer-bottom-holder">
		<?php if ($footer_bottom_separator): ?>
			<div class="mkd-footer-separator mkd-container-inner"></div>
		<?php endif; ?>
		<div class="mkd-footer-bottom-holder-inner">
			<?php if ($footer_in_grid) { ?>
			<div class="mkd-container">
				<div class="mkd-container-inner">

					<?php }

					switch ($footer_bottom_columns) {
						case 3:
							fleur_mikado_get_footer_bottom_sidebar_three_columns();
							break;
						case 2:
							fleur_mikado_get_footer_bottom_sidebar_two_columns();
							break;
						case 1:
							fleur_mikado_get_footer_bottom_sidebar_one_column();
							break;
					}
					if ($footer_in_grid){ ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>