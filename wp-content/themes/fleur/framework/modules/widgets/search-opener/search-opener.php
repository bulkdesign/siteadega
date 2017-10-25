<?php

/**
 * Widget that adds search icon that triggers opening of search form
 *
 * Class Mikado_Search_Opener
 */
class FleurMikadoSearchOpener extends FleurMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_search_opener', // Base ID
            esc_html__('Mikado Search Opener', 'fleur') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'name'        => 'search_icon_size',
                'type'        => 'textfield',
                'title'       => esc_html__('Search Icon Size (px)', 'fleur'),
                'description' => esc_html__('Define size for Search icon', 'fleur')
            ),
            array(
                'name'        => 'search_icon_color',
                'type'        => 'textfield',
                'title'       => esc_html__('Search Icon Color', 'fleur'),
                'description' => esc_html__('Define color for Search icon', 'fleur')
            ),
            array(
                'name'        => 'search_icon_hover_color',
                'type'        => 'textfield',
                'title'       => esc_html__('Search Icon Hover Color', 'fleur'),
                'description' => esc_html__('Define hover color for Search icon', 'fleur')
            ),
            array(
                'name'        => 'show_label',
                'type'        => 'dropdown',
                'title'       => esc_html__('Enable Search Icon Text', 'fleur'),
                'description' => esc_html__('Enable this option to show \'Search\' text next to search icon in header', 'fleur'),
                'options'     => array(
                    ''    => '',
                    'yes' => esc_html__('Yes', 'fleur'),
                    'no'  => esc_html__('No', 'fleur')
                )
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $fleur_options, $fleur_IconCollections;

        $search_type_class         = 'mkd-search-opener';
        $fullscreen_search_overlay = false;
        $search_opener_styles      = array();
        $show_search_text          = $instance['show_label'] == 'yes' || $fleur_options['enable_search_icon_text'] == 'yes' ? true : false;

        if(isset($fleur_options['search_type']) && $fleur_options['search_type'] == 'search_covers_header') {
            if(isset($fleur_options['search_cover_only_bottom_yesno']) && $fleur_options['search_cover_only_bottom_yesno'] == 'yes') {
                $search_type_class .= ' search_covers_only_bottom';
            }
        }

        if(!empty($instance['search_icon_size'])) {
            $search_opener_styles[] = 'font-size: '.$instance['search_icon_size'].'px';
        }

        if(!empty($instance['search_icon_color'])) {
            $search_opener_styles[] = 'color: '.$instance['search_icon_color'];
        }

        print $args['before_widget'];

        ?>

        <a <?php echo fleur_mikado_get_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?>
            <?php fleur_mikado_inline_style($search_opener_styles); ?>
            <?php fleur_mikado_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <?php if(isset($fleur_options['search_icon_pack'])) {
                $fleur_IconCollections->getSearchIcon($fleur_options['search_icon_pack'], false);
            } ?>
            <?php if($show_search_text) { ?>
                <span class="mkd-search-icon-text"><?php esc_html_e('Search', 'fleur'); ?></span>
            <?php } ?>
        </a>

        <?php if($fullscreen_search_overlay) { ?>
            <div class="mkd-fullscreen-search-overlay"></div>
        <?php } ?>

        <?php do_action('fleur_mikado_after_search_opener'); ?>

        <?php print $args['after_widget']; ?>
    <?php }
}