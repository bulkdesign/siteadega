<?php

/*
   Interface: iFleurMikadoLayoutNode
   A interface that implements Layout Node methods
*/

interface iFleurMikadoLayoutNode {
    public function hasChidren();

    public function getChild($key);

    public function addChild($key, $value);
}

/*
   Interface: iFleurMikadoRender
   A interface that implements Render methods
*/

interface iFleurMikadoRender {
    public function render($factory);
}

/*
   Class: FleurMikadoPanel
   A class that initializes Mikado Panel
*/

class FleurMikadoPanel implements iFleurMikadoLayoutNode, iFleurMikadoRender {

    public $children;
    public $title;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($title = "", $name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->title           = $title;
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(fleur_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(fleur_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>
        <div class="mkd-page-form-section-holder" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <h3 class="mkd-page-section-title"><?php echo esc_html($this->title); ?></h3>
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iFleurMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: FleurMikadoContainer
   A class that initializes Mikado Container
*/

class FleurMikadoContainer implements iFleurMikadoLayoutNode, iFleurMikadoRender {

    public $children;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(fleur_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(fleur_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>
        <div class="mkd-page-form-container-holder" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iFleurMikadoRender $child, $factory) {
        $child->render($factory);
    }
}


/*
   Class: FleurMikadoContainerNoStyle
   A class that initializes Mikado Container without css classes
*/

class FleurMikadoContainerNoStyle implements iFleurMikadoLayoutNode, iFleurMikadoRender {

    public $children;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(fleur_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(fleur_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>
        <div id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iFleurMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: FleurMikadoGroup
   A class that initializes Mikado Group
*/

class FleurMikadoGroup implements iFleurMikadoLayoutNode, iFleurMikadoRender {

    public $children;
    public $title;
    public $description;

    function __construct($title = "", $description = "") {
        $this->children    = array();
        $this->title       = $title;
        $this->description = $description;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($this->title); ?></h4>

                <p><?php echo esc_html($this->description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <?php
                    foreach($this->children as $child) {
                        $this->renderChild($child, $factory);
                    }
                    ?>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php
    }

    public function renderChild(iFleurMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: FleurMikadoNotice
   A class that initializes Mikado Notice
*/

class FleurMikadoNotice implements iFleurMikadoRender {

    public $children;
    public $title;
    public $description;
    public $notice;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($title = "", $description = "", $notice = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->title           = $title;
        $this->description     = $description;
        $this->notice          = $notice;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(fleur_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(fleur_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>

        <div class="mkd-page-form-section"<?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($this->title); ?></h4>

                <p><?php echo esc_html($this->description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="alert alert-warning">
                        <?php echo esc_html($this->notice); ?>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php
    }
}

/*
   Class: FleurMikadoRow
   A class that initializes Mikado Row
*/

class FleurMikadoRow implements iFleurMikadoLayoutNode, iFleurMikadoRender {

    public $children;
    public $next;

    function __construct($next = false) {
        $this->children = array();
        $this->next     = $next;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        ?>
        <div class="row<?php if($this->next) {
            echo " next-row";
        } ?>">
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iFleurMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: FleurMikadoTitle
   A class that initializes Mikado Title
*/

class FleurMikadoTitle implements iFleurMikadoRender {
    private $name;
    private $title;
    public $hidden_property;
    public $hidden_values = array();

    function __construct($name = "", $title = "", $hidden_property = "", $hidden_value = "") {
        $this->title           = $title;
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(fleur_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            }
        }
        ?>
        <h5 class="mkd-page-section-subtitle" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>><?php echo esc_html($this->title); ?></h5>
    <?php
    }
}

/*
   Class: FleurMikadoField
   A class that initializes Mikado Field
*/

class FleurMikadoField implements iFleurMikadoRender {
    private $type;
    private $name;
    private $default_value;
    private $label;
    private $description;
    private $options = array();
    private $args = array();
    public $hidden_property;
    public $hidden_values = array();


    function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array()) {
        global $fleur_Framework;
        $this->type            = $type;
        $this->name            = $name;
        $this->default_value   = $default_value;
        $this->label           = $label;
        $this->description     = $description;
        $this->options         = $options;
        $this->args            = $args;
        $this->hidden_property = $hidden_property;
        $this->hidden_values   = $hidden_values;
        $fleur_Framework->mkdOptions->addOption($this->name, $this->default_value, $type);
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            foreach($this->hidden_values as $value) {
                if(fleur_mikado_option_get_value($this->hidden_property) == $value) {
                    $hidden = true;
                }

            }
        }
        $factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
    }
}

/*
   Class: FleurMikadoMetaField
   A class that initializes Mikado Meta Field
*/

class FleurMikadoMetaField implements iFleurMikadoRender {
    private $type;
    private $name;
    private $default_value;
    private $label;
    private $description;
    private $options = array();
    private $args = array();
    public $hidden_property;
    public $hidden_values = array();


    function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array()) {
        global $fleur_Framework;
        $this->type            = $type;
        $this->name            = $name;
        $this->default_value   = $default_value;
        $this->label           = $label;
        $this->description     = $description;
        $this->options         = $options;
        $this->args            = $args;
        $this->hidden_property = $hidden_property;
        $this->hidden_values   = $hidden_values;
        $fleur_Framework->mkdMetaBoxes->addOption($this->name, $this->default_value);
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            foreach($this->hidden_values as $value) {
                if(fleur_mikado_option_get_value($this->hidden_property) == $value) {
                    $hidden = true;
                }

            }
        }
        $factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
    }
}

abstract class FleurMikadoFieldType {

    abstract public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false);

}

class FleurMikadoFieldText extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        $col_width = 12;
        if(isset($args["col_width"])) {
            $col_width = $args["col_width"];
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                                <?php endif; ?>
                                <input type="text"
                                       class="form-control mkd-input mkd-form-element"
                                       name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(fleur_mikado_option_get_value($name))); ?>"
                                       placeholder=""/>
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                                <?php if($suffix) : ?>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class FleurMikadoFieldTextSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        ?>


        <div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <?php if($suffix) : ?>
            <div class="input-group">
                <?php endif; ?>
                <input type="text"
                       class="form-control mkd-input mkd-form-element"
                       name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(fleur_mikado_option_get_value($name))); ?>"
                       placeholder=""/>
                <?php if($suffix) : ?>
                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                <?php endif; ?>
                <?php if($suffix) : ?>
            </div>
        <?php endif; ?>
        </div>
    <?php

    }

}

class FleurMikadoFieldTextArea extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
							<textarea class="form-control mkd-form-element"
                                      name="<?php echo esc_attr($name); ?>"
                                      rows="5"><?php echo esc_html(htmlspecialchars(fleur_mikado_option_get_value($name))); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class FleurMikadoFieldTextAreaSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>

        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
			<textarea class="form-control mkd-form-element"
                      name="<?php echo esc_attr($name); ?>"
                      rows="5"><?php echo esc_html(fleur_mikado_option_get_value($name)); ?></textarea>
        </div>
    <?php

    }

}

class FleurMikadoFieldColor extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(fleur_mikado_option_get_value($name)); ?>" class="my-color-field"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class FleurMikadoFieldColorSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        ?>

        <div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(fleur_mikado_option_get_value($name)); ?>" class="my-color-field"/>
        </div>
    <?php

    }

}

class FleurMikadoFieldImage extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mkd-media-uploader">
                                <div<?php if(!fleur_mikado_option_has_value($name)) { ?> style="display: none"<?php } ?>
                                    class="mkd-media-image-holder">
                                    <img src="<?php if(fleur_mikado_option_has_value($name)) {
                                        echo esc_url(fleur_mikado_get_attachment_thumb_url(fleur_mikado_option_get_value($name)));
                                    } ?>" alt=""
                                         class="mkd-media-image img-thumbnail"/>
                                </div>
                                <div style="display: none"
                                     class="mkd-media-meta-fields">
                                    <input type="hidden" class="mkd-media-upload-url"
                                           name="<?php echo esc_attr($name); ?>"
                                           value="<?php echo esc_attr(fleur_mikado_option_get_value($name)); ?>"/>
                                </div>
                                <a class="mkd-media-upload-btn btn btn-sm btn-primary"
                                   href="javascript:void(0)"
                                   data-frame-title="<?php esc_html_e('Select Image', 'fleur'); ?>"
                                   data-frame-button-text="<?php esc_html_e('Select Image', 'fleur'); ?>"><?php esc_html_e('Upload', 'fleur'); ?></a>
                                <a style="display: none;" href="javascript: void(0)"
                                   class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'fleur'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class FleurMikadoFieldImageSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>


