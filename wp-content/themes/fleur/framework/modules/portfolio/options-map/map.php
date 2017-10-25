<?php

if(!function_exists('fleur_mikado_portfolio_options_map')) {

	function fleur_mikado_portfolio_options_map() {

		fleur_mikado_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'fleur'),
			'icon'  => 'icon_images'
		));

		$panel = fleur_mikado_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'fleur'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'fleur'),
			'default_value' => 'small-images',
			'description'   => esc_html__('Choose a default type for Single Project pages', 'fleur'),
			'parent'        => $panel,
			'options'       => array(
				'small-images'      => esc_html__('Portfolio small images', 'fleur'),
				'small-slider'      => esc_html__('Portfolio small slider', 'fleur'),
				'big-images'        => esc_html__('Portfolio big images', 'fleur'),
				'big-slider'        => esc_html__('Portfolio big slider', 'fleur'),
				'custom'            => esc_html__('Portfolio custom', 'fleur'),
				'full-width-custom' => esc_html__('Portfolio full width custom', 'fleur'),
				'masonry'   => esc_html__('Portfolio masonry', 'fleur'),
				'gallery'           => esc_html__('Portfolio gallery', 'fleur')
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Lightbox for Images', 'fleur'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images.', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Lightbox for Videos', 'fleur'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_categories',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Categories', 'fleur'),
			'description'   => esc_html__('Enabling this option will disable category meta description on Single Projects.', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Date', 'fleur'),
			'description'   => esc_html__('Enabling this option will disable date meta on Single Projects.', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_likes',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Likes', 'fleur'),
			'description'   => esc_html__('Enabling this option will show likes on your page.', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'no'
		));


		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'fleur'),
			'description'   => esc_html__('Enabling this option will show comments on your page.', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Sticky Side Text', 'fleur'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'fleur'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality.', 'fleur'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '#mkd_navigate_same_category_container'
			)
		));

		$container_navigate_category = fleur_mikado_add_admin_container(array(
			'name'            => 'navigate_same_category_container',
			'parent'          => $panel,
			'hidden_property' => 'portfolio_single_hide_pagination',
			'hidden_value'    => 'yes'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_nav_same_category',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Pagination Through Same Category', 'fleur'),
			'description'   => esc_html__('Enabling this option will make portfolio pagination sort through current category.', 'fleur'),
			'parent'        => $container_navigate_category,
			'default_value' => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_numb_columns',
			'type'          => 'select',
			'label'         => esc_html__('Number of Columns', 'fleur'),
			'default_value' => 'three-columns',
			'description'   => esc_html__('Enter the number of columns for Portfolio Gallery type', 'fleur'),
			'parent'        => $panel,
			'options'       => array(
				'two-columns'   => esc_html__('2 columns', 'fleur'),
				'three-columns' => esc_html__('3 columns', 'fleur'),
				'four-columns'  => esc_html__('4 columns', 'fleur')
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'fleur'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'fleur'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));

	}

	add_action('fleur_mikado_options_map', 'fleur_mikado_portfolio_options_map', 14);

}