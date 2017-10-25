<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<?php fleur_mikado_get_module_template_part('templates/single/parts/image', 'blog'); ?>
		<div class="mkd-post-text">
			<div class="mkd-post-text-inner clearfix">
				<?php fleur_mikado_get_module_template_part('templates/single/parts/title', 'blog'); ?>
				<div class="mkd-post-info">
					<?php
					fleur_mikado_post_info(array(
						'date'     => 'yes',
						'author'   => 'yes',
						'like'     => fleur_mikado_show_likes() ? 'yes' : 'no',
						'comments' => (fleur_mikado_options()->getOptionValue('blog_single_comments') == 'yes') ? 'yes' : 'no'
					));
					?>
				</div>
				<?php the_content(); ?>
				<?php do_action('fleur_mikado_after_blog_article_content'); ?>
			</div>
			<div class="mkd-category-share-holder clearfix">
				<div class="mkd-categories-list">
					<?php fleur_mikado_get_module_template_part('templates/parts/post-info-category', 'blog'); ?>
				</div>
				<div class="mkd-share-icons">
					<?php $post_info_array['share'] = fleur_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
					<?php if ($post_info_array['share'] == 'yes'): ?>
						<span class="mkd-share-label"><?php esc_html_e('Share', 'fleur'); ?></span>
					<?php endif; ?>
					<?php echo fleur_mikado_get_social_share_html(array(
						'type'      => 'list',
						'icon_type' => 'normal'
					)); ?>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('fleur_mikado_before_blog_article_closed_tag'); ?>
</article>