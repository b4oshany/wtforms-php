<?php

namespace WTForms\Widgets;

class TextAreaWidget extends Widget
{


    public function render($field)
    {
        $html = "<textarea name='{$field->name}' id='{$field->id}' ";
        if($field->required) $html .="required";
        $html .=">";
        $html .="\n{$field->value}\n";
        $html .="</textarea>";
        return $html;

    }


}