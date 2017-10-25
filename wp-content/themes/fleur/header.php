<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * @see fleur_mikado_header_meta() - hooked with 10
	 * @see mkd_user_scalable - hooked with 10
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
		<?php fleur_mikado_get_header(); ?>

		<?php if (fleur_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
			<a id='mkd-back-to-top' href='#'>
                <span class="mkd-icon-stack">
                     <?php echo fleur_mikado_icon_collections()->renderIcon('arrow_carrot-up', 'font_elegant'); ?>
                </span>
			</a>
		<?php } ?>
		<?php fleur_mikado_get_full_screen_menu(); ?>
		<div class="mkd-content" <?php fleur_mikado_content_elem_style_attr(); ?>>
			<div class="mkd-content-inner">