<?php

//Testimonials

$testimonial_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('testimonials'),
        'title' => esc_html__('Testimonial', 'fleur'),
        'name'  => 'testimonial_meta'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_title',
        'type'        => 'text',
        'label'       => esc_html__('Title', 'fleur'),
        'description' => esc_html__('Enter testimonial title', 'fleur'),
        'parent'      => $testimonial_meta_box,
    )
);


fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_author',
        'type'        => 'text',
        'label'       => esc_html__('Author', 'fleur'),
        'description' => esc_html__('Enter author name', 'fleur'),
        'parent'      => $testimonial_meta_box,
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_author_position',
        'type'        => 'text',
        'label'       => esc_html__('Job Position', 'fleur'),
        'description' => esc_html__('Enter job position', 'fleur'),
        'parent'      => $testimonial_meta_box,
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_testimonial_text',
        'type'        => 'text',
        'label'       => esc_html__('Text', 'fleur'),
        'description' => esc_html__('Enter testimonial text', 'fleur'),
        'parent'      => $testimonial_meta_box,
    )
);