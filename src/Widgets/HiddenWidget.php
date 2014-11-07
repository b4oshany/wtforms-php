<?php

namespace WTForms\Widgets;

class HiddenWidget extends Widget
{


    public function render($field)
    {
        $html = "<input type='hidden' name='{$field->name}' id='{$field->id}' value='{$field->value}' ";
        if($field->required) $html .="required";
        $html .="/>";
        return $html;

    }


}