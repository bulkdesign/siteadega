<?php

$mkd_pages = array();
$pages     = get_pages();
foreach($pages as $page) {
    $mkd_pages[$page->ID] = $page->post_title;
}

global $fleur_IconCollections;

//Portfolio Images

$mkdPortfolioImages = new FleurMikadoMetaBox("portfolio-item", esc_html__('Portfolio Images (multiple upload)', 'fleur'), '', '', 'portfolio_images');
$fleur_Framework->mkdMetaBoxes->addMetaBox("portfolio_images", $mkdPortfolioImages);

$mkd_portfolio_image_gallery = new FleurMikadoMultipleImages("mkd_portfolio-image-gallery", esc_html__('Portfolio Images', 'fleur'), esc_html__('Choose your portfolio images', 'fleur'));
$mkdPortfolioImages->addChild("mkd_portfolio-image-gallery", $mkd_portfolio_image_gallery);

//Portfolio Images/Videos 2

$mkdPortfolioImagesVideos2 = new FleurMikadoMetaBox("portfolio-item", esc_html__('Portfolio Images/Videos (single upload)', 'fleur'));
$fleur_Framework->mkdMetaBoxes->addMetaBox("portfolio_images_videos2", $mkdPortfolioImagesVideos2);

$mkd_portfolio_images_videos2 = new FleurMikadoImagesVideosFramework(esc_html__('Portfolio Images/Videos 2', 'fleur'), esc_html__('ThisIsDescription', 'fleur'));
$mkdPortfolioImagesVideos2->addChild("mkd_portfolio_images_videos2", $mkd_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$mkdAdditionalSidebarItems = new FleurMikadoMetaBox("portfolio-item", esc_html__('Additional Portfolio Sidebar Items', 'fleur'));
$fleur_Framework->mkdMetaBoxes->addMetaBox("portfolio_properties", $mkdAdditionalSidebarItems);

$mkd_portfolio_properties = new FleurMikadoOptionsFramework(esc_html__('Portfolio Properties', 'fleur'), esc_html__('ThisIsDescription', 'fleur'));
$mkdAdditionalSidebarItems->addChild("mkd_portfolio_properties", $mkd_portfolio_properties);

