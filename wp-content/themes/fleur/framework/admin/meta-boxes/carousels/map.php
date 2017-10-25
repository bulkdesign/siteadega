<?php

//Carousels

$carousel_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('carousels'),
        'title' => esc_html__('Carousel', 'fleur'),
        'name'  => 'carousel_meta'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_image',
        'type'        => 'image',
        'label'       => esc_html__('Carousel Image', 'fleur'),
        'description' => esc_html__('Choose carousel image (min width needs to be 215px)', 'fleur'),
        'parent'      => $carousel_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_hover_image',
        'type'        => 'image',
        'label'       => esc_html__('Carousel Hover Image', 'fleur'),
        'description' => esc_html__('Choose carousel hover image (min width needs to be 215px)', 'fleur'),
        'parent'      => $carousel_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_item_link',
        'type'        => 'text',
        'label'       => esc_html__('Link', 'fleur'),
        'description' => esc_html__('Enter the URL to which you want the image to link to (e.g. http://www.example.com)', 'fleur'),
        'parent'      => $carousel_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_carousel_item_target',
        'type'        => 'selectblank',
        'label'       => esc_html__('Target', 'fleur'),
        'description' => esc_html__('Specify where to open the linked document', 'fleur'),
        'parent'      => $carousel_meta_box,
        'options'     => array(
            '_self'  => esc_html__('Self', 'fleur'),
            '_blank' => esc_html__('Blank', 'fleur')
        )
    )
);