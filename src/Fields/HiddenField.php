<?php

namespace WTForms\Fields;
use  WTForms\Widgets\HiddenWidget;


class HiddenField extends StringField
{

    public function __construct($label,$validators=[],$options=[])
    {
        parent::__construct($label,$validators,$options);
        $this->widget = new HiddenWidget();
    }


}