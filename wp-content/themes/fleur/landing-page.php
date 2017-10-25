<?php
/*
Template Name: Landing Page
*/
$sidebar = fleur_mikado_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * fleur_mikado_header_meta hook
	 *
	 * @see fleur_mikado_header_meta() - hooked with 10
	 * @see mkd_user_scalable_meta() - hooked with 10
	 */
	do_action('fleur_mikado_header_meta');
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
<?php
/**
 * fleur_mikado_action_after_body_tag hook
 *
 * @see fleur_mikado_get_side_area() - hooked with 10
 * @see fleur_mikado_smooth_page_transitions() - hooked with 10
 */
do_action('fleur_mikado_action_after_body_tag'); ?>

<div class="mkd-wrapper">
	<div class="mkd-wrapper-inner">
		<div class="mkd-content">
			<div class="mkd-content-inner">
				<?php fleur_mikado_get_title(); ?>
				<?php get_template_part('slider'); ?>
				<div class="mkd-full-width">
					<div class="mkd-full-width-inner">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<div class="mkd-grid-row">
								<div <?php echo fleur_mikado_get_content_sidebar_class(); ?>>
									<?php the_content(); ?>
									<?php do_action('fleur_mikado_page_after_content'); ?>
								</div>

								<?php if (!in_array($sidebar, array('default', ''))) : ?>
									<div <?php echo fleur_mikado_get_sidebar_holder_class(); ?>>
										<?php get_sidebar(); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>