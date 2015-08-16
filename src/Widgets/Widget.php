<?php

namespace WTForms\Widgets;

abstract class Widget
{


    protected function renderAttrs($field){
		$attrs = "";
        foreach($field->attrs as $key => $value){
            $attrs .= "$key='$value' ";
        }
        return $attrs;
    }

    public function render($field){
        $attrs = $this->renderAttrs($field);
        $html = "<input type='$field->type' name='$field->name'"
                ." id='$field->id' value='$field->value' $attrs"
                ." class='form-control $field->css_class' placeholder='$field->label' ";
        if($field->required) $html .="required ";
        $html .="/>";
        return $html;
    }


}