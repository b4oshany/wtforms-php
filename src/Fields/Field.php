<?php

namespace WTForms\Fields;

use  WTForms\Validators\InputRequiredValidator;
use  WTForms\Widgets\TextWidget;


/**
* Abstract class for HTML form field objects.
* 
* @author Oshane Bailey <b4.oshany@gmail.com>
* @since 1.0
*/
abstract class Field {
    
    /**
    * @var string $id - ID selector for the form field. Default is equal to the field name ({@see WTForms\Frields\Field::name}).
    * @var string $name - Field name.
    * @var string $type - Field type.
    * @var string $label - Field label.
    * @var string $help - Help text|HTML for the field.
    * @var string $errors - error text|HTML for the field.
    * @var boolan $required - Mark HTML field as required if set to True and validate it upon submission.
    * @var mixed $value - Value of the field.
    * @var WTForms\Widgets\Widget $widget - Widget to render the HTML text for the field.
    * @var WTForms\Validators\Validator[] $validators - List of validators to check the value of the field for correctness.
    * @var string[] $attrs - Associated array of the list of HTML input field attributes.
    */
    public $id            = null;
    public $name          = null;
    public $type          = 'text';
    public $label         = '';
    public $help          = '';
    public $error         = '';
    public $css_class     = '';
    public $required      = false;
    public $value         = null;
    public $default_value = null;
    public $errors        = null;
    public $widget        = null;
    public $validators    = [];
    public $_form         = null;
    public $attrs         = [];

    /**
     * Create a field object.
     * @param string $label - Label for the field.
     * @uses WTForms\Widgets\TextWidget
     */
    public function __construct($label)     {
        $this->label = $label;
        if(empty($this->widget)) {
            $this->widget = new TextWidget();
        }
    }

    /**
     * Validate the value of the input field.
     * @return boolean
     */
    public function validate() {
        $valid = false;
        if (count($this->validators) == 0) {
            $valid = true;
        }
        else {
            foreach ($this->validators as $k=>$validator) {
                if (!$validator->validate()) {
                    $this->errors[] = $validator->error;
                }
            }
            if (is_null($this->errors)) {
                $valid=true;
            }
        }
        return $valid;
    }

    /**
     * Set the field as a required html field.
     * @param boolean $required - When true, the field is set to required.
     * @return self
     */
    public function required($required=true) {
        $this->required = $required;
        $validator = new InputRequiredValidator($this->_form,$this);
        $this->validators[get_class($validator)] = $validator;
        return $this;
    }

    /**
     * Render the HTML data for the field label.
     * @param boolean $show - When true, show the HTML label for the field.
     * @uses WTForms\Widgets\Widget::label()
     */
    public function label($show=true) {
        if ($show) {
            echo $this->widget->label($this);
        }
    }

    /**
     * Render the HTML input field.
     */
    public function render() {
        echo $this->widget->render($this);
    }

    /**
     * Add validators to the field.
     * Note: This function can accept validators as arguments {@see WTForms\Validators\Validator}
     * @return self
     */
    public function validators() {
        $validators = func_get_args();
        foreach ($validators as $validator) {
            $validator->setField($this)->setForm($this->_form);
            $this->validators[get_class($validator)] = $validator;
        }
        return $this;
    }

    /**
     * Capture the POST or GET request for the field.
     */
    public function loadRequest() {
        $new_value = filter_input($input,$this->name,FILTER_SANITIZE_STRING);
        if (!is_null($new_value)) {
            $this->value = $new_value;
        }
    }

    /**
     * Set the help text for the field.
     * @return self
     */
    public function help($value) {
        return $this->_set_property('help',$value);
    }

    /**
     * Set the associated form for the field.
     * @return self
     */
    public function setForm($form) {
        $this->_form = $form;
        return $this;
    }

    /**
     * Set the HTML name attribute for the field.
     * @param string $name - Field name.
     * @return self
     */
    public function setName($name) {
        $this->name=$name;
        if (is_null($this->id)) {
            $this->id = str_replace(['[',']'], '_', $this->name);
        }
        return $this;
    }
    
    /**
     * Set the field type.
     * @param string $type - Field type.
     * @return self
     */
    public function set_type($type) {
        return $this->_set_property("type", $type);
    }

    /**
     * Set the default value of the field.
     * @param mixed $value - Default value of the field.
     * @return self
     */
    public function default_value($value) {
        return $this->_set_property('default_value',$value);
    }

    /**
     * Set the value of the field.
     * @param mixed $value - Field value.
     * @return self
     */
    public function value($value) {
        return $this->_set_property('value',$value);
    }

    /**
     * Set the HTML input attributes for the field.
     * @param $attrs array - Associated array of HTML input attributes.
     * @return self
     */
    public function attrs(array $value) {
        return $this->_set_property('attrs', $value);
    }

    /**
     * Set the widget to be used to render the field into HTML.
     * @param WTForms\Widgets\Widget $widget - Field widget.
     * @return self
     */
    public function widget($widget) {
        return $this->_set_property('widget',$widget);
    }

    /**
     * Set the css class to be added to HTML input field.
     * @param string $value - HTML class sectors.
     * @return self
     */
    public function css_class($value) {
        return $this->_set_property('css_class',$value);
    }

    /**
     * Set the id of the field.
     * @param string value - Field id.
     * @return self
     */
    public function id($value) {
        return $this->_set_property('id',$value);
    }

    /**
     * Set field properties.
     * @param string $name - Name of the field proeprty.
     * @param mixed $value - Value of the field property.
     * @return self
     */
    protected function _set_property($name,$value) {
        $this->$name = $value;
        return $this;
    }

}
