<?php
if(!function_exists('fleur_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function fleur_mikado_design_styles() {

        $preload_background_styles = array();

        if(fleur_mikado_options()->getOptionValue('preload_pattern_image') !== "") {
            $preload_background_styles['background-image'] = 'url('.fleur_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        } else {
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo fleur_mikado_dynamic_css('.mkd-preload-background', $preload_background_styles);

        if(fleur_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = fleur_mikado_options()->getOptionValue('google_fonts');
            if(fleur_mikado_is_font_option_valid($font_family)) {
                echo fleur_mikado_dynamic_css('body', array('font-family' => fleur_mikado_get_font_option_val($font_family)));
            }
        }

        if(fleur_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
				'a',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'p a',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'.mkd-st-loader .mkd-fleur-text',
				'.mkd-comment-holder .mkd-comment-reply-holder a.comment-reply-link:before',
				'span.wpcf7-not-valid-tip',
				'.mkd-pagination li.active span',
				'.mkd-pagination li:hover a',
				'.mkd-pagination li:hover span',
				'.mkd-like.liked',
				'.wpb_widgetised_column .widget ul li a:hover',
				'aside.mkd-sidebar .widget ul li a:hover',
				'.wpb_widgetised_column .widget .searchform input[type=submit]',
				'aside.mkd-sidebar .widget .searchform input[type=submit]',
				'.wpb_widgetised_column .widget.widget_categories ul li a:hover',
				'.wpb_widgetised_column .widget.widget_categories ul li a:hover .mkd-category-name',
				'.wpb_widgetised_column .widget.widget_nav_menu .current-menu-item>a',
				'.wpb_widgetised_column .widget.widget_nav_menu ul.menu li a:hover',
				'.wpb_widgetised_column .widget.widget_recent_comments ul li a:hover',
				'.wpb_widgetised_column .widget.widget_rss ul li a:hover',
				'aside.mkd-sidebar .widget.widget_categories ul li a:hover',
				'aside.mkd-sidebar .widget.widget_categories ul li a:hover .mkd-category-name',
				'aside.mkd-sidebar .widget.widget_nav_menu .current-menu-item>a',
				'aside.mkd-sidebar .widget.widget_nav_menu ul.menu li a:hover',
				'aside.mkd-sidebar .widget.widget_recent_comments ul li a:hover',
				'aside.mkd-sidebar .widget.widget_rss ul li a:hover',
				'.wpb_widgetised_column .widget.widget_meta ul li a:hover',
				'.wpb_widgetised_column .widget.widget_pages ul li a:hover',
				'aside.mkd-sidebar .widget.widget_meta ul li a:hover',
				'aside.mkd-sidebar .widget.widget_pages ul li a:hover',
				'.wpb_widgetised_column .widget.widget_archive ul li:hover',
				'.wpb_widgetised_column .widget.widget_archive ul li:hover a',
				'.wpb_widgetised_column .widget.widget_archive ul li:hover:before',
				'.wpb_widgetised_column .widget.widget_product_tag_cloud .tagcloud a:hover',
				'.wpb_widgetised_column .widget.widget_tag_cloud .tagcloud a:hover',
				'aside.mkd-sidebar .widget.widget_archive ul li:hover',
				'aside.mkd-sidebar .widget.widget_archive ul li:hover a',
				'aside.mkd-sidebar .widget.widget_archive ul li:hover:before',
				'aside.mkd-sidebar .widget.widget_product_tag_cloud .tagcloud a:hover',
				'aside.mkd-sidebar .widget.widget_tag_cloud .tagcloud a:hover',
				'.wpb_widgetised_column .widget.widget_mkd_twitter_widget .mkd-tweet-icon',
				'aside.mkd-sidebar .widget.widget_mkd_twitter_widget .mkd-tweet-icon',
				'.select2-results .select2-highlighted',
				'.mkd-woocommerce-page .select2-container .select2-choice .select2-arrow b:after',
				'.mkd-woocommerce-page .select2-results .select2-highlighted',
				'.mkd-main-menu ul li.mkd-active-item a',
				'.mkd-main-menu ul li:hover a',
				'.mkd-main-menu ul .mkd-menu-featured-icon',
				'.mkd-main-menu>ul>li.mkd-active-item>a',
				'.mkd-main-menu>ul>li:hover>a',
				'.mkd-drop-down .second .inner ul li ul li:hover>a',
				'.mkd-drop-down .second .inner ul li.current-menu-item>a',
				'.mkd-drop-down .second .inner ul li.sub ul li:hover>a',
				'.mkd-drop-down .second .inner>ul>li:hover>a',
				'.mkd-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
				'.mkd-drop-down .wide .second ul li .flexslider ul li a:hover',
				'.mkd-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
				'.mkd-header-vertical .mkd-vertical-dropdown-float .second .inner ul li ul li:hover>a .item_text',
				'.mkd-header-vertical .mkd-vertical-dropdown-float .second .inner ul li.sub ul li:hover>a .item_text',
				'.mkd-header-vertical .mkd-vertical-dropdown-float .second .inner>ul>li:hover>a .item_text',
				'.mkd-header-vertical .mkd-vertical-dropdown-float li.current-menu-item>a .item_text',
				'.mkd-header-vertical .mkd-vertical-menu>ul>li:hover a',
				'.mkd-header-vertical .mkd-vertical-menu .mkd-menu-featured-icon',
				'.mkd-mobile-header .mkd-mobile-nav li a:hover',
				'.mkd-mobile-header .mkd-mobile-nav li h4:hover',
				'.mkd-mobile-header .mkd-mobile-menu-opener a:hover',
				'.mkd-page-header .mkd-search-opener:hover',
				'.mkd-side-menu-button-opener.opened',
				'.mkd-side-menu-button-opener:hover',
				'.mkd-side-menu .widget .searchform input[type=submit]',
				'.mkd-side-menu .mkd-working-hours-holder .mkd-wh-item:last-child .mkd-wh-hours .mkd-wh-from',
				'.mkd-search-cover input',
				'.mkd-search-cover input:focus',
				'.mkd-search-cover input::-webkit-input-placeholder',
				'.mkd-search-cover input:focus::-webkit-input-placeholder',
				'.mkd-search-cover input:-moz-placeholder',
				'.mkd-search-cover input:focus:-moz-placeholder',
				'.mkd-search-cover input::-moz-placeholder',
				'.mkd-search-cover input:focus::-moz-placeholder',
				'.mkd-search-cover input:-ms-input-placeholder',
				'.mkd-search-cover input:focus:-ms-input-placeholder',
				'.mkd-search-cover .mkd-search-close',
				'.mkd-search-cover .mkd-search-close a:hover',
				'.mkd-team.main-info-on-hover .mkd-team-social-wrapp span a:hover',
				'.mkd-team.main-info-on-hover .mkd-team-social-wrapp span a:hover .mkd-icon-element',
				'.mkd-team .mkd-team-social-wrapp span a',
				'.mkd-counter-holder .mkd-counter-icon',
				'.mkd-icon-shortcode',
				'.mkd-icon-shortcode .mkd-icon-element',
				'.mkd-icon-shortcode .mkd-icon-linea-icon',
				'.mkd-countdown-one .countdown-amount',
				'.mkd-message .mkd-message-inner a.mkd-close i:hover',
				'.mkd-ordered-list ol>li:before',
				'.mkd-icon-list-item .mkd-icon-list-icon-holder',
				'.mkd-icon-list-item .mkd-icon-list-icon-holder-inner .font_elegant',
				'.mkd-icon-list-item .mkd-icon-list-icon-holder-inner i',
				'.mkd-top-bar .mkd-icon-list-item .mkd-icon-list-icon-holder-inner .font_elegant',
				'.mkd-top-bar .mkd-icon-list-item .mkd-icon-list-icon-holder-inner i',
				'.mkd-blog-slider-holder .mkd-post-content .mkd-author-desc .mkd-author-name',
				'.mkd-blog-slider-holder.mkd-blog-slider-two .mkd-post-info-comments:hover',
				'.mkd-blog-slider-holder .slick-next:before',
				'.mkd-blog-slider-holder .slick-prev:before',
				'.mkd-price-table .mkd-price-table-inner .mkd-pt-label-holder .mkd-pt-label-inner',
				'.mkd-tabs .mkd-tabs-nav li.ui-state-active a',
				'.mkd-tabs .mkd-tabs-nav li:hover a',
				'.mkd-accordion-holder .mkd-title-holder span.mkd-accordion-number',
				'.mkd-accordion-holder .mkd-title-holder .mkd-accordion-mark',
				'.mkd-blog-list-holder.mkd-grid-type-2 .mkd-post-item-author-holder a:hover',
				'.mkd-blog-list-holder.mkd-masonry .mkd-post-item-author-holder a:hover',
				'.mkd-blog-list-holder.mkd-image-in-box h6.mkd-item-title a',
				'.mkd-blog-list-holder.mkd-image-in-box h6.mkd-item-title a:hover',
				'.mkd-btn.mkd-btn-outline',
				'.post-password-form input.mkd-btn-outline[type=submit]',
				'.woocommerce .mkd-btn-outline.button',
				'input.mkd-btn-outline.wpcf7-form-control.wpcf7-submit',
				'.mkd-video-button-play .mkd-video-button-wrapper',
				'.mkd-dropcaps',
				'.mkd-portfolio-list-holder-outer.mkd-ptf-gallery.mkd-hover-light .mkd-ptf-item-text-overlay .mkd-ptf-portfolio-overlay-icon',
				'.mkd-portfolio-list-holder-outer.mkd-ptf-gallery.mkd-hover-light article .mkd-ptf-item-title>a',
				'.mkd-portfolio-slider-holder .mkd-ptf-category-holder span',
				'.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li',
				'.mkd-social-share-holder.mkd-list [class*=facebook]',
				'.mkd-social-share-holder.mkd-list [class*=google-plus]',
				'.mkd-social-share-holder.mkd-list [class*=twitter]',
				'.mkd-social-share-holder.mkd-list [class*=vimeo]',
				'.mkd-social-share-holder.mkd-list [class*=instagram]',
				'.mkd-social-share-holder.mkd-list [class*=pinterest]',
				'.mkd-social-share-holder.mkd-list [class*=tumblr]',
				'.mkd-social-share-holder.mkd-list [class*=linkedin]',
				'.mkd-process-holder .mkd-number-holder-inner',
				'.mkd-icon-progress-bar .mkd-ipb-active',
				'.mkd-team-slider-holder .mkd-team.main-info-below-image.mkd-team-flip .mkd-team-back .mkd-team-back-title>i',
				'.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item.flex-active',
				'.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item.flex-active h6.mkd-tab-slider-nav-title',
				'.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item:hover',
				'.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item:hover h6.mkd-tab-slider-nav-title',
				'.mkd-product-slider .products>li.product .price',
				'.mkd-product-slider .products>li.product .mkd-btn span',
				'.mkd-product-slider .products>li.product .post-password-form input[type=submit] span',
				'.mkd-product-slider .products>li.product .woocommerce .button span',
				'.mkd-product-slider .products>li.product input.wpcf7-form-control.wpcf7-submit span',
				'.post-password-form .mkd-product-slider .products>li.product input[type=submit] span',
				'.woocommerce .mkd-product-slider .products>li.product .button span',
				'.mkd-fullscreen-menu-opener.opened',
				'.mkd-fullscreen-menu ul li a',
				'.mkd-blog-holder.mkd-blog-type-masonry .mkd-post-content .mkd-author-desc .mkd-author-name',
				'.mkd-blog-holder.mkd-blog-type-masonry:not(.mkd-masonry-simple) .format-quote .mkd-post-mark',
				'.mkd-blog-holder.mkd-blog-type-masonry:not(.mkd-masonry-simple) .format-link .mkd-post-mark',
				'.mkd-blog-holder.mkd-blog-type-standard .format-link .mkd-post-content .mkd-post-mark',
				'.mkd-blog-holder article .mkd-post-info a:hover',
				'.mkd-blog-holder article .mkd-post-info .mkd-post-info-author-icon',
				'.mkd-blog-holder article .mkd-post-info .mkd-post-info-comments-icon',
				'.mkd-blog-holder article .mkd-post-info .mkd-like i',
				'.mkd-blog-holder article .mkd-post-info .mkd-like.liked i',
				'.mkd-blog-holder article.format-quote .mkd-post-mark',
				'.mkd-blog-holder article.format-quote .mkd-post-title h2:hover span',
				'.mkd-blog-holder.mkd-blog-single.mkd-blog-standard .format-link .mkd-post-content .mkd-post-mark',
				'.single .mkd-blog-holder article .mkd-post-title',
				'.single .mkd-author-description .mkd-author-social-holder .mkd-author-social-icon',
				'.single .mkd-author-description .mkd-author-description-text-holder h6.mkd-author-position',
				'.single .mkd-single-tags-holder .mkd-tags a:hover',
				'article .mkd-category span.icon_tags',
				'.mejs-controls .mejs-button button',
				'.mejs-controls .mejs-play button',
				'.mejs-container .mejs-controls .mejs-time',
				'.woocommerce-pagination .page-numbers li a:hover',
				'.woocommerce-pagination .page-numbers li span.current',
				'.woocommerce-pagination .page-numbers li span.current:hover',
				'.woocommerce-pagination .page-numbers li span:hover',
				'.mkd-woocommerce-page .woocommerce-error',
				'.mkd-woocommerce-page .woocommerce-info',
				'.mkd-woocommerce-page .woocommerce-message',
				'.mkd-woocommerce-page .woocommerce-error a',
				'.mkd-woocommerce-page .woocommerce-info a',
				'.mkd-woocommerce-page .woocommerce-message a',
				'.mkd-woocommerce-page .price_slider_amount button.button',
				'.woocommerce .price_slider_amount button.button',
				'.mkd-woocommerce-page ul.products .product .added_to_cart',
				'.woocommerce ul.products .product .added_to_cart',
				'.mkd-woocommerce-page ul.products .add_to_cart_button',
				'.mkd-woocommerce-page ul.products .product.outofstock .mkd-btn',
				'.mkd-woocommerce-page ul.products .product.product-type-variable .mkd-btn',
				'.mkd-woocommerce-page ul.products .product_type_external',
				'.mkd-woocommerce-page ul.products .product_type_grouped',
				'.woocommerce ul.products .add_to_cart_button',
				'.woocommerce ul.products .product.outofstock .mkd-btn',
				'.woocommerce ul.products .product.product-type-variable .mkd-btn',
				'.woocommerce ul.products .product_type_external',
				'.woocommerce ul.products .product_type_grouped',
				'.mkd-woocommerce-page .price',
				'.woocommerce .price',
				'.mkd-woocommerce-page .price ins',
				'.woocommerce .price ins',
				'.mkd-woocommerce-page .mkd-new-product',
				'.mkd-woocommerce-page .mkd-onsale',
				'.mkd-woocommerce-page .mkd-out-of-stock',
				'.woocommerce .mkd-new-product',
				'.woocommerce .mkd-onsale',
				'.woocommerce .mkd-out-of-stock',
				'.mkd-woocommerce-page .mkd-single-product-summary .star-rating span:before',
				'.woocommerce .mkd-single-product-summary .star-rating span:before',
				'.single-product .mkd-single-product-summary .price .amount ins span',
				'.single-product .mkd-single-product-summary .product_meta>span',
				'.single-product .mkd-single-product-summary form.cart .price ins .amount',
				'.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product-categories a:hover',
				'.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_layered_nav a:hover',
				'.wpb_widgetised_column .widget .product-categories a:hover',
				'.wpb_widgetised_column .widget.widget_layered_nav a:hover',
				'.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product_list_widget li .mkd-woo-product-widget-content .product-title',
				'.wpb_widgetised_column .widget .product_list_widget li .mkd-woo-product-widget-content .product-title',
				'.mkd-shopping-cart-dropdown ul li a:hover',
				'.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-left a:hover',
				'.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-right .remove:hover',
				'.mkd-shopping-cart-dropdown span.mkd-total span',
				'.mkd-shopping-cart-dropdown span.mkd-quantity',
				'.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) thead',
				'.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-remove a',
				'.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-name a:hover',
				'.woocommerce-cart .woocommerce .cart-collaterals .mkd-shipping-calculator .woocommerce-shipping-calculator>p a:hover',
				'.woocommerce-cart .woocommerce .cart-collaterals .mkd-cart-totals table tr.order-total td',
				'.woocommerce-cart .woocommerce .cart-collaterals .mkd-cart-totals table tr.order-total th'
            );

            $color_important_selector = array(
				'.mkd-header-minimal.mkd-light-header .mkd-minimal-header-widget-area .mkd-btn.mkd-btn-hover-solid:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.mkd-header-minimal.mkd-light-header .mkd-minimal-header-widget-area .post-password-form input.mkd-btn-hover-solid[type=submit]:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.mkd-header-minimal.mkd-light-header .mkd-minimal-header-widget-area .woocommerce .mkd-btn-hover-solid.button:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.mkd-header-minimal.mkd-light-header .mkd-minimal-header-widget-area input.mkd-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.post-password-form .mkd-header-minimal.mkd-light-header .mkd-minimal-header-widget-area input.mkd-btn-hover-solid[type=submit]:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.woocommerce .mkd-header-minimal.mkd-light-header .mkd-minimal-header-widget-area .mkd-btn-hover-solid.button:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.mkd-btn.mkd-btn-hover-outline:not(.mkd-btn-custom-hover-color):not(.mkd-btn-transparent):hover',
				'.post-password-form input[type=submit]:not(.mkd-btn-custom-hover-color):not(.mkd-btn-transparent):hover',
				'.woocommerce .button:not(.mkd-btn-custom-hover-color):not(.mkd-btn-transparent):hover',
				'input.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-color):not(.mkd-btn-transparent):hover',
				'.mkd-btn.mkd-btn-hover-white:not(.mkd-btn-custom-hover-color):hover',
				'.post-password-form input.mkd-btn-hover-white[type=submit]:not(.mkd-btn-custom-hover-color):hover',
				'.woocommerce .mkd-btn-hover-white.button:not(.mkd-btn-custom-hover-color):hover',
				'input.mkd-btn-hover-white.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-color):hover',
				'.mkd-process-slider-holder .slick-slider .slick-dots li.slick-active button:before',
				'.mkd-team-slider-holder.mkd-nav-light .slick-slider .slick-dots li.slick-active button:before',
				'.mkd-team-slider-holder .slick-dots li.slick-active button:before',
				'.woocommerce-page.woocommerce .woocommerce-message a.button:hover',
				'.mkd-woocommerce-page .price ins span',
				'.woocommerce .price ins span',
				'.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-menu-area .mkd-main-menu-widget-area .mkd-btn.checkout:hover span.mkd-btn-text',
				'.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-menu-area .mkd-main-menu-widget-area .mkd-btn.view-cart:hover span.mkd-btn-text'
            );

            $background_color_selector = array(

				'.mkd-st-loader .pulse',
				'.mkd-st-loader .double_pulse .double-bounce1',
				'.mkd-st-loader .double_pulse .double-bounce2',
				'.mkd-st-loader .cube',
				'.mkd-st-loader .rotating_cubes .cube1',
				'.mkd-st-loader .rotating_cubes .cube2',
				'.mkd-st-loader .stripes>div',
				'.mkd-st-loader .wave>div',
				'.mkd-st-loader .two_rotating_circles .dot1',
				'.mkd-st-loader .two_rotating_circles .dot2',
				'.mkd-st-loader .five_rotating_circles .container1>div',
				'.mkd-st-loader .five_rotating_circles .container2>div',
				'.mkd-st-loader .five_rotating_circles .container3>div',
				'.mkd-st-loader .lines .line1',
				'.mkd-st-loader .lines .line2',
				'.mkd-st-loader .lines .line3',
				'.mkd-st-loader .lines .line4',
				'.wpb_widgetised_column .widget.widget_categories ul li a:hover .mkd-category-color',
				'aside.mkd-sidebar .widget.widget_categories ul li a:hover .mkd-category-color',
				'.mkd-team .mkd-team-hover',
				'.mkd-icon-shortcode.circle',
				'.mkd-icon-shortcode.square',
				'.mkd-separator-with-icon-holder.mkd-default-icon .mkd-separator-left',
				'.mkd-separator-with-icon-holder.mkd-default-icon .mkd-separator-right',
				'.mkd-separator-with-icon-holder.mkd-default-icon .mkd-default-icon-holder',
				'.mkd-separator-with-icon-holder.mkd-custom-icon .mkd-separator-left',
				'.mkd-separator-with-icon-holder.mkd-custom-icon .mkd-separator-right',
				'.mkd-blog-slider-holder .slick-dots li.slick-active',
				'.mkd-price-table.mkd-pt-active .mkd-price-table-inner',
				'.mkd-pie-chart-doughnut-holder .mkd-pie-legend ul li .mkd-pie-color-holder',
				'.mkd-pie-chart-pie-holder .mkd-pie-legend ul li .mkd-pie-color-holder',
				'.mkd-tabs.mkd-horizontal .mkd-tabs-nav li.ui-state-active a:after',
				'.mkd-tabs.mkd-horizontal .mkd-tabs-nav li.ui-state-active:after',
				'.mkd-tabs.mkd-horizontal .mkd-tabs-nav li.ui-state-active:before',
				'.mkd-tabs.mkd-horizontal .mkd-tabs-nav li:hover a:after',
				'.mkd-tabs.mkd-horizontal .mkd-tabs-nav li:hover:after',
				'.mkd-tabs.mkd-horizontal .mkd-tabs-nav li:hover:before',
				'.mkd-tabs.mkd-vertical .mkd-tabs-nav li.ui-state-active a:after',
				'.mkd-tabs.mkd-vertical .mkd-tabs-nav li.ui-state-hover a:after',
				'.mkd-accordion-holder.mkd-initial .mkd-title-holder .mkd-tab-title:before',
				'.mkd-btn.mkd-btn-solid',
				'.post-password-form input[type=submit]',
				'.woocommerce .button',
				'input.wpcf7-form-control.wpcf7-submit',
				'.mkd-btn.mkd-btn-hover-solid .mkd-btn-helper',
				'.post-password-form input.mkd-btn-hover-solid[type=submit] .mkd-btn-helper',
				'.woocommerce .mkd-btn-hover-solid.button .mkd-btn-helper',
				'input.mkd-btn-hover-solid.wpcf7-form-control.wpcf7-submit .mkd-btn-helper',
				'blockquote:after',
				'blockquote:before',
				'blockquote .mkd-blockquote-icon',
				'.mkd-dropcaps.mkd-circle',
				'.mkd-dropcaps.mkd-square',
				'.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li span:after',
				'.mkd-process-slider-holder .mkd-pi-flip .mkd-pi-back',
				'.mkd-comparision-pricing-tables-holder .mkd-cpt-table .mkd-cpt-table-btn a',
				'.mkd-vertical-progress-bar-holder .mkd-vpb-active-bar',
				'.mkd-team-slider-holder .mkd-team.main-info-below-image.mkd-team-flip .mkd-team-back',
				'.mkd-zooming-slider-holder .slick-dots .slick-active button',
				'.mkd-zooming-slider-holder .slick-dots li:hover button',
				'#multiscroll-nav ul li .active span',
				'.mkd-card-slider-holder .controls .dots .dots-inner .dot.active',
				'.mkd-product-slider .mkd-product-slider-pager a.selected',
				'.widget_mkd_call_to_action_button .mkd-call-to-action-button',
				'.mejs-container .mkd-blog-audio-holder',
				'.mejs-controls .mejs-time-rail .mejs-time-current:after',
				'.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
				'.mejs-controls .mejs-time-rail .mejs-time-current',
				'body div.pp_default a.pp_next:before',
				'body div.pp_default a.pp_previous:before',
				'.mkd-woocommerce-page .woocommerce-message a',
				'.mkd-woocommerce-page ul.products li:hover .added_to_cart',
				'.woocommerce ul.products li:hover .added_to_cart',
				'.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_product_categories .product-categories li a:before',
				'.wpb_widgetised_column .widget.widget_product_categories .product-categories li a:before',
				'.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_price_filter .ui-slider .ui-slider-handle',
				'.wpb_widgetised_column .widget.widget_price_filter .ui-slider .ui-slider-handle',
				'.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_price_filter .ui-slider-horizontal .ui-slider-range',
				'.wpb_widgetised_column .widget.widget_price_filter .ui-slider-horizontal .ui-slider-range',
				'.woocommerce-checkout p.form-row.form-row-last .button'
            );

            $background_color_important_selector = array(
				'.mkd-carousel-pagination .owl-dot.active span',
				'.mkd-btn.mkd-btn-hover-solid:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.post-password-form input.mkd-btn-hover-solid[type=submit]:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.woocommerce .mkd-btn-hover-solid.button:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'input.mkd-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-bg):not(.mkd-btn-with-animation):hover',
				'.mkd-twitter-slider.mkd-nav-dark .slick-slider .slick-dots li.slick-active button:before',
				'.mkd-product-slider .products>li.product .mkd-btn:hover',
				'.mkd-product-slider .products>li.product .post-password-form input[type=submit]:hover',
				'.mkd-product-slider .products>li.product .woocommerce .button:hover',
				'.mkd-product-slider .products>li.product input.wpcf7-form-control.wpcf7-submit:hover',
				'.post-password-form .mkd-product-slider .products>li.product input[type=submit]:hover',
				'.woocommerce .mkd-product-slider .products>li.product .button:hover',
				'.mkd-woocommerce-page .price_slider_amount button.button:not(.mkd-btn-transparent):hover',
				'.woocommerce .price_slider_amount button.button:not(.mkd-btn-transparent):hover',
				'.mkd-woocommerce-page ul.products .product .added_to_cart:hover',
				'.woocommerce ul.products .product .added_to_cart:hover',
				'.woocommerce-checkout p.form-row.form-row-last .button:hover'
			);

            $border_color_selector = array(
				'.mkd-st-loader .pulse_circles .ball',
				'div.wpcf7-validation-errors',
				'.mkd-testimonials.owl-carousel .owl-dots .owl-dot span',
				'.mkd-btn.mkd-btn-solid',
				'.post-password-form input[type=submit]',
				'.woocommerce .button',
				'input.wpcf7-form-control.wpcf7-submit',
				'.mkd-btn.mkd-btn-outline',
				'.post-password-form input.mkd-btn-outline[type=submit]',
				'.woocommerce .mkd-btn-outline.button',
				'input.mkd-btn-outline.wpcf7-form-control.wpcf7-submit',
				'.mkd-woocommerce-page .woocommerce-error',
				'.mkd-woocommerce-page .woocommerce-info',
				'.mkd-woocommerce-page .woocommerce-message',
				'.mkd-woocommerce-page .price_slider_amount button.button',
				'.woocommerce .price_slider_amount button.button',
				'.mkd-woocommerce-page ul.products .product .added_to_cart',
				'.woocommerce ul.products .product .added_to_cart',
				'.mkd-woocommerce-page .mkd-new-product:after',
				'.mkd-woocommerce-page .mkd-onsale:after',
				'.mkd-woocommerce-page .mkd-out-of-stock:after',
				'.woocommerce .mkd-new-product:after',
				'.woocommerce .mkd-onsale:after',
				'.woocommerce .mkd-out-of-stock:after',
				'.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .actions .coupon input[type=text]:focus',
				'.woocommerce-checkout p.form-row.form-row-last .button'
			);

            $border_color_important_selector = array(
				'.mkd-btn.mkd-btn-hover-outline:not(.mkd-btn-custom-border-hover):hover',
				'.mkd-btn.mkd-btn-hover-solid:not(.mkd-btn-custom-border-hover):hover',
				'.post-password-form input.mkd-btn-hover-solid[type=submit]:not(.mkd-btn-custom-border-hover):hover',
				'.post-password-form input[type=submit]:not(.mkd-btn-custom-border-hover):hover',
				'.woocommerce .button:not(.mkd-btn-custom-border-hover):hover',
				'.woocommerce .mkd-btn-hover-solid.button:not(.mkd-btn-custom-border-hover):hover',
				'input.mkd-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-border-hover):hover',
				'input.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-border-hover):hover',
				'.mkd-twitter-slider.mkd-nav-dark .slick-slider .slick-dots li button:before',
				'.mkd-product-slider .products>li.product .mkd-btn',
				'.mkd-product-slider .products>li.product .post-password-form input[type=submit]',
				'.mkd-product-slider .products>li.product .woocommerce .button',
				'.mkd-product-slider .products>li.product input.wpcf7-form-control.wpcf7-submit',
				'.post-password-form .mkd-product-slider .products>li.product input[type=submit]',
				'.woocommerce .mkd-product-slider .products>li.product .button',
				'.mkd-product-slider .products>li.product .mkd-btn:hover',
				'.mkd-product-slider .products>li.product .post-password-form input[type=submit]:hover',
				'.mkd-product-slider .products>li.product .woocommerce .button:hover',
				'.mkd-product-slider .products>li.product input.wpcf7-form-control.wpcf7-submit:hover',
				'.post-password-form .mkd-product-slider .products>li.product input[type=submit]:hover',
				'.woocommerce .mkd-product-slider .products>li.product .button:hover',
				'.mkd-product-slider .products>li.product .added_to_cart',
				'.woocommerce-page.woocommerce .woocommerce-message a.button:hover',
				'.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-menu-area .mkd-main-menu-widget-area a.checkout:hover',
				'.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-menu-area .mkd-main-menu-widget-area a.view-cart:hover',
				'.woocommerce-checkout p.form-row.form-row-last .button:hover'
            );


            $border_top_color_selector = array(
                '.mkd-progress-bar .mkd-progress-number-wrapper.mkd-floating .mkd-down-arrow'
            );

            $border_bottom_color_selector = array(
                '.woocommerce-cart .woocommerce .cart-collaterals .mkd-shipping-calculator .woocommerce-shipping-calculator>p:after',
                '.woocommerce-account .woocommerce h2:after'
            );

            echo fleur_mikado_dynamic_css($color_selector, array('color' => fleur_mikado_options()->getOptionValue('first_color')));
            echo fleur_mikado_dynamic_css($color_important_selector, array('color' => fleur_mikado_options()->getOptionValue('first_color').'!important'));
            echo fleur_mikado_dynamic_css('::selection', array('background' => fleur_mikado_options()->getOptionValue('first_color')));
            echo fleur_mikado_dynamic_css('::-moz-selection', array('background' => fleur_mikado_options()->getOptionValue('first_color')));
            echo fleur_mikado_dynamic_css($background_color_selector, array('background-color' => fleur_mikado_options()->getOptionValue('first_color')));
            echo fleur_mikado_dynamic_css($background_color_important_selector, array('background-color' => fleur_mikado_options()->getOptionValue('first_color').'!important'));
            echo fleur_mikado_dynamic_css($border_color_selector, array('border-color' => fleur_mikado_options()->getOptionValue('first_color')));
            echo fleur_mikado_dynamic_css($border_color_important_selector, array('border-color' => fleur_mikado_options()->getOptionValue('first_color').'!important'));
            echo fleur_mikado_dynamic_css($border_top_color_selector, array('border-top-color' => fleur_mikado_options()->getOptionValue('first_color')));
            echo fleur_mikado_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => fleur_mikado_options()->getOptionValue('first_color')));
            echo fleur_mikado_dynamic_css('.mkd-preloader svg circle', array('stroke' => fleur_mikado_options()->getOptionValue('first_color')));
        }

        if(fleur_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkd-wrapper-inner',
                '.mkd-content'
            );
            echo fleur_mikado_dynamic_css($background_color_selector, array('background-color' => fleur_mikado_options()->getOptionValue('page_background_color')));
        }

        if(fleur_mikado_options()->getOptionValue('selection_color')) {
            echo fleur_mikado_dynamic_css('::selection', array('background' => fleur_mikado_options()->getOptionValue('selection_color')));
            echo fleur_mikado_dynamic_css('::-moz-selection', array('background' => fleur_mikado_options()->getOptionValue('selection_color')));
        }

        $boxed_background_style = array();
        if(fleur_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = fleur_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if(fleur_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(fleur_mikado_options()->getOptionValue('boxed_background_image')).')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat']   = 'no-repeat';
        }

        if(fleur_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(fleur_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat']   = 'repeat';
        }

        if(fleur_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (fleur_mikado_options()->getOptionValue('boxed_background_image_attachment'));
        }

		if ($boxed_background_style['background-image']) {
			if ($boxed_background_style['background-attachment'] == 'fixed') {
				$boxed_background_style['background-size'] = 'cover';
			} else {
				$boxed_background_style['background-size'] = 'contain';
			}
		}

        echo fleur_mikado_dynamic_css('.mkd-boxed .mkd-wrapper', $boxed_background_style);
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_design_styles');
}

