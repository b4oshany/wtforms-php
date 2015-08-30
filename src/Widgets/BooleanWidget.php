<?php

namespace WTForms\Widgets;

class BooleanWidget extends Widget{

    public function render($field){
        $attrs = $this->renderAttrs($field);

        $html = "<span style='display: inline-block; width: 70%;"
                ." max-width: 120'>$field->label</span>";
        $html .= "<input type='checkbox' value='yes' ";
        if($field->default_value == "yes"){
            $html .= "checked ";
        }
        if($field->required){
            $html .="required ";
        }
        $html .= "name='$field->name' $attrs /></label>";
        return $html;
    }


}
