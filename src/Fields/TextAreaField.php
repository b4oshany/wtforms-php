<?php

namespace WTForms\Fields;
use  WTForms\Widgets\TextAreaWidget;


class TextAreaField extends StringField
{

    public function __construct($label,$validators=[],$options=[])
    {
        parent::__construct($label,$validators,$options);
        $this->widget = new TextAreaWidget();
    }



}