<?php

/*** Link Post Format ***/

$link_post_format_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('post'),
        'title' => esc_html__('Link Post Format', 'fleur'),
        'name'  => 'post_format_link_meta'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_post_link_link_meta',
        'type'        => 'text',
        'label'       => esc_html__('Link', 'fleur'),
        'description' => esc_html__('Enter link', 'fleur'),
        'parent'      => $link_post_format_meta_box,

    )
);

