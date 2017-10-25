<?php

if(!function_exists('fleur_mikado_blog_options_map')) {

    function fleur_mikado_blog_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '_blog_page',
                'title' => esc_html__('Blog', 'fleur'),
                'icon'  => 'icon_book_alt'
            )
        );

        /**
         * Blog Lists
         */

        $custom_sidebars = fleur_mikado_get_custom_sidebars();

        $panel_blog_lists = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_blog_page',
                'name'  => 'panel_blog_lists',
                'title' => esc_html__('Blog Lists', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'          => 'blog_list_type',
            'type'          => 'select',
            'label'         => esc_html__('Blog Layout for Archive Pages', 'fleur'),
            'description'   => esc_html__('Choose a default blog layout', 'fleur'),
            'default_value' => 'standard',
            'parent'        => $panel_blog_lists,
            'options'       => array(
                'standard'           => esc_html__(' Blog: Standard', 'fleur'),
                'simple'             => esc_html__('Blog: Simple', 'fleur'),
                'masonry'            => esc_html__('Blog: Masonry', 'fleur'),
                'masonry-full-width' => esc_html__('Blog: Masonry Full Width', 'fleur'),
                'masonry-no-image'   => esc_html__('Blog: Masonry No Image', 'fleur'),
                'masonry-simple'     => esc_html__('Blog: Masonry Simple', 'fleur'),
            )
        ));

        fleur_mikado_add_admin_field(array(
            'name'        => 'archive_sidebar_layout',
            'type'        => 'select',
            'label'       => esc_html__('Archive and Category Sidebar', 'fleur'),
            'description' => esc_html__('Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists', 'fleur'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'default'          => esc_html__('No Sidebar', 'fleur'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'fleur'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'fleur'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'fleur'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'fleur'),
            )
        ));


        if(count($custom_sidebars) > 0) {
            fleur_mikado_add_admin_field(array(
                'name'        => 'blog_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'fleur'),
                'description' => esc_html__('Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"', 'fleur'),
                'parent'      => $panel_blog_lists,
                'options'     => fleur_mikado_get_custom_sidebars()
            ));
        }

        fleur_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_archive_background_color',
            'default_value' => '#fafafa',
            'label'         => esc_html__('Background color for Archive pages', 'fleur'),
            'description'   => esc_html__('Choose background color for blog archive pages', 'fleur'),
            'parent'        => $panel_blog_lists
        ));

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'pagination',
                'default_value' => 'yes',
                'label'         => esc_html__('Pagination', 'fleur'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enabling this option will display pagination links on bottom of Blog Post List', 'fleur'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_pagination_container'
                )
            )
        );

        $pagination_container = fleur_mikado_add_admin_container(
            array(
                'name'            => 'mkd_pagination_container',
                'hidden_property' => 'pagination',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_lists,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'parent'        => $pagination_container,
                'type'          => 'text',
                'name'          => 'blog_page_range',
                'default_value' => '',
                'label'         => esc_html__('Pagination Range limit', 'fleur'),
                'description'   => esc_html__('Enter a number that will limit pagination to a certain range of links', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'        => 'masonry_pagination',
            'type'        => 'select',
            'label'       => esc_html__('Pagination on Masonry', 'fleur'),
            'description' => esc_html__('Choose a pagination style for Masonry Blog List', 'fleur'),
            'parent'      => $pagination_container,
            'options'     => array(
                'no-pagination'   => esc_html__('No Pagination', 'fleur'),
                'standard'        => esc_html__('Standard', 'fleur'),
                'load-more'       => esc_html__('Load More', 'fleur'),
                'infinite-scroll' => esc_html__('Infinite Scroll', 'fleur')
            ),

        ));
        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_load_more_pag',
                'default_value' => 'no',
                'label'         => esc_html__('Load More Pagination on Other Lists', 'fleur'),
                'parent'        => $pagination_container,
                'description'   => esc_html__('Enable Load More Pagination on other lists', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'masonry_filter',
                'default_value' => 'no',
                'label'         => esc_html__('Masonry Filter', 'fleur'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enabling this option will display category filter on Masonry and Masonry Full Width Templates', 'fleur'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_filter_container'
                )
            )
        );

        $blog_filter_container = fleur_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_filter_container',
                'hidden_property' => 'masonry_filter',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_lists,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_margin',
                'default_value' => '0',
                'label'         => esc_html__('Masonry filter margin', 'fleur'),
                'description'   => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_padding',
                'default_value' => '0',
                'label'         => esc_html__('Masonry filter padding', 'fleur'),
                'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'          => 'blog_filter_position',
            'type'          => 'select',
            'label'         => esc_html__('Masonry filter position', 'fleur'),
            'description'   => esc_html__('Default value is center', 'fleur'),
            'parent'        => $blog_filter_container,
            'options'       => array(
                'center' => esc_html__('Center', 'fleur'),
                'left'   => esc_html__('Left', 'fleur'),
                'right'  => esc_html__('Right', 'fleur'),
            ),
            'default_value' => 'center'
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_filter_text_color',
            'default_value' => '#ffffff',
            'label'         => esc_html__('Masonry filter text color', 'fleur'),
            'description'   => esc_html__('Choose text color for masonry filter', 'fleur'),
            'parent'        => $blog_filter_container
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'blog_filter_background_color',
            'default_value' => '#d7d3db',
            'label'         => esc_html__('Masonry filter background color', 'fleur'),
            'description'   => esc_html__('Choose background color for masonry filter', 'fleur'),
            'parent'        => $blog_filter_container
        ));

        fleur_mikado_add_admin_field(
            array(
                'parent'        => $blog_filter_container,
                'type'          => 'text',
                'name'          => 'blog_filter_background_transparency',
                'default_value' => '1',
                'label'         => esc_html__('Masonry filter background transparency', 'fleur'),
                'description'   => esc_html__('Choose a transparency for the masonry filter background color (0 = fully transparent, 1 = opaque)', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'number_of_chars',
                'default_value' => '',
                'label'         => esc_html__('Number of Words in Excerpt', 'fleur'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        fleur_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'standard_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Standard Type Number of Words in Excerpt', 'fleur'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        fleur_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'masonry_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Masonry Type Number of Words in Excerpt', 'fleur'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
        fleur_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'split_column_number_of_chars',
                'default_value' => '45',
                'label'         => esc_html__('Split Column Type Number of Words in Excerpt', 'fleur'),
                'parent'        => $panel_blog_lists,
                'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'fleur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        /**
         * Blog Single
         */
        $panel_blog_single = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_blog_page',
                'name'  => 'panel_blog_single',
                'title' => esc_html__('Blog Single', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'          => 'blog_single_sidebar_layout',
            'type'          => 'select',
            'label'         => esc_html__('Sidebar Layout', 'fleur'),
            'description'   => esc_html__('Choose a sidebar layout for Blog Single pages', 'fleur'),
            'parent'        => $panel_blog_single,
            'options'       => array(
                'default'          => esc_html__('No Sidebar', 'fleur'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'fleur'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'fleur'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'fleur'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'fleur'),
            ),
            'default_value' => 'default'
        ));


        if(count($custom_sidebars) > 0) {
            fleur_mikado_add_admin_field(array(
                'name'        => 'blog_single_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'fleur'),
                'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'fleur'),
                'parent'      => $panel_blog_single,
                'options'     => fleur_mikado_get_custom_sidebars()
            ));
        }

        fleur_mikado_add_admin_field(array(
            'name'          => 'blog_single_title_in_title_area',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Post Title in Title Area', 'fleur'),
            'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'fleur'),
            'parent'        => $panel_blog_single,
            'default_value' => 'no'
        ));

        fleur_mikado_add_admin_field(array(
            'name'          => 'blog_single_likes',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Likes', 'fleur'),
            'description'   => esc_html__('Enabling this option will show likes on your page.', 'fleur'),
            'parent'        => $panel_blog_single,
            'default_value' => 'yes'
        ));

        fleur_mikado_add_admin_field(array(
            'name'          => 'blog_single_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments', 'fleur'),
            'description'   => esc_html__('Enabling this option will show comments on your page.', 'fleur'),
            'parent'        => $panel_blog_single,
            'default_value' => 'yes'
        ));

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_single_navigation',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Prev/Next Single Post Navigation Links', 'fleur'),
                'parent'        => $panel_blog_single,
                'description'   => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'fleur'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_navigation_container'
                )
            )
        );

        $blog_single_navigation_container = fleur_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_single_navigation_container',
                'hidden_property' => 'blog_single_navigation',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_single,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_navigation_through_same_category',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Navigation Only in Current Category', 'fleur'),
                'description'   => esc_html__('Limit your navigation only through current category', 'fleur'),
                'parent'        => $blog_single_navigation_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        fleur_mikado_add_admin_field(array(
            'type'          => 'yesno',
            'name'          => 'blog_enable_single_tags',
            'default_value' => 'yes',
            'label'         => esc_html__('Enable Tags on Single Post', 'fleur'),
            'description'   => esc_html__('Enabling this option will display posts\s tags on single post page', 'fleur'),
            'parent'        => $panel_blog_single
        ));


        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_author_info',
                'default_value' => 'no',
                'label'         => esc_html__('Show Author Info Box', 'fleur'),
                'parent'        => $panel_blog_single,
                'description'   => esc_html__('Enabling this option will display author name and descriptions on Blog Single pages', 'fleur'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_author_info_container'
                )
            )
        );

        $blog_single_author_info_container = fleur_mikado_add_admin_container(
            array(
                'name'            => 'mkd_blog_single_author_info_container',
                'hidden_property' => 'blog_author_info',
                'hidden_value'    => 'no',
                'parent'          => $panel_blog_single,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_author_info_email',
                'default_value' => 'no',
                'label'         => esc_html__('Show Author Email', 'fleur'),
                'description'   => esc_html__('Enabling this option will show author email', 'fleur'),
                'parent'        => $blog_single_author_info_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_blog_options_map', 12);

}











