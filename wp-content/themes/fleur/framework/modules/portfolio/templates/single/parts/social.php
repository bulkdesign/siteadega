<div class="mkd-portfolio-item-social">
	<?php if (fleur_mikado_options()->getOptionValue('enable_social_share') == 'yes'
		&& fleur_mikado_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes'
	) : ?>
		<div class="mkd-portfolio-single-share-holder">
				<span class="mkd-share-label">
				    <?php esc_html_e('Share', 'fleur'); ?>
			    </span>
			<?php echo fleur_mikado_get_social_share_html() ?>
		</div>
	<?php endif;
	if (fleur_mikado_options()->getOptionValue('portfolio_single_likes') == 'yes') :?>
		<div class="mkd-portfolio-single-likes">
			<?php echo fleur_mikado_like_portfolio_list(get_the_ID()); ?>
		</div>
	<?php endif; ?>
</div>
