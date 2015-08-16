<?php

namespace WTForms\Fields;


class TextAreaField extends StringField
{

    public function __construct($label,$validators=[],$options=[])
    {
        parent::__construct($label,$validators,$options);
    }



}