<?php

namespace WTForms\Fields;

use  WTForms\Validators\InputRequiredValidator;
use  WTForms\Widgets\TextWidget;


abstract class Field
{

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


    public function __construct($label)
    {
        $this->label = $label;
        if(empty($this->widget)){
            $this->widget = new TextWidget();
        }
    }

    public function validate()
    {
        $valid = false;
        if(count($this->validators)==0) {
            $valid = true;
        } else {

            foreach ($this->validators as $k=>$validator) {
                if(!$validator->validate()) {
                    $this->errors[] = $validator->error;
                }
            }
            if(is_null($this->errors)) $valid=true;
        }
        return $valid;
    }

    public function required()
    {
        $this->required = true;
        $validator = new InputRequiredValidator($this->_form,$this);
        $this->validators[get_class($validator)] = $validator;
        return $this;
    }

    public function label($show=True){
        if($show){
            echo $this->widget->label($this);
        }
    }

    public function render(){
        echo $this->widget->render($this);
    }

    public function validators()
    {
        $validators = func_get_args();
        foreach ($validators as $validator) {
            $validator->setField($this)->setForm($this->_form);
            $this->validators[get_class($validator)] = $validator;
        }
        return $this;
    }

    public function loadRequest()
    {
        $new_value = filter_input($input,$this->name,FILTER_SANITIZE_STRING);
        if(!is_null($new_value)) {
            $this->value = $new_value;
        }
    }


    public function help($value)
    {
        return $this->_set_property('help',$value);
    }

    public function setForm($form)
    {
        $this->_form = $form;
        return $this;
    }

    public function setName($name)
    {
        $this->name=$name;
        if(is_null($this->id)) $this->id = str_replace(['[',']'], '_', $this->name);
        return $this;
    }
    
    public function set_type($type){
        return $this->_set_property("type", $type);
    }

    public function default_value($value)
    {
        return $this->_set_property('default_value',$value);
    }

    public function value($value)
    {
        return $this->_set_property('value',$value);
    }

    /**
     * Set additional attributes.
     *
     * @param $attrs array - Attributes.
     */
    public function attrs(array $value){
        return $this->_set_property('attrs', $value);
    }

    public function widget($value)
    {
        return $this->_set_property('widget',$value);
    }

    public function css_class($value)
    {
        return $this->_set_property('css_class',$value);
    }

    public function id($value)
    {
        return $this->_set_property('id',$value);
    }

    protected function _set_property($name,$value)
    {
        $this->$name = $value;
        return $this;
    }


}
