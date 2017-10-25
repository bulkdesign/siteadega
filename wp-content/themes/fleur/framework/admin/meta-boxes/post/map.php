<?php

/*** Post Options ***/

$post_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Post', 'fleur'),
        'name'  => 'post-meta'
    )
);

$all_pages = array(
    '' => 'Default'
);

$pages = get_pages();
foreach($pages as $page) {
    $all_pages[$page->ID] = $page->post_title;
}
