<div <?php mkd_core_class_attribute($holder_classes); ?>>
    <?php if($query->have_posts()) : ?>
    <ul class="mkd-portfolio-slider-list mkd-masonry-slider" <?php echo mkd_core_get_inline_attrs($holder_data); ?>>
        <?php while($query->have_posts()) :
        $query->the_post(); ?>
        <li <?php post_class(); ?>>
            <a class="mkd-ptf-portfolio-overlay-icon" href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>" data-rel="prettyPhoto[portfolio-standard]">
                <?php echo fleur_mikado_icon_collections()->renderIcon('icon_zoom-in_alt', 'font_elegant'); ?>
            </a>

            <div class="mkd-ptf-item-image-holder">
                <?php if($use_custom_image_size && (is_array($custom_image_sizes) && count($custom_image_sizes))) : ?>
                    <?php echo fleur_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $custom_image_sizes[0], $custom_image_sizes[1]); ?>
                <?php else: ?>
                    <?php the_post_thumbnail($thumb_size); ?>
                <?php endif; ?>
            </div>
            <div class="mkd-ptf-item-text-overlay">
                <div class="mkd-ptf-item-text-overlay-inner">
                    <div class="mkd-ptf-item-text-holder">
						<a class="mkd-portfolio-link" href="<?php esc_url(the_permalink()); ?>"></a>

                        <<?php echo esc_attr($title_tag) ?> class="mkd-ptf-item-title">
                        <a href="<?php esc_url(the_permalink()); ?>">
                            <?php echo esc_attr(get_the_title()); ?>
                        </a>
                    </<?php echo esc_attr($title_tag) ?>>
                </div>
            </div>
</div>

</li>
<?php endwhile; ?>
</ul>
<?php wp_reset_postdata(); ?>
<?php else: ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'mkd_core'); ?></p>
<?php endif; ?>
</div>