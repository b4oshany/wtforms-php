<?php

namespace WTForms\Fields;

class SelectField extends Field
{

    public function __construct($label,$validators=[],$options=[])
    {
        parent::__construct($label,$validators,$options);
    }

    public function validate()
    {

    }



}