        <div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>

            <div class="mkd-media-uploader">
                <div<?php if(!fleur_mikado_option_has_value($name)) { ?> style="display: none"<?php } ?>
                    class="mkd-media-image-holder">
                    <img src="<?php if(fleur_mikado_option_has_value($name)) {
                        echo esc_url(fleur_mikado_get_attachment_thumb_url(fleur_mikado_option_get_value($name)));
                    } ?>" alt=""
                         class="mkd-media-image img-thumbnail"/>
                </div>
                <div style="display: none"
                     class="mkd-media-meta-fields">
                    <input type="hidden" class="mkd-media-upload-url"
                           name="<?php echo esc_attr($name); ?>"
                           value="<?php echo esc_attr(fleur_mikado_option_get_value($name)); ?>"/>
                </div>
                <a class="mkd-media-upload-btn btn btn-sm btn-primary"
                   href="javascript:void(0)"
                   data-frame-title="<?php esc_html_e('Select Image', 'fleur'); ?>"
                   data-frame-button-text="<?php esc_html_e('Select Image', 'fleur'); ?>"><?php esc_html_e('Upload', 'fleur'); ?></a>
                <a style="display: none;" href="javascript: void(0)"
                   class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'fleur'); ?></a>
            </div>
        </div>
    <?php

    }

}

