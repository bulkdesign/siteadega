<?php get_header(); ?>

<?php fleur_mikado_get_title(); ?>

	<div class="mkd-container">
		<?php do_action('fleur_mikado_after_container_open'); ?>
		<div class="mkd-container-inner mkd-404-page">
			<div class="mkd-page-not-found">
				<h2>
					<?php if (fleur_mikado_options()->getOptionValue('404_title')) {
						echo esc_html(fleur_mikado_options()->getOptionValue('404_title'));
					} else {
						esc_html_e('Page you are looking for is not found', 'fleur');
					} ?>
				</h2>

				<p>
					<?php if (fleur_mikado_options()->getOptionValue('404_text')) {
						echo esc_html(fleur_mikado_options()->getOptionValue('404_text'));
					} else {
						esc_html_e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'fleur');
					} ?>
				</p>
				<?php
				if (fleur_mikado_core_installed()) {
					$params = array();
					if (fleur_mikado_options()->getOptionValue('404_back_to_home')) {
						$params['text'] = fleur_mikado_options()->getOptionValue('404_back_to_home');
					} else {
						$params['text'] = esc_html__('Back to Home Page', 'fleur');
					}
					$params['link'] = esc_url(home_url('/'));
					$params['target'] = '_self';
					$params['type'] = 'solid';
					$params['margin'] = '35px 0px 0px 0px';
					echo fleur_mikado_execute_shortcode('mkd_button', $params);
				} else { ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" target="_self" style="margin: 35px 0px 0px 0px" class="mkd-btn mkd-btn-medium mkd-btn-solid mkd-btn-hover-outline">
						<span class="mkd-btn-text">Back to Home Page</span>

						<span class="mkd-btn-helper"></span>
					</a>
				<?php } ?>
			</div>
		</div>
		<?php do_action('fleur_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>