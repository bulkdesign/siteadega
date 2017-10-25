<?php
$sidebar = fleur_mikado_sidebar_layout();
$excerpt_length_array = fleur_mikado_blog_lists_number_of_chars();

$excerpt_length = 0;
if (is_array($excerpt_length_array) && array_key_exists('standard', $excerpt_length_array)) {
	$excerpt_length = $excerpt_length_array['standard'];
}

?>

<?php get_header(); ?>
<?php
global $wp_query;

if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

if (fleur_mikado_options()->getOptionValue('blog_page_range') != "") {
	$blog_page_range = esc_attr(fleur_mikado_options()->getOptionValue('blog_page_range'));
} else {
	$blog_page_range = $wp_query->max_num_pages;
}
?>
<?php fleur_mikado_get_title(); ?>
	<div class="mkd-container">
		<?php do_action('fleur_mikado_action_after_container_open'); ?>
		<div class="mkd-container-inner clearfix">
			<div class="mkd-blog-holder mkd-blog-type-standard">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="mkd-post-content">
							<?php fleur_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
							<div class="mkd-post-text">
								<div class="mkd-post-text-inner">
									<?php fleur_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
									<div class="mkd-post-info">
										<?php
										fleur_mikado_post_info(array(
											'date'     => 'yes',
											'author'   => 'yes',
											'category' => 'no',
											'comments' => fleur_mikado_show_comments() ? 'yes' : 'no',
											'like'     => fleur_mikado_show_likes() ? 'yes' : 'no'
										)); ?>
									</div>
									<?php $my_excerpt = get_the_excerpt();
									if ($my_excerpt != '') { ?>
										<p class="mkd-post-excerpt"><?php echo esc_html($my_excerpt); ?></p>
									<?php }
									$args_pages = array(
										'before'      => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
										'after'       => '</div></div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
										'pagelink'    => '%'
									);

									wp_link_pages($args_pages);
									?>
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
					</article>
				<?php
				endwhile;
				else:
					fleur_mikado_get_module_template_part('templates/parts/no-posts', 'blog');
				endif;
				?>
				<?php do_action('fleur_mikado_action_before_container_close'); ?>
			</div>
		</div>
		<?php do_action('fleur_mikado_action_before_container_close'); ?>
	</div>
<?php get_footer(); ?>