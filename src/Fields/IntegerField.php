<?php

namespace WTForms\Fields;
use  WTForms\Validators\TypeValidator;

class IntegerField extends Field
{

    public function __construct($label,$validators=[],$options=[])
    {
        $validator = new TypeValidator($this->_form,$this,'integer');
        $this->validators[get_class($validator)] = $validator;
		$this->type = 'number';
        parent::__construct($label,$validators,$options);
    }

    public function loadRequest()
    {
        $new_value = filter_input($input,$this->name,FILTER_SANITIZE_NUMBER_INT);
        if(!is_null($new_value)) {
            $this->value = $new_value;
        }
    }
}