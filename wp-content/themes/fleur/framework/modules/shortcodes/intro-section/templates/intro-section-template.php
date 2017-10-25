<div <?php fleur_mikado_class_attribute($holder_classes); ?> <?php fleur_mikado_inline_style($holder_styles);?>>
    <div class="mkd-intro-top-row">
        <div class="mkd-intro-top-cell">
            <div class="mkd-intro-logo-holder">
                <?php if ($logo != '') { ?>
                    <?php echo wp_get_attachment_image($logo, 'full', false, array( 'class' => 'mkd-intro-section-logo' )); ?>
                <?php } ?>
            </div>
            <div class="mkd-intro-text">
                <?php if ($title != '') { ?>
                    <h1 class="mkd-intro-title" <?php fleur_mikado_inline_style($title_styles);?>><?php echo esc_attr($title) ?></h1>
                <?php } if ($description != '') { ?>
                    <p class="mkd-intro-description" <?php fleur_mikado_inline_style($description_styles);?>><?php echo esc_attr($description) ?></p>
                <?php } if(is_array($button_params) && count($button_params)) { ?>
					<div class="mkd-button-holder">
						<?php echo fleur_mikado_get_button_html($button_params); ?>
					</div>
				<?php } ?>
            </div>
        </div>
    </div>
    <div class="mkd-intro-bottom-row">
        <div class="mkd-intro-bottom-cell">
            <?php if ($additional_image_3 != '') { ?>
                <div class="mkd-additional-image-3" style="background-image:url(<?php echo wp_get_attachment_url($additional_image_3); ?>)"></div>
            <?php } ?>
            <?php if ($additional_image_1 != '') { ?>
                <div class="mkd-additional-image-1" style="background-image:url(<?php echo wp_get_attachment_url($additional_image_1); ?>)"></div>
            <?php } ?>
            <?php if ($hero_image != '') { ?>
                <div class="mkd-is-hero" style="background-image:url(<?php echo wp_get_attachment_url($hero_image); ?>)"></div>
            <?php } ?>
            <?php if ($additional_image_2 != '') { ?>
                <div class="mkd-additional-image-2" style="background-image:url(<?php echo wp_get_attachment_url($additional_image_2); ?>)"></div>
            <?php } ?>
            <?php if ($additional_image_4 != '') { ?>
                <div class="mkd-additional-image-4" style="background-image:url(<?php echo wp_get_attachment_url($additional_image_4); ?>)"></div>
            <?php } ?>
        </div>
    </div>
</div>