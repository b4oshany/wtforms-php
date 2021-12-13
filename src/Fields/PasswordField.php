<?php

namespace WTForms\Fields;


class PasswordField extends StringField {

    public function __construct($label,$validators=[],$options=[]) {
        parent::__construct($label,$validators,$options);
        $this->type = 'password';
    }

}
