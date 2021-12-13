<?php

namespace WTForms\Widgets;


class TextAreaWidget extends Widget {

    public function render($field) {
        $attrs = $this->renderAttrs($field);
        
        $html = "<textarea name='$field->name' id='$field->id' $attrs "
                ." class='form-control $field->css_class' ";
        if ($field->required) {
            $html .= "required";
        }
        $html .= ">";
        $html .= "$field->value";
        $html .= "</textarea>";
        return $html;
    }

}
