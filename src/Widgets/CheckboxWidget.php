<?php

namespace WTForms\Widgets;

class CheckboxWidget{

    public function render($field){
        $attrs = $this->renderAttrs($field);

        $html = "";
        $count = 0;
        foreach($field->options() as $key => $label){
            $html .= "<label><span>$label</span>";
            $html .= "<input type='$field->type' value='$key' ";
            if($field->default_value == $key){
                $html .= "checked ";
            }
            if($count == 0 && $field->required){
                $html .="required ";
            }
            $html .= "name='$field->name' $attrs /></label>";
            $count += 1;
        }
        return $html;
    }


}