if(!function_exists('fleur_mikado_h1_styles')) {

    function fleur_mikado_h1_styles() {

        $h1_styles = array();

        if(fleur_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = fleur_mikado_options()->getOptionValue('h1_color');
        }
        if(fleur_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(fleur_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = fleur_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(fleur_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = fleur_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = fleur_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if(!empty($h1_styles)) {
            echo fleur_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_h1_styles');
}

if(!function_exists('fleur_mikado_h2_styles')) {

    function fleur_mikado_h2_styles() {

        $h2_styles = array();

        if(fleur_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = fleur_mikado_options()->getOptionValue('h2_color');
        }
        if(fleur_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(fleur_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = fleur_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(fleur_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = fleur_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = fleur_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if(!empty($h2_styles)) {
            echo fleur_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_h2_styles');
}

if(!function_exists('fleur_mikado_h3_styles')) {

    function fleur_mikado_h3_styles() {

        $h3_styles = array();

        if(fleur_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = fleur_mikado_options()->getOptionValue('h3_color');
        }
        if(fleur_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(fleur_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = fleur_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(fleur_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = fleur_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = fleur_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if(!empty($h3_styles)) {
            echo fleur_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_h3_styles');
}

if(!function_exists('fleur_mikado_h4_styles')) {

    function fleur_mikado_h4_styles() {

        $h4_styles = array();

        if(fleur_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = fleur_mikado_options()->getOptionValue('h4_color');
        }
        if(fleur_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(fleur_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = fleur_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(fleur_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = fleur_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = fleur_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if(!empty($h4_styles)) {
            echo fleur_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_h4_styles');
}

if(!function_exists('fleur_mikado_h5_styles')) {

    function fleur_mikado_h5_styles() {

        $h5_styles = array();

        if(fleur_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = fleur_mikado_options()->getOptionValue('h5_color');
        }
        if(fleur_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(fleur_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = fleur_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(fleur_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = fleur_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = fleur_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if(!empty($h5_styles)) {
            echo fleur_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_h5_styles');
}

if(!function_exists('fleur_mikado_h6_styles')) {

    function fleur_mikado_h6_styles() {

        $h6_styles = array();

        if(fleur_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = fleur_mikado_options()->getOptionValue('h6_color');
        }
        if(fleur_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(fleur_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = fleur_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(fleur_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = fleur_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = fleur_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if(!empty($h6_styles)) {
            echo fleur_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_h6_styles');
}

if(!function_exists('fleur_mikado_text_styles')) {

    function fleur_mikado_text_styles() {

        $text_styles = array();

        if(fleur_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = fleur_mikado_options()->getOptionValue('text_color');
        }
        if(fleur_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(fleur_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(fleur_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = fleur_mikado_options()->getOptionValue('text_texttransform');
        }
        if(fleur_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = fleur_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = fleur_mikado_options()->getOptionValue('text_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if(!empty($text_styles)) {
            echo fleur_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_text_styles');
}

if(!function_exists('fleur_mikado_link_styles')) {

    function fleur_mikado_link_styles() {

        $link_styles = array();

        if(fleur_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = fleur_mikado_options()->getOptionValue('link_color');
        }
        if(fleur_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = fleur_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(fleur_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = fleur_mikado_options()->getOptionValue('link_fontweight');
        }
        if(fleur_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = fleur_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if(!empty($link_styles)) {
            echo fleur_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_link_styles');
}

if(!function_exists('fleur_mikado_link_hover_styles')) {

    function fleur_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(fleur_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = fleur_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(fleur_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = fleur_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if(!empty($link_hover_styles)) {
            echo fleur_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(fleur_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = fleur_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if(!empty($link_heading_hover_styles)) {
            echo fleur_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_link_hover_styles');
}

if(!function_exists('fleur_mikado_smooth_page_transition_styles')) {

    function fleur_mikado_smooth_page_transition_styles() {

        $loader_style = array();

        if(fleur_mikado_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = fleur_mikado_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.mkd-smooth-transition-loader');

        if(!empty($loader_style)) {
            echo fleur_mikado_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(fleur_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = fleur_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.mkd-st-loader .pulse',
            '.mkd-st-loader .double_pulse .double-bounce1',
            '.mkd-st-loader .double_pulse .double-bounce2',
            '.mkd-st-loader .cube',
            '.mkd-st-loader .rotating_cubes .cube1',
            '.mkd-st-loader .rotating_cubes .cube2',
            '.mkd-st-loader .stripes > div',
            '.mkd-st-loader .wave > div',
            '.mkd-st-loader .two_rotating_circles .dot1',
            '.mkd-st-loader .two_rotating_circles .dot2',
            '.mkd-st-loader .five_rotating_circles .container1 > div',
            '.mkd-st-loader .five_rotating_circles .container2 > div',
            '.mkd-st-loader .five_rotating_circles .container3 > div',
            '.mkd-st-loader .atom .ball-1:before',
            '.mkd-st-loader .atom .ball-2:before',
            '.mkd-st-loader .atom .ball-3:before',
            '.mkd-st-loader .atom .ball-4:before',
            '.mkd-st-loader .clock .ball:before',
            '.mkd-st-loader .mitosis .ball',
            '.mkd-st-loader .lines .line1',
            '.mkd-st-loader .lines .line2',
            '.mkd-st-loader .lines .line3',
            '.mkd-st-loader .lines .line4',
            '.mkd-st-loader .fussion .ball',
            '.mkd-st-loader .fussion .ball-1',
            '.mkd-st-loader .fussion .ball-2',
            '.mkd-st-loader .fussion .ball-3',
            '.mkd-st-loader .fussion .ball-4',
            '.mkd-st-loader .wave_circles .ball',
            '.mkd-st-loader .pulse_circles .ball'
        );

        if(!empty($spinner_style)) {
            echo fleur_mikado_dynamic_css($spinner_selectors, $spinner_style);
        }

        $spinner_logo_style = array();

        if(fleur_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_logo_style['color'] = fleur_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_logo_selector = array(
            '.mkd-st-loader .mkd-fleur-text'
        );

        if(!empty($spinner_logo_style)) {
            echo fleur_mikado_dynamic_css($spinner_logo_selector, $spinner_logo_style);
        }
    }

    add_action('fleur_mikado_style_dynamic', 'fleur_mikado_smooth_page_transition_styles');
}