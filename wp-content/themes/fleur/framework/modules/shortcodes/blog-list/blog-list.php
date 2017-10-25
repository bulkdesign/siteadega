<?php

namespace Fleur\Modules\BlogList;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogList
 */
class BlogList implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_blog_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Blog List', 'fleur'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
            'category'                  => 'by MIKADO',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Type', 'fleur'),
                    'param_name'  => 'type',
                    'value'       => array(
                        esc_html__('Grid Type 1', 'fleur')  => 'grid-type-1',
                        esc_html__('Grid Type 2', 'fleur')  => 'grid-type-2',
                        esc_html__('Masonry', 'fleur')      => 'masonry',
                        esc_html__('Minimal', 'fleur')      => 'minimal',
                        esc_html__('Image in box', 'fleur') => 'image-in-box'
                    ),
                    'description' => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Number of Posts', 'fleur'),
                    'param_name'  => 'number_of_posts',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Number of Columns', 'fleur'),
                    'param_name'  => 'number_of_columns',
                    'value'       => array(
                        esc_html__('One', 'fleur')   => '1',
                        esc_html__('Two', 'fleur')   => '2',
                        esc_html__('Three', 'fleur') => '3',
                        esc_html__('Four', 'fleur')  => '4'
                    ),
                    'description' => '',
                    'dependency'  => Array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2')),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Order By', 'fleur'),
                    'param_name'  => 'order_by',
                    'value'       => array(
                        esc_html__('Title', 'fleur') => 'title',
                        esc_html__('Date', 'fleur')  => 'date'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Order', 'fleur'),
                    'param_name'  => 'order',
                    'value'       => array(
                        esc_html__('ASC', 'fleur')  => 'ASC',
                        esc_html__('DESC', 'fleur') => 'DESC'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Category Slug', 'fleur'),
                    'param_name'  => 'category',
                    'description' => esc_html__('Leave empty for all or use comma for list', 'fleur')
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Hide Image?', 'fleur'),
                    'param_name'  => 'hide_image',
                    'value'       => array(
                        esc_html__('Default', 'fleur') => '',
                        esc_html__('Yes', 'fleur')     => 'yes',
                        esc_html__('No', 'fleur')      => 'no'
                    ),
                    'description' => '',
                    'save_always' => true,
                    'dependency'  => array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2'))
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Image Size', 'fleur'),
                    'param_name'  => 'image_size',
                    'value'       => array(
                        esc_html__('Original', 'fleur')  => 'original',
                        esc_html__('Landscape', 'fleur') => 'landscape',
                        esc_html__('Square', 'fleur')    => 'square',
                        esc_html__('Custom', 'fleur')    => 'custom'
                    ),
                    'description' => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Custom Image Size', 'fleur'),
                    'param_name'  => 'custom_image_size',
                    'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'fleur'),
                    'dependency'  => array('element' => 'image_size', 'value' => 'custom')
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Text length', 'fleur'),
                    'param_name'  => 'text_length',
                    'description' => esc_html__('Number of characters', 'fleur')
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Title Tag', 'fleur'),
                    'param_name'  => 'title_tag',
                    'value'       => array(
                        ''   => '',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6',
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Style', 'fleur'),
                    'param_name'  => 'style',
                    'value'       => array(
                        ''                         => '',
                        esc_html__('Light', 'fleur') => 'light',
                        esc_html__('Dark', 'fleur')  => 'dark'
                    ),
                    'description' => '',
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array('grid-type-1', 'grid-type-2')
                    )
                )
            )
        ));

    }

    public function render($atts, $content = null) {

        $default_atts = array(
            'type'              => 'grid-type-1',
            'number_of_posts'   => '',
            'number_of_columns' => '',
            'image_size'        => 'original',
            'custom_image_size' => '',
            'order_by'          => '',
            'order'             => '',
            'category'          => '',
            'title_tag'         => 'h4',
            'text_length'       => '90',
            'hide_image'        => '',
            'style'             => ''
        );

        $params                   = shortcode_atts($default_atts, $atts);
        $params['holder_classes'] = $this->getBlogHolderClasses($params);

        if(empty($atts['title_tag'])) {
            if(in_array($params['type'], array('image-in-box', 'minimal'))) {
                $params['title_tag'] = 'h4';
            }
        }

        $queryArray             = $this->generateBlogQueryArray($params);
        $query_result           = new \WP_Query($queryArray);
        $params['query_result'] = $query_result;

        $params['use_custom_image_size'] = $params['image_size'] === 'custom' && !empty($params['custom_image_size']);

        if($params['use_custom_image_size']) {
            $params['custom_image_dimensions'] = $this->splitCustomImageSize($params['custom_image_size']);
        } else {
            $thumbImageSize             = $this->generateImageSize($params);
            $params['thumb_image_size'] = $thumbImageSize;
        }

        $params['hide_image'] = !empty($params['hide_image']) && $params['hide_image'] === 'yes';

        $html = '';
        $html .= fleur_mikado_get_shortcode_module_template_part('templates/blog-list-holder', 'blog-list', '', $params);

        return $html;

    }

    /**
     * Generates holder classes
     *
     * @param $params
     *
     * @return string
     */
    private function getBlogHolderClasses($params) {
        $holderClasses = array(
            'mkd-blog-list-holder',
            $this->getColumnNumberClass($params),
            'mkd-'.$params['type']
        );

        if($params['hide_image'] === 'yes' && in_array($params['type'], array('grid-type-1', 'grid-type-2'))) {
            $holderClasses[] = 'mkd-blog-list-without-image';
        }

        if(in_array($params['type'], $this->getGridTypes())) {
            $holderClasses[] = 'mkd-blog-list-grid';

            if($params['style'] !== '') {
                $holderClasses[] = 'mkd-blog-list-'.$params['style'];
            }
        }

        return $holderClasses;

    }

    /**
     * Generates column classes for boxes type
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params) {

        $columnsNumber = '';
        $type          = $params['type'];
        $columns       = $params['number_of_columns'];

        if(in_array($type, $this->getGridTypes())) {
            switch($columns) {
                case 1:
                    $columnsNumber = 'mkd-one-column';
                    break;
                case 2:
                    $columnsNumber = 'mkd-two-columns';
                    break;
                case 3:
                    $columnsNumber = 'mkd-three-columns';
                    break;
                case 4:
                    $columnsNumber = 'mkd-four-columns';
                    break;
                default:
                    $columnsNumber = 'mkd-one-column';
                    break;
            }
        }

        return $columnsNumber;
    }

    private function getGridTypes() {
        return array(
            'grid-type-1',
            'grid-type-2'
        );
    }

    /**
     * Generates query array
     *
     * @param $params
     *
     * @return array
     */
    public function generateBlogQueryArray($params) {

        $queryArray = array(
            'orderby'        => $params['order_by'],
            'order'          => $params['order'],
            'posts_per_page' => $params['number_of_posts'],
            'category_name'  => $params['category']
        );

        return $queryArray;
    }

    /**
     * Generates image size option
     *
     * @param $params
     *
     * @return string
     */
    private function generateImageSize($params) {
        $imageSize = $params['image_size'];

        switch($imageSize) {
            case 'landscape':
                $thumbImageSize = 'fleur_mikado_landscape';
                break;
            case 'square';
                $thumbImageSize = 'fleur_mikado_square';
                break;
            default:
                $thumbImageSize = 'full';
                break;
        }

        return $thumbImageSize;
    }

    private function splitCustomImageSize($customImageSize) {
        if(!empty($customImageSize)) {
            $imageSize = trim($customImageSize);
            //Find digits
            preg_match_all('/\d+/', $imageSize, $matches);
            if(!empty($matches[0])) {
                return array(
                    $matches[0][0],
                    $matches[0][1]
                );
            }
        }

        return false;
    }


}
