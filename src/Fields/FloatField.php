<?php

namespace WTForms\Fields;

use  WTForms\Validators\TypeValidator;
use  WTForms\Widgets\TextWidget;

class FloatField extends Field
{


    public function __construct($label,$validators=[],$options=[])
    {
        $this->widget = new TextWidget();
        $validator = new TypeValidator($this->_form,$this,'float');
        $this->validators[get_class($validator)] = $validator;
        parent::__construct($label,$validators,$options);
    }

}