<?php

namespace WTForms\Fields;


class SubmitField extends Field
{

    public function __construct($label,$validators=[],$options=[])
    {
		$this->type = 'submit';
        parent::__construct($label,$validators,$options);
    }



}