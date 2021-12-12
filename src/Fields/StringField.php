<?php

namespace WTForms\Fields;

use  WTForms\Validators\TypeValidator;


class StringField extends Field {

    /**
     * Create a field object.
     * @param string $label - Label for the field.
     * @uses WTForms\Widgets\TextWidget
     */
    public function __construct($label,$validators=[],$options=[]) {
        parent::__construct($label,$validators,$options);
        $validator = new TypeValidator($this->_form,$this,'string');
        $this->validators[get_class($validator)] = $validator;
    }

}

?>