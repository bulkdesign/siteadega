<?php

class FleurMikadoPostCategories extends FleurMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_post_categories', // Base ID
            esc_html__('Mikado Post Categories', 'fleur') // Name
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Categories', 'fleur')
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        $params = array();

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        ?>
        <div class="widget widget_categories">
            <?php print $args['before_title'].$instance['title'].$args['after_title']; ?>
            <ul>
                <?php
                $categories = get_categories();
                foreach($categories as $category) {
                    echo '<li class="cat-item cat-item-'.$category->term_id.'">'.fleur_mikado_get_category_color_name($category, true).'</li>';
                }
                ?>
            </ul>
        </div>
        <?php
    }
}