class FleurMikadoFieldFont extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        global $fleur_fonts_array;
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control mkd-form-element"
                                    name="<?php echo esc_attr($name); ?>">
                                <option value="-1"><?php esc_html_e('Default', 'fleur'); ?></option>
                                <?php foreach($fleur_fonts_array as $fontArray) { ?>
                                    <option <?php if(fleur_mikado_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class FleurMikadoFieldFontSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        global $fleur_fonts_array;
        ?>


        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element"
                    name="<?php echo esc_attr($name); ?>">
                <option value="-1"><?php esc_html_e('Default', 'fleur'); ?></option>
                <?php foreach($fleur_fonts_array as $fontArray) { ?>
                    <option <?php if(fleur_mikado_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
                <?php } ?>
            </select>
        </div>
    <?php

    }

}

class FleurMikadoFieldSelect extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>" <?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control mkd-form-element<?php if($dependence) {
                                echo " dependence";
                            } ?>"
                                <?php foreach($show as $key => $value) { ?>
                                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                <?php foreach($hide as $key => $value) { ?>
                                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                    name="<?php echo esc_attr($name); ?>">
                                <?php foreach($options as $key => $value) {
                                    if($key == "-1") {
                                        $key = "";
                                    } ?>
                                    <option <?php if(fleur_mikado_option_get_value($name) == $key) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class FleurMikadoFieldSelectBlank extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>

        <div class="mkd-page-form-section"<?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control mkd-form-element<?php if($dependence) {
                                echo " dependence";
                            } ?>"
                                <?php foreach($show as $key => $value) { ?>
                                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                <?php foreach($hide as $key => $value) { ?>
                                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                    name="<?php echo esc_attr($name); ?>">
                                <option <?php if(fleur_mikado_option_get_value($name) == "") {
                                    echo "selected='selected'";
                                } ?> value=""></option>
                                <?php foreach($options as $key => $value) {
                                    if($key == "-1") {
                                        $key = "";
                                    } ?>
                                    <option <?php if(fleur_mikado_option_get_value($name) == $key) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class FleurMikadoFieldSelectSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>


        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element<?php if($dependence) {
                echo " dependence";
            } ?>"
                <?php foreach($show as $key => $value) { ?>
                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key => $value) { ?>
                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if(fleur_mikado_option_get_value($name) == "") {
                    echo "selected='selected'";
                } ?> value=""></option>
                <?php foreach($options as $key => $value) {
                    if($key == "-1") {
                        $key = "";
                    } ?>
                    <option <?php if(fleur_mikado_option_get_value($name) == $key) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
        </div>
    <?php

    }

}

class FleurMikadoFieldSelectBlankSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>


        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element<?php if($dependence) {
                echo " dependence";
            } ?>"
                <?php foreach($show as $key => $value) { ?>
                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key => $value) { ?>
                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if(fleur_mikado_option_get_value($name) == "") {
                    echo "selected='selected'";
                } ?> value=""></option>
                <?php foreach($options as $key => $value) {
                    if($key == "-1") {
                        $key = "";
                    } ?>
                    <option <?php if(fleur_mikado_option_get_value($name) == $key) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
        </div>
    <?php

    }

}

class FleurMikadoFieldYesNo extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $dependence_hide_on_yes = "";
        if(isset($args["dependence_hide_on_yes"])) {
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        }
        $dependence_show_on_yes = "";
        if(isset($args["dependence_show_on_yes"])) {
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        }
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if(fleur_mikado_option_get_value($name) == "yes") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'fleur') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if(fleur_mikado_option_get_value($name) == "no") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'fleur') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if(fleur_mikado_option_get_value($name) == "yes") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(fleur_mikado_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }
}

class FleurMikadoFieldYesNoSimple extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $dependence_hide_on_yes = "";
        if(isset($args["dependence_hide_on_yes"])) {
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        }
        $dependence_show_on_yes = "";
        if(isset($args["dependence_show_on_yes"])) {
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        }
        ?>

        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>

            <p class="field switch">
                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                       class="cb-enable<?php if(fleur_mikado_option_get_value($name) == "yes") {
                           echo " selected";
                       } ?><?php if($dependence) {
                           echo " dependence";
                       } ?>"><span><?php esc_html_e('Yes', 'fleur') ?></span></label>
                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                       class="cb-disable<?php if(fleur_mikado_option_get_value($name) == "no") {
                           echo " selected";
                       } ?><?php if($dependence) {
                           echo " dependence";
                       } ?>"><span><?php esc_html_e('No', 'fleur') ?></span></label>
                <input type="checkbox" id="checkbox" class="checkbox"
                       name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if(fleur_mikado_option_get_value($name) == "yes") {
                    echo " selected";
                } ?>/>
                <input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(fleur_mikado_option_get_value($name)); ?>"/>
            </p>
        </div>
    <?php

    }
}

class FleurMikadoFieldOnOff extends FleurMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $fleur_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $dependence_hide_on_yes = "";
        if(isset($args["dependence_hide_on_yes"])) {
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        }
        $dependence_show_on_yes = "";
        if(isset($args["dependence_show_on_yes"])) {
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        }
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if(fleur_mikado_option_get_value($name) == "on") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('On', 'fleur') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if(fleur_mikado_option_get_value($name) == "off") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Off', 'fleur') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_onoff" value="on"<?php if(fleur_mikado_option_get_value($name) == "on") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_onoff" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(fleur_mikado_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}