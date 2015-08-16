<?php

namespace WTForms\Fields;

class RadioField extends Field
{

    public function __construct($label,$validators=[],$options=[])
    {
        parent::__construct($label,$validators,$options);
		$this->type = 'radio';
    }

}