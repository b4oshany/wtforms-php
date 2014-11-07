<?php

namespace WTForms\Fields;


class HiddenField extends StringField
{

    public function __construct($label,$validators=[],$options=[])
    {
        $this->widget = 'hidden';
        parent::__construct($label,$validators,$options);
    }


}