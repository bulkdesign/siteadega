<?php if(fleur_mikado_options()->getOptionValue('portfolio_single_hide_author') !== 'yes') : ?>
    <div class="mkd-portfolio-author-holder clearfix">
        <div class="mkd-image-author-holder clearfix">
            <div class="mkd-author-description-image">
                <?php echo fleur_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
            </div>
            <div class="mkd-author-name-position">
                <h4 class="mkd-author-name">
                    <?php
                    if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
                        echo esc_attr(get_the_author_meta('first_name'))." ".esc_attr(get_the_author_meta('last_name'));
                    } else {
                        echo esc_attr(get_the_author_meta('display_name'));
                    }
                    ?>
                </h4>
                <?php if(get_the_author_meta('position') !== '') : ?>
                    <div class="mkd-author-position-holder">
                        <h5 class="mkd-author-position"><?php echo esc_html(get_the_author_meta('position')); ?></h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="mkd-author-description-text-holder">
            <?php if(get_the_author_meta('description') !== '') { ?>
                <div class="mkd-author-text">
                    <p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>