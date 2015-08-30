<?php

namespace WTForms\Widgets;

class SelectWidget extends Widget{

    public function getOptions($field){
        $options = "";
        foreach($field->options() as $key => $value){
            $options .= "<option value='$key' ";
            if($field->default_value == $key){
                $options .= "selected ";
            }
            $options .= ">$value</option>";
        }
        return $options;
    }

    public function render($field){
        $attrs = $this->renderAttrs($field);
        $options = $this->getOptions($field);
        $html = "<select name='$field->name' id='$field->id'"
                ." class='form-control $field->css_class' ";
        if($field->required) $html .="required ";
        $html .= "$attrs >$options</select>";
        return $html;
    }

}
