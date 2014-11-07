<?php

namespace WTForms\Fields;

class BooleanField extends Field
{

    public function __construct($label,$validators=[],$options=[])
    {
        $this->widget = 'radio';
        $this->validators[] = 'boolean';
        parent::__construct($label,$validators,$options);
    }



}