<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-text" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">
			<div class="mkd-post-text-inner clearfix">
				<div class="mkd-post-mark">
					<span aria-hidden="true" class="icon_quotations"></span>
				</div>
				<div class="mkd-post-title">
					<h1>
						<span>"</span><span><?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)); ?></span><span>"</span>
					</h1>
					<span class="mkd-quote_author"><?php the_title(); ?></span>
				</div>
			</div>
		</div>
		<div class="mkd-content-category-share-holder">
			<div class="mkd-content-holder">
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
						'type' => 'list',
						'icon_type' => 'normal'
					)); ?>
				</div>
			</div>
		</div>
	</div>
</article>