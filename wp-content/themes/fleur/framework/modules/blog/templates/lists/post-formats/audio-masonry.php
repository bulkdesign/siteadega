<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-audio-image-holder">
			<div class="mkd-audio-player-holder">
				<?php fleur_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
			</div>
		</div>
		<div class="mkd-post-text">
			<div class="mkd-post-text-inner">
				<?php fleur_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php
				fleur_mikado_excerpt($excerpt_length);
				$args_pages = array(
					'before'      => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
					'after'       => '</div></div>',
					'link_before' => '<span>' . esc_html__('Post Page Link: ', 'fleur'),
					'link_after'  => '</span>',
					'pagelink'    => '%'
				);

				wp_link_pages($args_pages);
				?>
			</div>
			<div class="mkd-categories-date clearfix">
				<div class="mkd-categories-list">
					<?php fleur_mikado_get_module_template_part('templates/parts/post-info-category', 'blog'); ?>
				</div>
				<div class="mkd-post-info">
					<?php fleur_mikado_post_info(array('date' => 'yes')) ?>
				</div>
			</div>
		</div>
	</div>
</article>