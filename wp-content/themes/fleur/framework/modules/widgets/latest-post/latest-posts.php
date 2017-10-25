<?php

class FleurMikadoLatestPosts extends FleurMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkd_latest_posts_widget', // Base ID
            esc_html__('Mikado Latest Post', 'fleur'), // Name
            array('description' => esc_html__('Display posts from your blog', 'fleur'),) // Args
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Title', 'fleur')
            ),
            array(
                'name'    => 'type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'fleur'),
                'options' => array(
                    'minimal'      => esc_html__('Minimal', 'fleur'),
                    'image-in-box' => esc_html__('Image in box', 'fleur')
                )
            ),
            array(
                'name'  => 'number_of_posts',
                'type'  => 'textfield',
                'title' => esc_html__('Number of posts', 'fleur')
            ),
            array(
                'name'    => 'order_by',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order By', 'fleur'),
                'options' => array(
                    'title' => esc_html__('Title', 'fleur'),
                    'date'  => esc_html__('Date', 'fleur')
                )
            ),
            array(
                'name'    => 'order',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order', 'fleur'),
                'options' => array(
                    'ASC'  => esc_html__('ASC', 'fleur'),
                    'DESC' => esc_html__('DESC', 'fleur')
                )
            ),
            array(
                'name'    => 'image_size',
                'type'    => 'dropdown',
                'title'   => esc_html__('Image Size', 'fleur'),
                'options' => array(
                    'original'  => esc_html__('Original', 'fleur'),
                    'landscape' => esc_html__('Landscape', 'fleur'),
                    'square'    => esc_html__('Square', 'fleur'),
                    'custom'    => esc_html__('Custom', 'fleur')
                )
            ),
            array(
                'name'  => 'custom_image_size',
                'type'  => 'textfield',
                'title' => esc_html__('Custom Image Size', 'fleur')
            ),
            array(
                'name'  => 'category',
                'type'  => 'textfield',
                'title' => esc_html__('Category Slug', 'fleur')
            ),
            array(
                'name'  => 'text_length',
                'type'  => 'textfield',
                'title' => esc_html__('Number of characters', 'fleur')
            ),
            array(
                'name'    => 'title_tag',
                'type'    => 'dropdown',
                'title'   => esc_html__('Title Tag', 'fleur'),
                'options' => array(
                    ""   => "",
                    "h2" => "h2",
                    "h3" => "h3",
                    "h4" => "h4",
                    "h5" => "h5",
                    "h6" => "h6"
                )
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $content        = '';
        $params         = array();
        $params['type'] = 'image_in_box';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        if(empty($params['title_tag'])) {
            $params['title_tag'] = 'h6';
        }
        echo '<div class="widget mkd-latest-posts-widget">';

        if(!empty($instance['title'])) {
            print $args['before_title'].$instance['title'].$args['after_title'];
        }

        echo fleur_mikado_execute_shortcode('mkd_blog_list', $params);

        echo '</div>'; //close mkd-latest-posts-widget
    }
}
