<?php

//top header bar
add_action('fleur_mikado_before_page_header', 'fleur_mikado_get_header_top');

//mobile header
add_action('fleur_mikado_after_page_header', 'fleur_mikado_get_mobile_header');