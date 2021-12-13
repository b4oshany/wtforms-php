<?php

namespace WTForms\Widgets;


class SubmitWidget extends Widget {

    public function render($field) {
        $attrs = $this->renderAttrs($field);

        $html = "<input type='$field->type' name='$field->name'"
                ." id='$field->id' value='$field->label' $attrs"
                ." class='$field->css_class' ";
        if ($field->required) {
            $html .= "required ";
        }
        $html .= "/>";
        return $html;
    }

}
