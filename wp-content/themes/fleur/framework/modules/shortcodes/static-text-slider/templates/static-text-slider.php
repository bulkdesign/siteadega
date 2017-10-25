<div class="mkd-static-text-slider-holder">
    <div class="mkd-static-text-slider-images-holder">
        <div class="flexslider">
            <ul class="slides">
            <?php foreach($images as $image) { ?>
                <li>
                    <?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
    <div class="mkd-static-text-slider-text-holder">
        <div class="mkd-static-text-slider-text">
            <div class="mkd-static-text-slider-text-inner">
                <?php if($title !== ''){ ?>
                    <h3> <?php echo esc_attr($title); ?></h3>
                <?php } ?>
                <?php if($text !== ''){ ?>
                    <p> <?php echo esc_attr($text); ?></p>
                <?php } ?>
                <?php

                if($button_label !== '' && $button_link !== ''){ ?>
                     <?php echo fleur_mikado_execute_shortcode('mkd_button',array(
                        'size' => '',
                        'text' => $button_label,
                        'link' => $button_link,
                        'target' => $button_link_target,
                        'type' => $button_type
                    )); ?>

                <?php } ?>
            </div>
        </div>
    </div>
</div>