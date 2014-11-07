<?php

namespace WTForms\Fields;

class PasswordField extends StringField
{

    public function __construct($label,$validators=[],$options=[])
    {
        $this->widget = 'password';
        parent::__construct($label,$validators,$options);
    }


}