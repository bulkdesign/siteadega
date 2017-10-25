<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();
fleur_mikado_get_title();
get_template_part('slider');
fleur_mikado_single_portfolio();
endwhile; endif;
get_footer();