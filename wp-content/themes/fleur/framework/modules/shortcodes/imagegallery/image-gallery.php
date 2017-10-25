<?php
namespace Fleur\Modules\Shortcodes\ImageGallery;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class ImageGallery implements ShortcodeInterface {

    private $base;

    /**
     * Image Gallery constructor.
     */
    public function __construct() {
        $this->base = 'mkd_image_gallery';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Image Gallery', 'fleur'),
            'base'                      => $this->getBase(),
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-image-gallery extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__('Images', 'fleur'),
                    'param_name'  => 'images',
                    'description' => esc_html__('Select images from media library', 'fleur')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Image Size', 'fleur'),
                    'param_name'  => 'image_size',
                    'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'fleur')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Gallery Type', 'fleur'),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'value'       => array(
                        esc_html__('Slider', 'fleur')     => 'slider',
                        esc_html__('Image Grid', 'fleur') => 'image_grid'
                    ),
                    'description' => esc_html__('Select gallery type', 'fleur'),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Slide duration', 'fleur'),
                    'admin_label' => true,
                    'param_name'  => 'autoplay',
                    'value'       => array(
                        '3'                          => '3',
                        '5'                          => '5',
                        '10'                         => '10',
                        esc_html__('Disable', 'fleur') => 'disable'
                    ),
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                            'slider'
                        )
                    ),
                    'description' => esc_html__('Auto rotate slides each X seconds', 'fleur'),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Slide Animation', 'fleur'),
                    'admin_label' => true,
                    'param_name'  => 'slide_animation',
                    'value'       => array(
                        esc_html__('Slide', 'fleur')      => 'slide',
                        esc_html__('Fade', 'fleur')       => 'fade',
                        esc_html__('Fade Up', 'fleur')    => 'fadeUp',
                        esc_html__('Back Slide', 'fleur') => 'backSlide',
                        esc_html__('Go Down', 'fleur')    => 'goDown'
                    ),
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                            'slider'
                        )
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Column Number', 'fleur'),
                    'param_name'  => 'column_number',
                    'value'       => array(2, 3, 4, 5),
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                            'image_grid'
                        )
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Spacing', 'fleur'),
                    'param_name'  => 'spacing',
                    'value'       => array(
                        esc_html__('Medium', 'fleur') => 'medium',
                        esc_html__('Small', 'fleur')  => 'small'
                    ),
                    'save_always' => true,
                    'dependency'  => array('element' => 'type', 'value' => 'image_grid')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Open PrettyPhoto on click', 'fleur'),
                    'param_name'  => 'pretty_photo',
                    'value'       => array(
                        esc_html__('Yes', 'fleur') => 'yes',
                        esc_html__('No', 'fleur')  => 'no'
                    ),
                    'save_always' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Grayscale Images', 'fleur'),
                    'param_name'  => 'grayscale',
                    'value'       => array(
                        esc_html__('No', 'fleur')  => 'no',
                        esc_html__('Yes', 'fleur') => 'yes'
                    ),
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                            'image_grid'
                        )
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Show Navigation Arrows', 'fleur'),
                    'param_name'  => 'navigation',
                    'value'       => array(
                        esc_html__('Yes', 'fleur') => 'yes',
                        esc_html__('No', 'fleur')  => 'no'
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                            'slider'
                        )
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Arrows Skin', 'fleur'),
                    'param_name'  => 'arrow_skin',
                    'value'       => array(
                        esc_html__('Dark', 'fleur')  => 'dark',
                        esc_html__('Light', 'fleur') => 'light'
                    ),
                    'save_always' => true,
                    'dependency'  => array('element' => 'navigation', 'value' => 'yes')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Show Pagination', 'fleur'),
                    'param_name'  => 'pagination',
                    'value'       => array(
                        esc_html__('No', 'fleur')  => 'no',
                        esc_html__('Yes', 'fleur') => 'yes'
                    ),
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => array(
                            'slider'
                        )
                    )
                )
            )
        ));

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'images'          => '',
            'image_size'      => 'thumbnail',
            'type'            => 'slider',
            'autoplay'        => '5000',
            'slide_animation' => 'slide',
            'pretty_photo'    => '',
            'column_number'   => '',
            'spacing'         => '',
            'grayscale'       => '',
            'navigation'      => 'yes',
            'pagination'      => 'no',
            'arrow_skin'      => 'dark',
        );


        $params                    = shortcode_atts($args, $atts);
        $params['slider_data']     = $this->getSliderData($params);
        $params['image_size']      = $this->getImageSize($params['image_size']);
        $params['images']          = $this->getGalleryImages($params);
        $params['pretty_photo']    = ($params['pretty_photo'] == 'yes') ? true : false;
        $params['columns']         = 'mkd-gallery-columns-'.$params['column_number'];
        $params['gallery_classes'] = ($params['grayscale'] == 'yes') ? 'mkd-grayscale' : '';
        $params['slider_skin']     = ($params['arrow_skin'] === 'light') ? 'mkd-arrow-light' : '';

        if($params['type'] == 'image_grid') {
            $template = 'gallery-grid';
        } elseif($params['type'] == 'slider') {
            $template = 'gallery-slider';
        }

        $image_space = '';
        if($params['spacing'] == 'small') {
            $image_space .= ' mkd-small-space';
        }

        $params['space'] = $image_space;

        $html = fleur_mikado_get_shortcode_module_template_part('templates/'.$template, 'imagegallery', '', $params);

        return $html;

    }

    /**
     * Return images for gallery
     *
     * @param $params
     *
     * @return array
     */
    private function getGalleryImages($params) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach($image_ids as $id) {

            $image['image_id']        = $id;
            $image_original           = wp_get_attachment_image_src($id, 'full');
            $image['url']             = $image_original[0];
            $image['title']           = get_the_title($id);
            $image['image_link']      = get_post_meta($id, 'custom_link_to', true);
            $image['image_link_text'] = get_post_meta($id, 'custom_link_text', true);

            $images[$i] = $image;
            $i++;
        }

        return $images;

    }

    /**
     * Return image size or custom image size array
     *
     * @param $image_size
     *
     * @return array
     */
    private function getImageSize($image_size) {

        $image_size = trim($image_size);
        //Find digits
        preg_match_all('/\d+/', $image_size, $matches);
        if(in_array($image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
            return $image_size;
        } elseif(!empty($matches[0])) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'thumbnail';
        }
    }

    /**
     * Return all configuration data for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getSliderData($params) {

        $slider_data = array();

        $slider_data['data-autoplay']   = ($params['autoplay'] !== '') ? $params['autoplay'] : '';
        $slider_data['data-animation']  = ($params['slide_animation'] !== '') ? $params['slide_animation'] : '';
        $slider_data['data-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';
        $slider_data['data-pagination'] = ($params['pagination'] !== '') ? $params['pagination'] : '';

        return $slider_data;

    }

}